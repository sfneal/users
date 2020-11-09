<?php

namespace Sfneal\Users\Builders;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Sfneal\Builders\QueryBuilder;
use Sfneal\Users\Builders\Interfaces\WhereUserInterface;
use Sfneal\Users\Models\User;
use Sfneal\Users\Scopes\UserActiveScope;

class UserBuilder extends QueryBuilder implements WhereUserInterface
{
    /**
     * @var string MySQL select objects to be queried in a raw json return
     */
    protected $selectRawJson;

    /**
     * @var Model|User
     */
    protected $targetModel = User::class;

    /**
     * UserBuilder constructor.
     *
     * @param Builder $query
     */
    public function __construct(Builder $query)
    {
        parent::__construct($query);
        $this->setSelectRawJson();
    }

    /**
     * Retrieve the User model's 'name' attribute by concatenating first and last name columns.
     *
     * @return string
     */
    private function concatName(): string
    {
        return $this->concatColumns('first_name', 'last_name');
    }

    /**
     * Retrieve the User model's 'name' attribute by concatenating nickname and last name columns.
     *
     * @return string
     */
    private function concatNickname(): string
    {
        return $this->concatColumns('nickname', 'last_name');
    }

    /**
     * Dynamically set the $selectRawJson.
     *
     * @return void
     */
    private function setSelectRawJson(): void
    {
        $raw = "{$this->tableName}.{$this->primaryKeyName} as id, ";
        $raw .= $this->ifStatement(
            "nickname is not null and {$this->tableName}.nickname_preferred=1",
            $this->concatNickname(),
            $this->concatName()
        );
        $raw .= ' as text';
        $this->selectRawJson = $raw;
    }

    /**
     * Find a User.
     *
     * @param int $user_id
     *
     * @return $this
     */
    public function whereUser(int $user_id)
    {
        $this->where('id', '=', $user_id);

        return $this;
    }

    /**
     * Scope query to activity that was performed by any of the specified users.
     *
     * @param array $user_ids
     *
     * @return $this|WhereUserInterface
     */
    public function whereUserIn(array $user_ids)
    {
        $this->whereIn('id', $user_ids);

        return $this;
    }

    /**
     * Scope results to User's with a certain username.
     *
     * @param $value
     *
     * @return $this
     */
    public function whereUsername($value)
    {
        $this->where('username', '=', $value);

        return $this;
    }

    /**
     * Scope a query to User's with names starting with a particular string.
     *
     * @param string $name
     *
     * @return $this
     */
    public function whereNameLike(string $name)
    {
        // Full name like $name
        $this->whereNameLikeRaw($name);

        // Has nickname & nickname like $name
        $this->orWhere(function (self $builder) use ($name) {
            $builder->whereNotNull('nickname');
            $builder->whereNameLikeRaw($name, $this->concatNickname());
        });

        return $this;
    }

    /**
     * Add a whereNameLike scope with custom columns (like concatenated).
     *
     * @param string      $name
     * @param string|null $column
     *
     * @return $this
     */
    private function whereNameLikeRaw(string $name, string $column = null)
    {
        // Use concatName method if no $column was provided
        $this->whereRaw(($column ?? $this->concatName())." LIKE '%{$name}%'");

        return $this;
    }

    /**
     * Active Users.
     *
     * @param int $value
     *
     * @return $this
     */
    public function whereActive($value = 1)
    {
        $this->where('status', '=', $value);

        return $this;
    }

    /**
     * Inactive Users.
     *
     * @return $this
     */
    public function whereInactive()
    {
        $this->withInactive();
        $this->whereActive(0);

        return $this;
    }

    /**
     * Include 'inactive' users in collection.
     *
     * @return $this
     */
    public function withInactive()
    {
        $this->withoutGlobalScope(UserActiveScope::class);

        return $this;
    }

    /**
     * Retrieve all Users regardless of 'active status'.
     *
     * @param array $columns
     *
     * @return Collection
     */
    public function allWithInactive($columns = ['*'])
    {
        return $this->withInactive()->get($columns);
    }
}
