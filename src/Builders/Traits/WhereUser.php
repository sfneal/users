<?php

namespace Sfneal\Users\Builders\Traits;

use Sfneal\Users\Builders\Interfaces\WhereUserInterface;

trait WhereUser
{
    /**
     * Scope query to activity that was performed by a particular user.
     *
     * @param  int  $user_id
     * @return $this|WhereUserInterface
     */
    public function whereUser(int $user_id)
    {
        $this->where('user_id', '=', $user_id);

        return $this;
    }

    /**
     * Scope query to activity that was performed by any of the specified users.
     *
     * @param  array  $user_ids
     * @return $this|WhereUserInterface
     */
    public function whereUserIn(array $user_ids)
    {
        $this->whereIn('user_id', $user_ids);

        return $this;
    }
}
