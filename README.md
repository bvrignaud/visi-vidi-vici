# 🐟 Visi Vidi Vici 🐟

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

**Welcome to Visi-vidi-vici!**
Visi-vidi-vici is a marine weather forecasting application for determining water clarity for all divers.

## [Project Guidelines](./guidelines.md)

## Contributing

Thank you for considering contributing to the [Visi Vidi Vici website](https://visi-vidi-vici.tangue.fr)! The
contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

> **Don't push directly to the `main` branch**. Instead, create a new branch and push it to your branch.

```bash
git clone https://github.com/bvrignaud/visi-vidi-vici.git

cd visi-vidi-vici

git checkout -b feat/your-feature # or fix/your-fix
```

## Code of Conduct

In order to ensure that the Visi Vidi Vici community is welcoming to all, please review and abide by
the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Visi Vidi Vici, please send an e-mail to Benoit VRIGNAUD
via [benoit.vrignaud@tangue.fr](mailto:benoit.vrignaud@tangue.fr).
All security vulnerabilities will be promptly addressed.

## License

The Visi Vidi Vici website is open-sourced software licensed under
the [MIT license](https://opensource.org/licenses/MIT).

## Deploy script

```bash
cd DEPPLOY_FOLDER
git pull origin master
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
echo "" | sudo -S service php8.0-fpm reload
pnpm install
pnpm run production

echo "🚀 Application deployed!"

php artisan route:cache
php artisan view:clear
php artisan migrate --force
```
