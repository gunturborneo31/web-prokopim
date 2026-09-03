<?php
namespace App\Policies;
use App\Models\Post;
use App\Models\User;
class PostPolicy {
    public function viewAny(User $user) { return true; }
    public function view(User $user, Post $model) { return true; }
    public function create(User $user) { return true; }
    public function update(User $user, Post $model) { 
        if ($user->isSuperAdmin() || $user->isEditor()) return true;
        if (isset($model->user_id)) return $user->id === $model->user_id;
        return false;
    }
    public function delete(User $user, Post $model) { 
        if ($user->isSuperAdmin() || $user->isEditor()) return true;
        if (isset($model->user_id)) return $user->id === $model->user_id;
        return false;
    }
    public function restore(User $user, Post $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, Post $model) { return $user->isSuperAdmin(); }
}