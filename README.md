# Laravel Package Starter Kit

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-package-starter-kit/laravel-package-starter-kit.svg)](https://packagist.org/packages/laravel-package-starter-kit/laravel-package-starter-kit)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/laravel-package-starter-kit/laravel-package-starter-kit/run-tests.yml?branch=main)](https://github.com/laravel-package-starter-kit/laravel-package-starter-kit/actions)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue)](composer.json)
[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red)](composer.json)

Professional starter kit for creating Laravel packages with all necessary boilerplate.

Laravel paketleri oluşturmak için gerekli tüm hazır kodlarla profesyonel bir başlangıç kiti.

## Features / Özellikler

- Supports Laravel 12.x / Laravel 12.x destekler
- Modern PHP 8.2+ features / Modern PHP 8.2+ özellikleri
- Package Auto-Discovery / Paket Otomatik Keşif
- Service Provider included / Servis Sağlayıcı dahil
- Facade included / Facade dahil
- Configuration publishing / Yapılandırma dosyası yayınlama
- Migration publishing / Migrasyon dosyası yayınlama
- Seeder & Factory publishing / Seed ve Factory dosyaları yayınlama
- Custom Artisan commands / Özel Artisan komutları
- Ready for testing with Orchestra Testbench / Orchestra Testbench ile test için hazır
- **Package Setup Wizard / Paket Kurulum Sihirbazı** - Kendi paketinizi oluşturmak için

## Installation / Kurulum

Install the package via Composer:

Paketi Composer ile yükleyin:

```bash
composer require laravel-package-starter-kit/laravel-package-starter-kit
```

**Laravel 12+** will auto-discover the package.

**Laravel 12+** paketi otomatik olarak keşfedecektir.

> **Not**: Paket yüklendikten sonra, varsa önbelleği temizlemeniz gerekebilir: `php artisan optimize:clear`

## Creating Your Own Package / Kendi Paketinizi Oluşturma

This starter kit includes a wizard to help you customize the package for your own needs:

Bu başlangıç kiti, paketi kendi ihtiyaçlarınıza göre özelleştirmenize yardımcı olacak bir sihirbaz içerir:

```bash
php artisan package:setup vendor/package-name
```

The wizard will ask you several questions to customize your package:

Sihirbaz, paketinizi özelleştirmek için size birkaç soru soracaktır:

- Package name (in format vendor/package-name) / Paket adı (vendor/package-name formatında)
- Namespace (default: MyPackage) / Namespace (varsayılan: MyPackage)
- Author name / Yazar adı
- Author email / Yazar e-posta adresi
- Author website (optional) / Yazar web sitesi (isteğe bağlı)
- Package description / Paket açıklaması

You can also provide these options directly in the command:

Bu seçenekleri doğrudan komutta da sağlayabilirsiniz:

```bash
php artisan package:setup vendor/package-name --namespace=MyNamespace --author_name="Your Name" --author_email=email@example.com --description="Package description"
```

After running the setup, the package files will be updated with your information:

Kurulumu çalıştırdıktan sonra, paket dosyaları bilgilerinizle güncellenecektir:

- composer.json
- Service Provider
- Facades
- Configuration files
- All namespaces in PHP files

Finally, run:

Son olarak, çalıştırın:

```bash
composer dump-autoload
```

## Configuration / Yapılandırma

Publish the configuration file:

Yapılandırma dosyasını yayınlayın:

```bash
php artisan vendor:publish --provider="YourNamespace\YourPackageServiceProvider" --tag="your-package-config"
```

To publish views:

Görünümleri yayınlamak için:

```bash
php artisan vendor:publish --provider="YourNamespace\YourPackageServiceProvider" --tag="your-package-views"
```

To publish translations:

Çevirileri yayınlamak için:

```bash
php artisan vendor:publish --provider="YourNamespace\YourPackageServiceProvider" --tag="your-package-translations"
```

To publish migrations:

Migrasyonları yayınlamak için:

```bash
php artisan vendor:publish --provider="YourNamespace\YourPackageServiceProvider" --tag="your-package-migrations"
```

To publish seeders:

Tohumlayıcıları yayınlamak için:

```bash
php artisan vendor:publish --provider="YourNamespace\YourPackageServiceProvider" --tag="your-package-seeders"
```

To publish factories:

Fabrikaları yayınlamak için:

```bash
php artisan vendor:publish --provider="YourNamespace\YourPackageServiceProvider" --tag="your-package-factories"
```

## Database / Veritabanı

Run migrations:

Migrasyonları çalıştırın:

```bash
php artisan migrate
```

## Usage / Kullanım

Once you've set up your package, you can use it as follows:

Paketinizi kurduktan sonra, şu şekilde kullanabilirsiniz:

```php
// Example code / Örnek kod
use YourNamespace\Facades\YourPackage;

YourPackage::doSomething();

// Get package version / Paket versiyonunu alma
$version = YourPackage::getVersion();
```

## Testing / Test

Run the tests:

Testleri çalıştırın:

```bash
composer test
```

## Troubleshooting / Sorun Giderme

If commands are not available after installation, try clearing the cache:

Yüklemeden sonra komutlar kullanılamıyorsa, önbelleği temizlemeyi deneyin:

```bash
php artisan optimize:clear
```

## Changelog / Değişiklik Kaydı

Please see [CHANGELOG.md](CHANGELOG.md) for more information on recent changes.

Son değişiklikler hakkında daha fazla bilgi için [CHANGELOG.md](CHANGELOG.md) dosyasına bakın.

## Contributing / Katkıda Bulunma

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

Detaylar için [CONTRIBUTING.md](CONTRIBUTING.md) dosyasına bakın.

## Security / Güvenlik

If you discover any security related issues, please email [yktibrahim@gmail.com](mailto:yktibrahim@gmail.com) instead of using the issue tracker.

Güvenlikle ilgili herhangi bir sorun keşfederseniz, lütfen sorun takibini kullanmak yerine [yktibrahim@gmail.com](mailto:yktibrahim@gmail.com) adresine e-posta gönderin.

## Credits / Teşekkürler

- [İbrahim Yakut](https://github.com/yktibrahim)
- [All Contributors](../../contributors)

## License / Lisans

The MIT License (MIT). Please see [License File](LICENSE) for more information.

MIT Lisansı (MIT). Daha fazla bilgi için lütfen [Lisans Dosyasına](LICENSE) bakın. 