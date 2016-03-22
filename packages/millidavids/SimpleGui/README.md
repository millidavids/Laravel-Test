# millidavids\SimpleGui

## Install

Add package directory to app root directory.

Include the package in your autoload section of composer.json.

``` json
"autoload": {
        "classmap": [
            "database"
        ],
        "psr-4": {
            "millidavids\\SimpleGui\\": "packages/millidavids/SimpleGui/src",
            "App\\": "app/"
        }
    },
```

Add the provider to your config/app.php.

``` php
'providers' => [
    ...
    millidavids\SimpleGui\SimpleGuiServiceProvider::class,
]
```

To get the package assets, publish them:

``` bash
php artisan vendor:publish
```

... then add them to your application.

``` php
<link rel="stylesheet" href="{{ URL::asset('vendor/SimpleGui/css/package.css') }}">
...
<script href="{{ URL::asset('vendor/SimpleGui/javascript/package.js') }}"></script>
```

## Usage

### Table

Pass in a multidimensional array and variable options for formatting the table.

```{!! millidavids\SimpleGui\ViewRenderer::table($array, $options) !!}```

### Dropdown

Pass in an associative array and the default selected menu item.

```{!! millidavids\SimpleGui\ViewRenderer::dropdown($array, $selected) !!}```

### Link

Pass in the link text, the link target, and variable options.

```{!! millidavids\SimpleGui\ViewRenderer::link($text, $target, $options) !!}```

### TextField

Pass in a field name and default data to display and variable options.

```{!! millidavids\SimpleGui\ViewRenderer::textfield($name, $data, $options) !!}```

### Label

Pass in the text content and the for attribute as well as variable options.

```{!! millidavids\SimpleGui\ViewRenderer::label($text, $for, $options) !!}```