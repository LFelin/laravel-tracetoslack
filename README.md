Laravel Trace to Slack for Laravel 4.2
======================
[![License](https://poser.pugx.org/lfelin/laravel-tracetoslack/license)](https://packagist.org/packages/lfelin/laravel-tracetoslack)
[![Latest Stable Version](https://poser.pugx.org/lfelin/laravel-tracetoslack/v/stable)](https://packagist.org/packages/lfelin/laravel-tracetoslack)
[![Total Downloads](https://poser.pugx.org/lfelin/laravel-tracetoslack/downloads)](https://packagist.org/packages/lfelin/laravel-tracetoslack)
___

#### **For Laravel 5, use the** [1.0 branch](https://github.com/LFelin/laravel-tracetoslack/)
___
## About
Trace to slack is a simple package for laravel to notify the errors of your application in slack https://slack.com/

## Installation

Pull this package in through Composer.

```js

    {
        "require": {
            "lfelin/laravel-tracetoslack": "^4.2"
        }
    }

```

Dump your autoload
```
composer dump-autoload
```


### Laravel 5.* Integration

Add the service provider to your `app/config/app.php` file:

```php

    'providers'     => array(

        //...
        Lfelin\TraceToSlack\TraceToSlackServiceProvider,

    ),

```

In your `app/start/global.php` file:

Add

```php
<?php
use Lfelin\TraceToSlack\Facades\TraceToSlack;
```


**and add** ```TraceToSlack::trace($exception); to App:error```

```php
/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
    TraceToSlack::trace($exception);
	Log::error($exception);
});
```

## Configuration

Publish configuration

```
php artisan config:publish lfelin/laravel-tracetoslack
```

In your `app/config/packages/lfelin/laravel-tracetoslack/tracetoslack.php` file configure the parameters. The parameter **webhook_url** is required :

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
         | Default: John Bot
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
![example](https://cloud.githubusercontent.com/assets/271214/16838122/e547de1e-49c7-11e6-96b4-9639420fe5af.png)

## Suggestions and issues
Use [github issues](https://github.com/LFelin/laravel-tracetoslack/issues/new) to suggest improvements or reassembling your problems