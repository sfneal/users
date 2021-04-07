<?php

namespace Sfneal\Users\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Scope;
use Sfneal\Users\Builders\UserBuilder;

class UserActiveScope implements Scope
{
    /**
     * Order results by creation time (newest to oldest).
     *
     * @param Builder|UserBuilder $builder
     * @param EloquentModel       $model
     *
     * @return void
     */
    public function apply(Builder $builder, EloquentModel $model)
    {
        $builder->whereActive();
    }
}
