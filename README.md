Laravel Trace to Slack
======================
[![License](https://poser.pugx.org/lfelin/laravel-tracetoslack/license)](https://packagist.org/packages/lfelin/laravel-tracetoslack)
[![Latest Stable Version](https://poser.pugx.org/lfelin/laravel-tracetoslack/v/stable)](https://packagist.org/packages/lfelin/laravel-tracetoslack)
___
## About
Trace to slack is a simple package for laravel to notify the errors of your application in slack https://slack.com/

## Installation

Pull this package in through Composer.

```js

    {
        "require": {
            "lfelin/laravel-tracetoslack": "0.*"
        }
    }

```

Dump your autoload
```
composer dump-autoload -o
```


### Laravel 5.* Integration

Add the service provider to your `config/app.php` file:

```php

    'providers'     => array(

        //...
        Lfelin\TraceToSlack\TraceToSlackServiceProvider::class,

    ),

```

In your `app/Exceptions/Handler.php` file:

Replace

```php
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
```


**by**

```php
use Lfelin\TraceToSlack\Handler as ExceptionHandler;
```

## Configuration

Publish configuration

```
php artisan vendor:publish
```

In your `config/tracetoslack.php` file configure the parameters. The parameter webhook_url is required :

```php

    return array(

        /*
         |--------------------------------------------------------------------------
         | Notify on debug
         |--------------------------------------------------------------------------
         | Default: false
         | The notifications are also sent if the debug mode is activated [true]
         |
         */

        'active_on_debug' => false,

        /*
         |--------------------------------------------------------------------------
         | Your private Webhook URL
         |--------------------------------------------------------------------------
         | [Required]
         | Eg: https://hooks.slack.com/services/XXX/XXX
         |
         */

        'webhook_url' => 'https://hooks.slack.com/services/XXX/XXX',

        /*
         |--------------------------------------------------------------------------
         | Username
         |--------------------------------------------------------------------------
         | [Optional]
         | Default: Jhon Bot
         |
         */

        'username' => '',

        /*
         |--------------------------------------------------------------------------
         | Emoji
         |--------------------------------------------------------------------------
         | [Optional]
         | Default: ':warning:'
         | http://www.emoji-cheat-sheet.com/ for example
         |
         */

        'icon_emoji' => '', //  default: ':bug:' => http://www.emoji-cheat-sheet.com/

        /*
         |--------------------------------------------------------------------------
         | Emoji Url
         |--------------------------------------------------------------------------
         | [Optional]
         | This param increase icon_emoji
         | https://slack.com/img/icons/app-57.png for example
         |
         */

        'icon_url' => '',

        /*
         |--------------------------------------------------------------------------
         | Other Channel
         |--------------------------------------------------------------------------
         | [Optional]
         | Default: The default channel is the one set in the web Hook
         | This name start by '#' or '@' for Direct Message
         | Eg: #general - @username
         |
         */

        'other_channel' => '',
    );

```

## Create Incoming WebHooks

Create a new webhook : https://my.slack.com/services/new/incoming-webhook/

Documentation : https://api.slack.com/custom-integrations

## Example on slack
![example](https://cloud.githubusercontent.com/assets/271214/16535835/0f837698-3feb-11e6-92b2-e0bdf74b580a.png)