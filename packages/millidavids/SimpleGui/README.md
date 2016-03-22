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
