# Laravel Package Starter Kit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-package-starter-kit/laravel-package-starter-kit.svg?style=flat-square)](https://packagist.org/packages/laravel-package-starter-kit/laravel-package-starter-kit)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-package-starter-kit/laravel-package-starter-kit.svg?style=flat-square)](https://packagist.org/packages/laravel-package-starter-kit/laravel-package-starter-kit)
[![License](https://img.shields.io/packagist/l/laravel-package-starter-kit/laravel-package-starter-kit.svg?style=flat-square)](https://packagist.org/packages/laravel-package-starter-kit/laravel-package-starter-kit)
[![GitHub release](https://img.shields.io/github/release/yktibrahim/laravel-package-starter-kit.svg?style=flat-square)](https://github.com/yktibrahim/laravel-package-starter-kit/releases)
[![GitHub stars](https://img.shields.io/github/stars/yktibrahim/laravel-package-starter-kit.svg?style=flat-square)](https://github.com/yktibrahim/laravel-package-starter-kit/stargazers)

Professional starter kit for creating Laravel packages with all necessary boilerplate.

Laravel paketleri oluşturmak için gerekli tüm hazır kodlarla profesyonel bir başlangıç kiti.

## Installation / Kurulum

Install the package via Composer:

Paketi Composer ile yükleyin:

```bash
composer require laravel-package-starter-kit/laravel-package-starter-kit
```

**Laravel 5.5+** will auto-discover the package.

**Laravel 5.5+** paketi otomatik olarak keşfedecektir.

For Laravel < 5.5, register the service provider and facade manually in `config/app.php`:

Laravel < 5.5 için, servis sağlayıcı ve facade'i `config/app.php` dosyasında manuel olarak kaydedin:

```php
'providers' => [
    // ...
    LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider::class,
];

'aliases' => [
    // ...
    'LaravelPackageStarterKit' => LaravelPackageStarterKit\Facades\LaravelPackageStarterKit::class,
];
```

## Configuration / Yapılandırma

Publish the configuration file:

Yapılandırma dosyasını yayınlayın:

```bash
php artisan vendor:publish --provider="LaravelPackageStarterKit\LaravelPackageStarterKitServiceProvider" --tag="config"
```

## Usage / Kullanım

Usage instructions for the package.

Paket için kullanım talimatları.

```php
// Example code / Örnek kod
LaravelPackageStarterKit::doSomething();
```

## Testing / Test

Run the tests:

Testleri çalıştırın:

```bash
composer test
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