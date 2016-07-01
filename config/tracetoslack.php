<?php

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

    'webhook_url' => '',

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

    'icon_emoji' => '', //  default: ':warning:' => http://www.emoji-cheat-sheet.com/

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
