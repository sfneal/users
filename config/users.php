<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sfneal Users options
    |--------------------------------------------------------------------------
    |
    | Set an organization's name & logo as constants that can be accessed from
    | anywhere within your application.  Useful in public site footers or
    | assembling dynamic email footers.
    |
    */

    // Organization
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

];
