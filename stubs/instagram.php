<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Instagram Token
    |--------------------------------------------------------------------------
    |
    | Your Instagram application you received after creating
    | the messenger page / application on Instagram.
    |
    */
    'token' => env('INSTAGRAM_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Instagram App Secret
    |--------------------------------------------------------------------------
    |
    | Your Instagram application secret, which is used to verify
    | incoming requests from Instagram.
    |
    */
    'app_secret' => env('INSTAGRAM_APP_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Instagram Verification
    |--------------------------------------------------------------------------
    |
    | Your Instagram verification token, used to validate the webhooks.
    |
    */
    'verification' => env('INSTAGRAM_VERIFICATION'),

    /*
    |--------------------------------------------------------------------------
    | Instagram Start Button Payload
    |--------------------------------------------------------------------------
    |
    | The payload which is sent when the Get Started Button is clicked.
    |
    */
    'start_button_payload' => 'GET_STARTED',

    /*
    |--------------------------------------------------------------------------
    | Instagram Greeting Text
    |--------------------------------------------------------------------------
    |
    | Your Instagram Greeting Text which will be shown on your message start screen.
    |
    */
    'greeting_text' => [
        'greeting' => [
            [
                'locale' => 'default',
                'text' => 'Hello!',
            ],
            [
                'locale' => 'en_US',
                'text' => 'Timeless apparel for the masses.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Instagram Persistent Menu
    |--------------------------------------------------------------------------
    |
    | Example items for your persistent Instagram menu.
    | See https://developers.facebook.com/docs/messenger-platform/reference/messenger-profile-api/persistent-menu/#example
    |
    */
    'persistent_menu' => [
        [
            'locale' => 'default',
            'composer_input_disabled' => 'true',
            'call_to_actions' => [
                [
                    'title' => 'My Account',
                    'type' => 'nested',
                    'call_to_actions' => [
                        [
                            'title' => 'Pay Bill',
                            'type' => 'postback',
                            'payload' => 'PAYBILL_PAYLOAD',
                        ],
                    ],
                ],
                [
                    'type' => 'web_url',
                    'title' => 'Latest News',
                    'url' => 'http://botman.io',
                    'webview_height_ratio' => 'full',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Instagram Domain Whitelist
    |--------------------------------------------------------------------------
    |
    | In order to use domains you need to whitelist them
    |
    */
    'whitelisted_domains' => [
        'https://petersfancyapparel.com',
    ],
];
