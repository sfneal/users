<?php

namespace Sfneal\Users\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sfneal\Models\AbstractModel;
use Sfneal\Scopes\CreatedOrderScope;
use Sfneal\Users\Builders\UserNotificationBuilder;

class UserNotification extends AbstractModel
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Query scopes
        static::addGlobalScope(new CreatedOrderScope());
    }

    protected $connection = 'mysql';
    protected $table = 'user_notification';
    protected $primaryKey = 'user_notification_id';

    protected $fillable = [
        'user_notification_id',
        'user_id',
        'type',
    ];

    /**
     * Query Builder.
     *
     * @param $query
     *
     * @return UserNotificationBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new UserNotificationBuilder($query);
    }

    /**
     * Custom query Builder.
     *
     * @return UserNotificationBuilder|Builder
     */
    public static function query(): UserNotificationBuilder
    {
        return parent::query();
    }

    /**
     * User model this notification subscription belongs to.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
