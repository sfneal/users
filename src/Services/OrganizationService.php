<?php

namespace Sfneal\Users\Services;

class OrganizationService
{
    /**
     * Retrieve the Organization's name.
     *
     * @return string|null
     */
    public static function name(): ?string
    {
        return config('users.org.name');
    }

    /**
     * Retrieve the Organization's logo.
     *
     * @return string|null
     */
    public static function logo(): ?string
    {
        return config('users.org.logo');
    }

    /**
     * Retrieve an OrganizationAddressService instance for accessing the address.
     *
     * @return OrganizationAddressService
     */
    public static function address(): OrganizationAddressService
    {
        return new OrganizationAddressService();
    }

    /**
     * Retrieve the Organization's phone number.
     *
     * @param  bool  $href
     * @return string|null
     */
    public static function phone(bool $href = false): ?string
    {
        // Return a phone href
        if ($href) {
            return 'tel:+'.str_replace('-', '', config('users.org.phone'));
        }

        // Only return the phone number
        return config('users.org.phone');
    }

    /**
     * Retrieve the Organization's email address.
     *
     * @param  bool  $href
     * @return string|null
     */
    public static function email(bool $href = false): ?string
    {
        // Return a phone href
        if ($href) {
            return 'mailto:'.config('users.org.email');
        }

        // Only return the phone number
        return config('users.org.email');
    }
}
