<?php
namespace App\Policies;
use App\Models\WbsAbout;
use App\Models\User;
class WbsAboutPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin(); }
    public function view(User $user, WbsAbout $model) { return $user->isSuperAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin(); }
    public function update(User $user, WbsAbout $model) { return $user->isSuperAdmin(); }
    public function delete(User $user, WbsAbout $model) { return $user->isSuperAdmin(); }
    public function restore(User $user, WbsAbout $model) { return $user->isSuperAdmin(); }
    public function forceDelete(User $user, WbsAbout $model) { return $user->isSuperAdmin(); }
}