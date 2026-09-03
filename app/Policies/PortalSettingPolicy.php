<?php
namespace App\Policies;
use App\Models\PortalSetting;
use App\Models\User;
class PortalSettingPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin(); }
    public function view(User $user, PortalSetting $model) { return $user->isSuperAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin(); }
    public function update(User $user, PortalSetting $model) { return $user->isSuperAdmin(); }
    public function delete(User $user, PortalSetting $model) { return $user->isSuperAdmin(); }
    public function restore(User $user, PortalSetting $model) { return $user->isSuperAdmin(); }
    public function forceDelete(User $user, PortalSetting $model) { return $user->isSuperAdmin(); }
}