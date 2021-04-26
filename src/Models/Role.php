<?php

namespace Sfneal\Users\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sfneal\Models\Model;
use Sfneal\Scopes\OrderScope;
use Sfneal\Users\Builders\RoleBuilder;

class Role extends Model
{
    use HasFactory;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Global scopes
        static::addGlobalScope(new OrderScope('order', 'asc'));
    }

    protected $table = 'role';
    protected $primaryKey = 'role_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'type',
        'name',
        'description',
        'class',
        'order',
    ];

    /**
     * The attributes that should type cast.
     *
     * @var array
     */
    protected $casts = [
        'order' => 'int',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return RoleFactory
     */
    protected static function newFactory(): RoleFactory
    {
        return new RoleFactory();
    }

    /**
     * Query Builder.
     *
     * @param $query
     *
     * @return RoleBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new RoleBuilder($query);
    }

    /**
     * Custom Role query Builder.
     *
     * @return RoleBuilder|Builder
     */
    public static function query(): RoleBuilder
    {
        return parent::query();
    }

    /**
     * 'users' with roles.
     *
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id')
            ->where('type', '=', 'user');
    }

    /**
     * Retrieve the 'class' attribute with a default value.
     *
     * @param null $value
     *
     * @return string
     */
    public function getClassAttribute($value = null): string
    {
        return 'label label-'.($value ?? 'default');
    }
}
