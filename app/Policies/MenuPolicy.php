<?php
namespace App\Policies;
use App\Models\Menu;
use App\Models\User;
class MenuPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function view(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function update(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function delete(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function restore(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
}