<?php

namespace App\Observers;

use App\Models\User;
use App\Events\LogAppActivityRecorded;
use App\Events\DataAppActivityRecorded;
use App\Events\EmailAppActivityRecorded;
use App\Events\NotificationAppActivityRecorded;

class UserObserver
{
    private function generateAppActivityLog ($user, $action, $message) : void
    {
        DataAppActivityRecorded::dispatch($user, $action);
        EmailAppActivityRecorded::dispatch($user, $action);
        LogAppActivityRecorded::dispatch($user, $action);
        NotificationAppActivityRecorded::dispatch($user, $action, $message);
    }

    public function retrieved (User $user) : void 
    {

    }

    public function creating (User $user) : void
    {

    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user) : void
    {
        $this->generateAppActivityLog($user, 'created', 'User created');
    }

    public function updating (User $user) : void 
    {

    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user) : void
    {
        $this->generateAppActivityLog($user, 'updated', 'User updated');
    }

    public function saving (User $user) : void
    {

    }

    public function saved (User $user) : void
    {

    }

    public function deleting (User $user) : void
    {

    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user) : void
    {
        $this->generateAppActivityLog($user, 'deleted', 'has been deleted');
    }

    public function restoring (User $user) : void
    {

    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user) : void
    {
        $this->generateAppActivityLog($user, 'restored', 'has been restored');
    }

    public function forceDeleting (User $user) : void
    {

    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user) : void
    {
        $this->generateAppActivityLog($user, 'force deleted', 'has been force deleted');
    }

    public function replicating (User $user) : void
    {

    }

    public function trashed (User $user) : void
    {

    }
}
