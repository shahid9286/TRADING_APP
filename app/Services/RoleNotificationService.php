<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\GeneralRoleDatabaseNotification;

class RoleNotificationService
{
    public function notifyAllSuperAdmins(string $roleName, array $notificationData)
    {
        $users = User::where("user_type",$roleName)->get();
        
        foreach ($users as $user) {
            $user->notify(new GeneralRoleDatabaseNotification($notificationData));
        }
        
        return count($users);
    }
    public function notifyRoles(array $roleNames, array $notificationData)
    {
        $users = User::role($roleNames)->get()->unique();
        
        foreach ($users as $user) {
            $user->notify(new GeneralRoleDatabaseNotification($notificationData));
        }
        
        return count($users);
    }
}