<?php

namespace Sfneal\Users\Events;

use Sfneal\Users\Models\User;
use Support\Tracking\Events\TrackActivityEvent;

class UserUpdatedEvent extends TrackActivityEvent
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var array
     */
    public $changes;

    /**
     * UserUpdatingEvent constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->changes = $user->getChanges();
        parent::__construct($this->user);
    }
}
