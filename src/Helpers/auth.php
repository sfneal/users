<?php

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Retrieve the active User.
 *
 * @return Authenticatable|null
 */
function activeUser()
{
    return auth()->user();
}

/**
 * Retrieve the active user's user_id.
 *
 * @return int|string|null
 */
function activeUserID()
{
    return (auth()->user()) ? auth()->id() : null;
}

/**
 * Retrieve the active user's name.
 *
 * @return string|null
 */
function activeUserName()
{
    return (auth()->user()) ? auth()->user()->name : null;
}

/**
 * Check if the active user has a particular role or retrieve the active user's role name.
 *
 * @param string|int|null $role
 *
 * @return string|bool|null
 */
function activeUserRole($role = null)
{
    // Determine if the active user has a particular 'role name'
    if (isset($role) && is_int($role)) {
        return activeUser()->isRoleId($role);
    }

    // Determine if the active user has a particular 'role_id'
    elseif (isset($role) && is_string($role)) {
        return activeUser()->isRole($role);
    }

    // Return Active User's role name
    else {
        return (activeUser()) ? activeUser()->role->name : null;
    }
}

/**
 * Determine if a User is an admin or is the active user.
 *
 * @param int $user_id
 *
 * @return bool
 */
function isAdminOrActiveUser(int $user_id): bool
{
    return activeUser()->isAdmin() || isActiveUser($user_id);
}

/**
 * Determine if a $user_id is the active user.
 *
 * @param int $user_id
 * @return bool
 */
function isActiveUser(int $user_id): bool
{
    return activeUserID() == $user_id;
}
