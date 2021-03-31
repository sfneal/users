<?php

namespace Sfneal\Users\Services;

class OrganizationAddressService
{
    /**
     * Retrieve an Organization's full address.
     *
     * @return string|null
     */
    public static function full(): ?string
    {
        return self::street().', '.self::city().', '.self::state().' '.self::zip();
    }

    /**
     * Retrieve an Organization's street address.
     *
     * @return string|null
     */
    public static function street(): ?string
    {
        return config('users.org.address.street');
    }

    /**
     * Retrieve an Organization's city name.
     *
     * @return string|null
     */
    public static function city(): ?string
    {
        return config('users.org.address.city');
    }

    /**
     * Retrieve an Organization's state abbreviation.
     *
     * @return string|null
     */
    public static function state(): ?string
    {
        return config('users.org.address.state');
    }

    /**
     * Retrieve an Organization's zip code.
     *
     * @return string|null
     */
    public static function zip(): ?string
    {
        return config('users.org.address.zip');
    }
}
