# 🐟 Visi Vidi Vici 🐟

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Contributing

Thank you for considering contributing to the [Visi Vidi Vici website](https://visi-vidi-vici.tangue.fr)! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

### Aides au développement
https://github.com/barryvdh/laravel-ide-helper est intégré au _composer.json_ pour le dev.
Elle permet de générer automatiquement la documentation des models pour aider l’ide.
Pour mettre à jour les models : `php artisan ide-helper:models -W -R`


## Code of Conduct

In order to ensure that the Visi Vidi Vici community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Visi Vidi Vici, please send an e-mail to Benoit VRIGNAUD via [benoit.vrignaud@tangue.fr](mailto:benoit.vrignaud@tangue.fr).
All security vulnerabilities will be promptly addressed.

## License

The Visi Vidi Vici website is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

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
