<?php

namespace Sfneal\Users\Builders;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as EloquentModel;
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
     * @var EloquentModel|User
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
     * Find a User.
     *
     * @param int $user_id
     * @param string $operator
     * @param string $boolean
     * @return $this
     */
    public function whereUser(int $user_id, string $operator = '=', string $boolean = 'and'): self
    {
        $this->where('id', $operator, $user_id, $boolean);

        return $this;
    }

    /**
     * Exclude a User.
     *
     * @param int $user_id
     * @param string $boolean
     * @return $this
     */
    public function whereUserNot(int $user_id, string $boolean = 'and'): self
    {
        $this->whereUser($user_id, '!=', $boolean);

        return $this;
    }

    /**
     * Scope query to User's that have an 'id' found in the array of $user_ids.
     *
     * @param array $user_ids
     * @param string $boolean
     * @param bool $not
     * @return $this|WhereUserInterface
     */
    public function whereUserIn(array $user_ids, string $boolean = 'and', bool $not = false): self
    {
        $this->whereIn('id', $user_ids, $boolean, $not);

        return $this;
    }

    /**
     * Scope query to User's that does NOT have 'id' found in the array of $user_ids.
     *
     * @param array $user_ids
     * @param string $boolean
     * @return $this|WhereUserInterface
     */
    public function whereUserNotIn(array $user_ids, string $boolean = 'and'): self
    {
        $this->whereUserIn($user_ids, $boolean, true);

        return $this;
    }

    /**
     * Scope results to User's with a certain username.
     *
     * @param $value
     *
     * @return $this
     */
    public function whereUsername($value): self
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
    public function whereNameLike(string $name): self
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
    private function whereNameLikeRaw(string $name, string $column = null): self
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
    public function whereActive($value = 1): self
    {
        $this->where('status', '=', $value);

        return $this;
    }

    /**
     * Scope query results to User's with a particular 'role_id'.
     *
     * @param int $role_id
     * @param string $operator
     * @param string $boolean
     * @return $this
     */
    public function whereRole(int $role_id, string $operator = '=', string $boolean = 'and'): self
    {
        $this->where('role_id', $operator, $role_id, $boolean);

        return $this;
    }

    /**
     * Scope query results to User's without a particular 'role_id'.
     *
     * @param int $role_id
     * @param string $boolean
     * @return $this
     */
    public function whereRoleNot(int $role_id, string $boolean = 'and'): self
    {
        $this->where('role_id', '!=', $role_id, $boolean);

        return $this;
    }

    /**
     * Scope query results to User's with a 'role_id' found in the array of $role_ids.
     *
     * @param array $role_ids
     * @param string $boolean
     * @param bool $not
     * @return $this
     */
    public function whereRoleIn(array $role_ids, string $boolean = 'and', bool $not = false): self
    {
        $this->whereIn('role_id', $role_ids, $boolean, $not);

        return $this;
    }

    /**
     * Scope query results to User's with a 'role_id' that is NOT found in the array of $role_ids.
     *
     * @param array $role_ids
     * @param string $boolean
     * @return $this
     */
    public function whereRoleNotIn(array $role_ids, string $boolean = 'and'): self
    {
        $this->whereIn('role_id', $role_ids, $boolean, true);

        return $this;
    }

    /**
     * Add a `whereRole()` clause to query using the 'or' boolean.
     *
     * @param int $role_id
     * @param string $operator
     * @return $this
     */
    public function orWhereRole(int $role_id, string $operator = '='): self
    {
        $this->whereRole($role_id, $operator, 'or');

        return $this;
    }

    /**
     * Scope query results to User's with a particular role 'name'.
     *
     * @param string $role_name
     * @param string $operator
     * @param int $count
     * @return $this
     */
    public function whereRoleName(string $role_name, string $operator = '>=', int $count = 1): self
    {
        $this->whereHasRole(function (RoleBuilder $builder) use ($role_name) {
            $builder->whereName($role_name);
        }, $operator, $count);

        return $this;
    }

    /**
     * Scope query results to Role's that do NOT have a particular role 'name'.
     *
     * @param string $role_name
     * @param string $operator
     * @param int $count
     * @return $this
     */
    public function whereRoleNameNot(string $role_name, string $operator = '>=', int $count = 1): self
    {
        $this->whereHasRole(function (RoleBuilder $builder) use ($role_name) {
            $builder->whereNameNot($role_name);
        }, $operator, $count);

        return $this;
    }

    /**
     * Scope query results to User's with role names that are in the array of $role_names.
     *
     * @param array $role_names
     * @param string $operator
     * @param int $count
     * @return $this
     */
    public function whereRoleNameIn(array $role_names, string $operator = '>=', int $count = 1): self
    {
        $this->whereHasRole(function (RoleBuilder $builder) use ($role_names) {
            $builder->whereNameIn($role_names);
        }, $operator, $count);

        return $this;
    }

    /**
     * Scope query results to User's with role names that are NOT in the array of $role_names.
     *
     * @param array $role_names
     * @param string $operator
     * @param int $count
     * @return $this
     */
    public function whereRoleNameNotIn(array $role_names, string $operator = '>=', int $count = 1): self
    {
        $this->whereHasRole(function (RoleBuilder $builder) use ($role_names) {
            $builder->whereNameNotIn($role_names);
        }, $operator, $count);

        return $this;
    }

    /**
     * Scope query results to User's that have roles.
     *
     * @param Closure|null $callback
     * @param string $operator
     * @param int $count
     * @return $this
     */
    public function whereHasRole(Closure $callback = null, $operator = '>=', $count = 1): self
    {
        $this->whereHas('role', $callback, $operator, $count);

        return $this;
    }

    /**
     * Inactive Users.
     *
     * @return $this
     */
    public function whereInactive(): self
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
    public function withInactive(): self
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
    public function allWithInactive($columns = ['*']): self
    {
        return $this->withInactive()->get($columns);
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
}
