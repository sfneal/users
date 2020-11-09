<?php

namespace Sfneal\Users\Builders\Interfaces;

interface WhereUserInterface
{
    /**
     * Scope query results to particular users.
     *
     * @param int $user_id
     *
     * @return $this
     */
    public function whereUser(int $user_id);

    /**
     * Scope query to activity that was performed by any of the specified users.
     *
     * @param array $user_ids
     *
     * @return $this
     */
    public function whereUserIn(array $user_ids);
}
