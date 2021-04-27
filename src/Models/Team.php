<?php

namespace Sfneal\Users\Models;

use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sfneal\Models\Model;
use Sfneal\Models\Traits\CacheableAll;
use Sfneal\Scopes\OrderScope;
use Sfneal\Users\Scopes\UserActiveScope;

// todo: make use of this once sfneal/files packages is published
class Team extends Model
{
    use CacheableAll;
    use HasFactory;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Query scopes
        static::addGlobalScope(new OrderScope('order', 'asc'));
    }

    protected $table = 'team';
    protected $primaryKey = 'team_id';

    protected $fillable = [
        'team_id',
        'user_id',
        'order',
    ];

    /**
     * @var array Relationships that should be eager loaded with every query
     */
    protected $with = [
        'user',
    ];

    /**
     * The attributes that should type cast.
     *
     * @var array
     */
    protected $casts = [
        'team_id' => 'int',
        'user_id' => 'int',
        'order' => 'int',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return TeamFactory
     */
    protected static function newFactory(): TeamFactory
    {
        return new TeamFactory();
    }

    /**
     * Team member's 'user' relationship.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
            ->withoutGlobalScope(UserActiveScope::class);
    }
}
