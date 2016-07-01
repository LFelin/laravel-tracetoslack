Laravel Trace to Slack
======================

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

*use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;*

by

*use Lfelin\TraceToSlack\Handler as ExceptionHandler;*


## Configuration

Publish configuration

```
php artisan vendor:publish
```

In your `config/tracetoslack` file configure the parameters. The parameter webhook_url is required :

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