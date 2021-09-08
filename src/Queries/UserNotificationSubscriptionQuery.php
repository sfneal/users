<?php

namespace Sfneal\Users\Queries;

use Illuminate\Database\Eloquent\Collection;
use Sfneal\Caching\Traits\Cacheable;
use Sfneal\Helpers\Laravel\AppInfo;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\PostOffice\Notifications\Notification;
use Sfneal\Queries\Query;
use Sfneal\Users\Builders\UserBuilder;
use Sfneal\Users\Builders\UserNotificationBuilder;
use Sfneal\Users\Models\User;

class UserNotificationSubscriptionQuery extends Query
{
    use Cacheable;

    /**
     * @var string
     */
    private $notification;

    /**
     * UserNotificationSubscriptionQuery constructor.
     *
     * @param  Notification  $notification
     */
    public function __construct(Notification $notification)
    {
        // todo: refactor param to string?
        $this->notification = LaravelHelpers::getClassName($notification);
    }

    /**
     * Retrieve a Query builder.
     *
     * @return UserBuilder
     */
    protected function builder(): UserBuilder
    {
        return User::query();
    }

    /**
     * Retrieve a Collection of User's that are subscribed to a Notification.
     *
     *  - only return user 'Stephen Neal' if environment is not 'production'
     *
     * @return Collection
     */
    public function execute(): Collection
    {
        // Check if environment is NOT 'production' & and dev user_id is set
        if (! AppInfo::isEnvProduction() && ! is_null(config('users.notifications.dev_user_id'))) {
            return $this->builder()
                ->whereUser(config('users.notifications.dev_user_id'))
                ->get();
        }

        // Retrieve User's notification subscriptions
        else {
            return $this->builder()
                ->whereHas('notificationSubscriptions', function (UserNotificationBuilder $builder) {
                    $builder->whereType($this->notification);
                })
                ->get();
        }
    }

    /**
     * Retrieve the Query cache key.
     *
     * @return string
     */
    public function cacheKey(): string
    {
        return "user:notification:subscription:{$this->notification}";
    }
}
