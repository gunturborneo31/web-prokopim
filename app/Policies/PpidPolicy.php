<?php
namespace App\Policies;
use App\Models\Ppid;
use App\Models\User;
class PpidPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function view(User $user, Ppid $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function update(User $user, Ppid $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function delete(User $user, Ppid $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function restore(User $user, Ppid $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, Ppid $model) { return $user->isSuperAdmin() || $user->isEditor(); }
}