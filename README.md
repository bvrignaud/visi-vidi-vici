# 🐟 Visi Vidi Vici 🐟

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

**Welcome to Visi-vidi-vici!**
Visi-vidi-vici is a marine weather forecasting application for determining water clarity for all divers.

## Installation

Visi-vidi-vici is a regular Laravel application; it's build on top of Laravel 11 and uses Inertia / Vue / Tailwind CSS
for the frontend.

In terms of local development, you can use the following requirements:

- PHP 8.4 - with SQLite, and other common extensions.
- Node.js 22 or more recent.

If you have these requirements, you can start by cloning the repository and installing the dependencies:

```bash
git clone https://github.com/bvrignaud/visi-vidi-vici.git

cd visi-vidi-vici
```

Next, install the dependencies using [Composer](https://getcomposer.org) and [pnpm](https://pnpm.io):

```bash
composer install

pnpm install
```

After that, set up your `.env` file:

```bash
cp .env.example .env

php artisan key:generate
```

Prepare your database and run the migrations:

```bash
touch database/database.sqlite

php artisan migrate --seed
```

Link the storage to the public folder:

```bash
php artisan storage:link
```

In a **separate terminal**, build the assets in watch mode:

```bash
pnpm run dev
```

Also in a **separate terminal**, run the queue worker:

```bash
php artisan queue:work
```

Finally, start the development server:

```bash
php artisan serve
```

Once you are done with the code changes, be sure to run the test suite to ensure everything is still working:

```bash
php artisan test
```

## Contributing

Thank you for considering contributing to the [Visi Vidi Vici website](https://visi-vidi-vici.tangue.fr)! The
contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

> **Don't push directly to the `main` branch**. Instead, create a new branch and push it to your branch.

```bash
git clone https://github.com/bvrignaud/visi-vidi-vici.git

cd visi-vidi-vici

git checkout -b feat/your-feature # or fix/your-fix
```

## Tooling

Visi-vidi-vici uses a few tools to ensure the code quality and consistency.

In terms of code style, we use [Laravel Pint](https://laravel.com/docs/11.x/pint) to ensure the code is consistent and
follows the Laravel conventions.

You run these tools individually using the following commands:

```bash
# Run the test suite
php artisan test
```

#### [PHP Insights](https://phpinsights.com)

```bash
php artisan insights
```

#### [Larastan](https://github.com/nunomaduro/larastan)

```bash
./vendor/bin/phpstan analyse
```

#### Code style fixer ([pint](https://laravel.com/docs/9.x/pint))

```bash
composer pintd
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
