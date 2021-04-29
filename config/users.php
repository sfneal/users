<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Organization
    |--------------------------------------------------------------------------
    |
    | Set an organization's name & logo as constants that can be accessed from
    | anywhere within your application.  Useful in public site footers or
    | assembling dynamic email footers.
    |
    */
    'org' => [
        // Organization's name
        'name' => null,

        // Organization's logo (image path)
        'logo' => null,

        // Organization's physical address
        'address' => [
            'street' => null,
            'city' => null,
            'state' => null,
            'zip' => null,
        ],

        // Organization's phone number (xxx-xxx-xxxx)
        'phone' => null,

        // Organization's general contact email address
        'email' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | User Notifications
    |--------------------------------------------------------------------------
    |
    | It's often useful to prevent User's from receiving notifications sent
    | from a non-production version of your application (development).  This
    | option allows you redirect notifications that would normally be sent to
    | user's to a developer.
    |
    | When 'notifications.dev_user_id' is not set to an integer or array of integer,
    | UserNotification subscriptions behave as they would in a 'production'
    | environment.
    |
    */
    'notifications' => [
        'dev_user_id' => null
    ],
];
