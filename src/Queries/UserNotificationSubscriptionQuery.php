<?php

namespace Sfneal\Users\Queries;

use Sfneal\Users\Builders\UserNotificationBuilder;
use Sfneal\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Sfneal\Caching\Traits\Cacheable;
use Sfneal\PostOffice\Notifications\AbstractNotification;
use Sfneal\Queries\AbstractQuery;

class UserNotificationSubscriptionQuery extends AbstractQuery
{
    use Cacheable;

    /**
     * @var string
     */
    private $notification;

    /**
     * UserNotificationSubscriptionQuery constructor.
     *
     * @param AbstractNotification $notification
     */
    public function __construct(AbstractNotification $notification)
    {
        $this->notification = getClassName($notification);
    }

    /**
     * Retrieve a Collection of User's that are subscribed to a Notification.
     *
     *  - only return user 'Stephen Neal' if environment is not 'production'
     *
     * @return Collection|int|mixed
     */
    public function execute()
    {
        // Production environment
        if (env('APP_ENV') == 'production') {
            return User::query()
                ->whereHas('notificationSubscriptions', function (UserNotificationBuilder $builder) {
                    $builder->whereType($this->notification);
                })
                ->get();
        }

        // Development environment
        else {
            return User::query()
                ->whereUser(38)
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
        return "user:notification:subscription#{$this->notification}";
    }
}
