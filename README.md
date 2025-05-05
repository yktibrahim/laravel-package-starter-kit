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
- Custom Artisan commands (Seed) / Özel Artisan komutları (Seed)
- Ready for testing with Orchestra Testbench / Orchestra Testbench ile test için hazır

## Installation / Kurulum

Install the package via Composer:

Paketi Composer ile yükleyin:

```bash
composer require laravel-package-starter-kit/laravel-package-starter-kit
```

**Laravel 12+** will auto-discover the package.

**Laravel 12+** paketi otomatik olarak keşfedecektir.

> **Not**: Paket yüklendikten sonra, varsa önbelleği temizlemeniz gerekebilir: `php artisan optimize:clear`

## Configuration / Yapılandırma

Publish the configuration file:

Yapılandırma dosyasını yayınlayın:

```bash
php artisan vendor:publish --provider="LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider" --tag="laravelpackagestarterkit-config"
```

To publish views:

Görünümleri yayınlamak için:

```bash
php artisan vendor:publish --provider="LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider" --tag="laravelpackagestarterkit-views"
```

To publish translations:

Çevirileri yayınlamak için:

```bash
php artisan vendor:publish --provider="LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider" --tag="laravelpackagestarterkit-translations"
```

To publish migrations:

Migrasyonları yayınlamak için:

```bash
php artisan vendor:publish --provider="LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider" --tag="laravelpackagestarterkit-migrations"
```

To publish seeders:

Tohumlayıcıları yayınlamak için:

```bash
php artisan vendor:publish --provider="LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider" --tag="laravelpackagestarterkit-seeders"
```

To publish factories:

Fabrikaları yayınlamak için:

```bash
php artisan vendor:publish --provider="LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider" --tag="laravelpackagestarterkit-factories"
```

## Database / Veritabanı

Run migrations:

Migrasyonları çalıştırın:

```bash
php artisan migrate
```

Run seeders:

Tohumlayıcıları çalıştırın:

```bash
php artisan laravelpackagestarterkit:seed
```

Run specific seeder:

Belirli bir tohumlayıcıyı çalıştırın:

```bash
php artisan laravelpackagestarterkit:seed --class=YourSpecificSeeder
```

## Usage / Kullanım

Usage instructions for the package.

Paket için kullanım talimatları.

```php
// Example code / Örnek kod
LaravelPackageStarterKit::doSomething();

// Get package version / Paket versiyonunu alma
$version = LaravelPackageStarterKit::getVersion();
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