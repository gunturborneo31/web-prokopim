<?php
namespace App\Policies;
use App\Models\DynamicPage;
use App\Models\User;
class DynamicPagePolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function view(User $user, DynamicPage $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function update(User $user, DynamicPage $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function delete(User $user, DynamicPage $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function restore(User $user, DynamicPage $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, DynamicPage $model) { return $user->isSuperAdmin() || $user->isEditor(); }
}