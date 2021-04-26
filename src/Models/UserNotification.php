<?php

namespace Sfneal\Users\Models;

use Database\Factories\UserNotificationFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sfneal\Models\Model;
use Sfneal\Scopes\CreatedOrderScope;
use Sfneal\Users\Builders\UserNotificationBuilder;

class UserNotification extends Model
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

    protected $table = 'user_notification';
    protected $primaryKey = 'user_notification_id';

    protected $fillable = [
        'user_notification_id',
        'user_id',
        'type',
    ];

    /**
     * The attributes that should type cast.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return UserNotificationFactory
     */
    protected static function newFactory(): UserNotificationFactory
    {
        return new UserNotificationFactory();
    }

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
