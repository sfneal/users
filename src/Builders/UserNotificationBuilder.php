<?php

namespace Sfneal\Users\Builders;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Sfneal\Builders\QueryBuilder;
use Sfneal\Users\Builders\Interfaces\WhereUserInterface;
use Sfneal\Users\Builders\Traits\WhereUser;
use Sfneal\Users\Models\UserNotification;

class UserNotificationBuilder extends QueryBuilder implements WhereUserInterface
{
    use WhereUser;

    /**
     * @var EloquentModel|UserNotification
     */
    protected $targetModel = UserNotification::class;

    /**
     * Scope Query to UserNotification's of a certain 'type'.
     *
     * @param string $type
     * @param string $operator
     * @param string $boolean
     *
     * @return $this
     */
    public function whereType(string $type, string $operator = '=', string $boolean = 'and')
    {
        $this->where('type', $operator, $type, $boolean);

        return $this;
    }
}
