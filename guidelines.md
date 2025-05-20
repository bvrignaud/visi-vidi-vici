# Project Guidelines

This document provides guidelines for development on this project. It is intended for advanced developers and focuses on
project-specific information.

Visi-vidi-vici is a regular Laravel application; it's build on top of Laravel 12 and uses Inertia / Vue / Tailwind CSS
for the frontend.

## Build/Configuration Instructions

### Requirements

- PHP 8.4+
- Node.js 18.0+ (Node 22.14.0 recommended via Volta)
- PNPM 10.7.0 (recommended via Volta)
- database : SQLite or other db

### Setup

1. Clone the repository
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install JavaScript dependencies:
   ```bash
   pnpm install
   ```
4. Copy `.env.example` to `.env` and configure your environment variables
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
7. Link the storage to the public folder:
    ```bash
    php artisan storage:link
    ```

### Development

- Start the development server:
  ```bash
  php artisan serve
  ```
- Start the Vite development server:
  ```bash
  pnpm dev
  ```

### Building for Production

- Build the frontend assets:
  ```bash
  pnpm build
  ```

## Development Guidelines

### Project Structure

- This is a Laravel project with Vue.js + Inertia.js frontend
- Uses Tailwind CSS for styling
- Uses TypeScript for type safety
- Uses Leaflet for maps functionality
- Supports internationalization via laravel-vue-i18n

### Code Style

#### PHP

- The project uses Laravel Pint for PHP code formatting
- Strict types are enforced
- Run Pint to format PHP code:
  ```bash
  ./vendor/bin/pint --dirty
  ```
- [Larastan](https://github.com/nunomaduro/larastan)
  ```bash
  ./vendor/bin/phpstan analyse
  ```
- [PHP Insights](https://phpinsights.com)
  ```bash
  php artisan insights
  ```

#### JavaScript/TypeScript/Vue

- The project uses ESLint and Prettier for JavaScript/TypeScript/Vue code formatting
- Vue components use the Composition API
- Format code:
  ```bash
  pnpm format
  ```
- Check formatting:
  ```bash
  pnpm format:check
  ```
- Lint code:
  ```bash
  pnpm lint
  ```

## Testing Information

### PHP Testing

The project uses PHPUnit for PHP testing with two main test suites:

- **Unit Tests**: Located in `tests/Unit/`
- **Feature Tests**: Located in `tests/Feature/`

#### Running Tests

- Run all tests:
  ```bash
  php artisan test
  # or
  ./vendor/bin/phpunit
  ```
- Run all tests in parallel:
  ```bash
  php artisan test --parallel
  # or
  ./vendor/bin/phpunit --parallel
  ```
- Run a specific test file:
  ```bash
  php artisan test tests/Unit/ExampleTest.php
  # or
  ./vendor/bin/phpunit tests/Unit/ExampleTest.php
  ```
- Run tests with a specific filter:
  ```bash
  php artisan test --filter test_example
  ```

#### Creating New Tests

1. For unit tests, extend `PHPUnit\Framework\TestCase`:
   ```php
   <?php

   declare(strict_types=1);

   namespace Tests\Unit;

   use PHPUnit\Framework\TestCase;
   use PHPUnit\Framework\Attributes\Test;

   class ExampleTest extends TestCase
   {
       #[Test]
       public function test_example(): void
       {
           $this->assertTrue(true);
       }
   }
   ```

2. For feature tests, extend `Tests\Feature\AbstractFeatureTestCase`:
   ```php
   <?php

   declare(strict_types=1);

   namespace Tests\Feature;

   use PHPUnit\Framework\Attributes\Test;

   class ExampleFeatureTest extends AbstractFeatureTestCase
   {
       #[Test]
       public function test_example_feature(): void
       {
           $response = $this->get('/');
           $response->assertStatus(200);
       }
   }
   ```

### JavaScript/Vue Testing

Currently, the project does not have a configured JavaScript testing setup. If needed, consider adding Jest or Vitest
for Vue component testing.

### Database

- For testing, SQLite in-memory database is used
- The `RefreshDatabase` trait is used in feature tests to reset the database between tests
- Database seeders are automatically run before each feature test
