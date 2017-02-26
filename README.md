# laravel-eloquent-counter

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A view and like counter extension for Eloquent models

## Install

Via Composer

``` bash
$ composer require ashishov/laravel-eloquent-counter
```

Add the service provider in `app/config/app.php`:

```php
Ashishov\EloquentCounter\ServiceProvider::class,
```

```bash
php artisan vendor:publish
```

Now you can migrate:

```bash
php artisan migrate
```

```php
class Object extends Eloquent {
  use Ashishov\EloquentCounter\Countable;
}
```
## Usage

```php
$object->view();
```

**Get count of Views

```php
$object->views_count();
```

**Did the user viewed the object?

```php
$object->isViewed();
```


**Increment the LikeCounter in a Controller (show action)
```php
$object->like();
```

**Unlike
```php
$object->unlike();
```

**Get count of Likes

```php
$object->likes_count();
```

**Did the user liked the object?

```php
$object->isLiked();
```

## Credits

- [Alex][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/ashishov/laravel-eloquent-counter.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/ashishov/laravel-eloquent-counter/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/ashishov/laravel-eloquent-counter.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/ashishov/laravel-eloquent-counter.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ashishov/laravel-eloquent-counter.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ashishov/laravel-eloquent-counter
[link-travis]: https://travis-ci.org/ashishov/laravel-eloquent-counter
[link-scrutinizer]: https://scrutinizer-ci.com/g/ashishov/laravel-eloquent-counter/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/ashishov/laravel-eloquent-counter
[link-downloads]: https://packagist.org/packages/ashishov/laravel-eloquent-counter
[link-author]: https://github.com/ashishov
[link-contributors]: ../../contributors
