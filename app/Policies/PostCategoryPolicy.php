<?php
namespace App\Policies;
use App\Models\PostCategory;
use App\Models\User;
class PostCategoryPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function view(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function update(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function delete(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function restore(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isEditor(); }
}