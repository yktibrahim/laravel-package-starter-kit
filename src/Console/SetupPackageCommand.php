<?php

namespace LaravelPackageStarterKit\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Illuminate\Support\Facades\File;

class SetupPackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:setup 
                            {name : Paket adı (örn: vendor/package-name)}
                            {--namespace=MyPackage : Paketin ana namespace\'i}
                            {--author_name= : Paket yazarının adı}
                            {--author_email= : Paket yazarının e-posta adresi}
                            {--author_homepage= : Paket yazarının web sitesi}
                            {--description= : Paket açıklaması}
                            {--setup_command=true : Setup komutunu dahil et}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laravel paket başlangıç kitini kişiselleştirme';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->components->info('Laravel Paket Başlangıç Kiti kurulum sihirbazına hoş geldiniz!');
        
        // Giriş parametrelerini al
        $packageName = $this->argument('name');
        $namespace = $this->option('namespace');
        $authorName = $this->option('author_name') ?: $this->ask('Yazar adı?');
        $authorEmail = $this->option('author_email') ?: $this->ask('Yazar e-posta adresi?');
        $authorHomepage = $this->option('author_homepage') ?: $this->ask('Yazar web sitesi? (isteğe bağlı)', '');
        $description = $this->option('description') ?: $this->ask('Paket açıklaması?', 'Laravel paketi');
        $includeSetupCommand = filter_var($this->option('setup_command'), FILTER_VALIDATE_BOOLEAN);
        
        if ($includeSetupCommand) {
            $this->components->info('Setup komutunu paketinize dahil ediyorsunuz - bu sayede kullanıcılar kendi projelerinde de kişiselleştirme yapabilecekler.');
        } else {
            $this->components->info('Setup komutu paketinize dahil edilmeyecek.');
        }
        
        // Paket adının geçerli olup olmadığını kontrol et
        if (!Str::contains($packageName, '/')) {
            $this->components->error('Paket adı vendor/package-name formatında olmalıdır. Örnek: laravel/framework');
            return SymfonyCommand::FAILURE;
        }
        
        // Namespace doğrulaması
        if (Str::contains($namespace, '\\')) {
            $namespace = str_replace('\\', '', $namespace);
            $this->components->warn("Namespace'ler içerisinde ters eğik çizgi karakteri olmamalıdır. Düzeltildi: {$namespace}");
        }

        // Değişkenleri hazırla
        $vendorName = Str::before($packageName, '/');
        $shortName = Str::studly(Str::after($packageName, '/'));
        $configFileName = Str::kebab($shortName);
        $bindName = Str::kebab($shortName);
        $tagPrefix = Str::kebab($shortName);
        $viewNamespace = Str::kebab($shortName);
        $basePath = $this->laravel->basePath();
        
        $replacements = [
            '{{ namespace }}' => $namespace,
            '{{ packageName }}' => $packageName,
            '{{ className }}' => $shortName,
            '{{ authorName }}' => $authorName,
            '{{ authorEmail }}' => $authorEmail,
            '{{ configFileName }}' => $configFileName,
            '{{ bindName }}' => $bindName,
            '{{ tagPrefix }}' => $tagPrefix,
            '{{ viewNamespace }}' => $viewNamespace,
        ];
        
        $this->components->task('Composer.json güncelleniyor', function () use ($packageName, $namespace, $authorName, $authorEmail, $authorHomepage, $description, $basePath, $shortName) {
            // composer.json dosyasını güncelle
            $composerJsonPath = "{$basePath}/composer.json";
            $composerJson = json_decode(File::get($composerJsonPath), true);
            
            // Temel bilgileri güncelle
            $composerJson['name'] = $packageName;
            $composerJson['description'] = $description;
            $composerJson['authors'] = [
                [
                    'name' => $authorName,
                    'email' => $authorEmail
                ]
            ];
            
            if (!empty($authorHomepage)) {
                $composerJson['authors'][0]['homepage'] = $authorHomepage;
            }
            
            // PSR-4 autoload namespace'ini güncelle
            $composerJson['autoload']['psr-4'] = [
                "{$namespace}\\" => "src/"
            ];
            $composerJson['autoload-dev']['psr-4'] = [
                "{$namespace}\\Tests\\" => "tests/"
            ];
            
            // Laravel provider ve alias bilgilerini güncelle
            $composerJson['extra']['laravel']['providers'] = [
                "{$namespace}\\{$shortName}ServiceProvider"
            ];
            
            $composerJson['extra']['laravel']['aliases'] = [
                $shortName => "{$namespace}\\Facades\\{$shortName}"
            ];
            
            // Composer.json dosyasını kaydet
            File::put($composerJsonPath, json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            
            return true;
        });
        
        // Klasör yapısının varlığını kontrol et
        $this->ensureDirectoriesExist($basePath);
        
        // Stub dosyalarından yeni dosyaları oluştur
        $this->components->task('Servis sağlayıcı oluşturuluyor', function () use ($basePath, $replacements, $shortName) {
            $stubContent = File::get(__DIR__ . '/../stubs/service-provider.stub');
            $content = $this->replacePlaceholders($stubContent, $replacements);
            File::put("{$basePath}/src/{$shortName}ServiceProvider.php", $content);
            return true;
        });
        
        $this->components->task('Ana sınıf oluşturuluyor', function () use ($basePath, $replacements, $shortName) {
            $stubContent = File::get(__DIR__ . '/../stubs/main-class.stub');
            $content = $this->replacePlaceholders($stubContent, $replacements);
            File::put("{$basePath}/src/{$shortName}.php", $content);
            return true;
        });
        
        $this->components->task('Facade sınıfı oluşturuluyor', function () use ($basePath, $replacements, $shortName) {
            $stubContent = File::get(__DIR__ . '/../stubs/facade.stub');
            $content = $this->replacePlaceholders($stubContent, $replacements);
            
            if (!File::isDirectory("{$basePath}/src/Facades")) {
                File::makeDirectory("{$basePath}/src/Facades", 0755, true);
            }
            
            File::put("{$basePath}/src/Facades/{$shortName}.php", $content);
            return true;
        });
        
        $this->components->task('Örnek komut oluşturuluyor', function () use ($basePath, $replacements) {
            $stubContent = File::get(__DIR__ . '/../stubs/example-command.stub');
            $content = $this->replacePlaceholders($stubContent, $replacements);
            
            if (!File::isDirectory("{$basePath}/src/Console")) {
                File::makeDirectory("{$basePath}/src/Console", 0755, true);
            }
            
            File::put("{$basePath}/src/Console/ExampleCommand.php", $content);
            return true;
        });
        
        $this->components->task('Yapılandırma dosyası oluşturuluyor', function () use ($basePath, $replacements, $configFileName) {
            $stubContent = File::get(__DIR__ . '/../stubs/config.stub');
            $content = $this->replacePlaceholders($stubContent, $replacements);
            
            if (!File::isDirectory("{$basePath}/src/Config")) {
                File::makeDirectory("{$basePath}/src/Config", 0755, true);
            }
            
            File::put("{$basePath}/src/Config/{$configFileName}.php", $content);
            return true;
        });
        
        // Eğer setup komutu dahil edilecekse
        if ($includeSetupCommand) {
            $this->components->task('Setup Komutu Kopyalanıyor', function () use ($basePath, $namespace, $shortName, $replacements) {
                // Mevcut setup command kopyalanıp kişiselleştiriliyor
                if (!File::isDirectory("{$basePath}/src/Console")) {
                    File::makeDirectory("{$basePath}/src/Console", 0755, true);
                }
                
                // SetupPackageCommand dosyasını oku ve namespace'i güncelle
                $setupCommandContent = File::get(__FILE__);
                
                // Namespace ve sınıf isimlerini güncelle
                $setupCommandContent = str_replace(
                    'namespace LaravelPackageStarterKit\\Console',
                    "namespace {$namespace}\\Console",
                    $setupCommandContent
                );
                
                // Komutu yeni projeye kopyala
                File::put("{$basePath}/src/Console/SetupPackageCommand.php", $setupCommandContent);
                
                // ExampleCommand'ı zaten stub'tan oluşturuyoruz, buraya gerek kalmadı
                
                return true;
            });
        }
        
        // Namespace değişikliklerini uygula
        $oldNamespace = 'LaravelPackageStarterKit';
        $oldClassPrefix = 'LaravelPackageStarterKit';
        
        $this->components->task('Dosya içeriklerini güncelleme', function () use ($namespace, $oldNamespace, $oldClassPrefix, $shortName, $basePath) {
            $directories = [
                "{$basePath}/src",
                "{$basePath}/tests"
            ];
            
            foreach ($directories as $directory) {
                $this->processDirectory($directory, $oldNamespace, $namespace, $oldClassPrefix, $shortName);
            }
            
            return true;
        });
        
        // Eski ana dosyaları temizle
        $this->components->task('Eski dosyaları temizleme', function () use ($basePath, $includeSetupCommand) {
            $filesToDelete = [
                "{$basePath}/src/LaravelPackageStarterKitServiceProvider.php",
                "{$basePath}/src/LaravelPackageStarterKit.php",
                "{$basePath}/src/Facades/LaravelPackageStarterKit.php",
                "{$basePath}/src/Config/laravelpackagestarterkit.php",
            ];
            
            // Eğer setup komutunu dahil etmemeyi seçtiyse, o komut dosyasını sil
            if (!$includeSetupCommand) {
                $filesToDelete[] = "{$basePath}/src/Console/SetupPackageCommand.php";
            }
            
            foreach ($filesToDelete as $file) {
                if (File::exists($file)) {
                    File::delete($file);
                }
            }
            
            return true;
        });
        
        // Kopya dosyalarını temizleme (aynı dizindeki aynı dosyaları temizle)
        if ($includeSetupCommand) {
            $this->components->task('Çakışan dosyaları temizleme', function () use ($basePath) {
                // Eğer bu dosya kopyalandıysa ve hala buradaysa, temizle
                if (File::exists("{$basePath}/src/Console/SetupPackageCommand.php") &&
                    __FILE__ !== "{$basePath}/src/Console/SetupPackageCommand.php") {
                    // Büyük ihtimalle kişiselleştirmeden önceki kopya, silelim
                    File::delete(__FILE__);
                }
                
                return true;
            });
        }
        
        // Route dosyalarını güncelle
        $this->components->task('Route dosyalarını güncelleme', function () use ($basePath, $namespace, $shortName) {
            $routeFiles = [
                "{$basePath}/routes/web.php",
                "{$basePath}/routes/api.php",
            ];
            
            foreach ($routeFiles as $routeFile) {
                if (File::exists($routeFile)) {
                    $content = File::get($routeFile);
                    $content = str_replace(
                        'LaravelPackageStarterKit',
                        $namespace,
                        $content
                    );
                    File::put($routeFile, $content);
                }
            }
            
            return true;
        });
        
        $this->components->info('Laravel paket başlangıç kiti başarıyla kuruldu!');
        $this->components->info('Şimdi composer dump-autoload komutunu çalıştırın.');
        
        return SymfonyCommand::SUCCESS;
    }
    
    /**
     * Belirtilen dizindeki dosyaları işler ve içeriklerini değiştirir
     */
    protected function processDirectory(string $directory, string $oldNamespace, string $newNamespace, string $oldClassPrefix, string $newClassPrefix): void
    {
        if (!File::isDirectory($directory)) {
            return;
        }
        
        $files = File::allFiles($directory);
        
        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }
            
            $path = $file->getPathname();
            
            // Setup komutu ise ve kendi dosyamız ise atla (bu sonsuz döngüye neden olabilir)
            if (basename($path) === 'SetupPackageCommand.php' && strpos($path, __FILE__) !== false) {
                continue;
            }
            
            $content = File::get($path);
            
            // Namespace değişikliği
            $content = str_replace(
                "namespace {$oldNamespace}",
                "namespace {$newNamespace}",
                $content
            );
            
            $content = str_replace(
                "namespace {$oldNamespace}\\",
                "namespace {$newNamespace}\\",
                $content
            );
            
            // Use ifadeleri değişikliği
            $content = str_replace(
                "use {$oldNamespace}\\",
                "use {$newNamespace}\\",
                $content
            );
            
            // Sınıf adı değişiklikleri
            $content = str_replace(
                $oldClassPrefix,
                $newClassPrefix,
                $content
            );
            
            // Config key değişiklikleri
            $oldConfigKey = Str::kebab($oldClassPrefix);
            $newConfigKey = Str::kebab($newClassPrefix);
            $content = str_replace($oldConfigKey, $newConfigKey, $content);
            
            // Dosyayı kaydet
            File::put($path, $content);
        }
    }
    
    /**
     * Gerekli dizinlerin varlığını kontrol eder ve yoksa oluşturur
     */
    protected function ensureDirectoriesExist(string $basePath): void
    {
        $directories = [
            "{$basePath}/src/Config",
            "{$basePath}/src/Console",
            "{$basePath}/src/Database/Migrations",
            "{$basePath}/src/Facades",
            "{$basePath}/src/Http/Controllers",
            "{$basePath}/src/Models",
            "{$basePath}/src/Resources/Views",
            "{$basePath}/src/Resources/Lang",
            "{$basePath}/routes",
            "{$basePath}/tests",
        ];
        
        foreach ($directories as $directory) {
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
        }
        
        // Route dosyalarının varlığını kontrol et
        $routeFiles = [
            "{$basePath}/routes/web.php" => '<?php

use Illuminate\Support\Facades\Route;

// Package routes go here
',
            "{$basePath}/routes/api.php" => '<?php

use Illuminate\Support\Facades\Route;

// Package API routes go here
',
        ];
        
        foreach ($routeFiles as $file => $content) {
            if (!File::exists($file)) {
                File::put($file, $content);
            }
        }
    }
    
    /**
     * Stub dosyalarındaki yer tutucuları değiştirir
     */
    protected function replacePlaceholders(string $content, array $replacements): string
    {
        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }
        
        return $content;
    }
} 