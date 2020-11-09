<?php

namespace Sfneal\Users\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sfneal\Models\AbstractModel;
use Sfneal\Scopes\OrderScope;
use Sfneal\Users\Builders\RoleBuilder;

class Role extends AbstractModel
{
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

    protected $connection = 'mysql';
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
