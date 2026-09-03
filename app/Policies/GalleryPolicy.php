<?php
namespace App\Policies;
use App\Models\Gallery;
use App\Models\User;
class GalleryPolicy {
    public function viewAny(User $user) { return true; }
    public function view(User $user, Gallery $model) { return true; }
    public function create(User $user) { return true; }
    public function update(User $user, Gallery $model) { 
        if ($user->isSuperAdmin() || $user->isEditor()) return true;
        if (isset($model->user_id)) return $user->id === $model->user_id;
        return false;
    }
    public function delete(User $user, Gallery $model) { 
        if ($user->isSuperAdmin() || $user->isEditor()) return true;
        if (isset($model->user_id)) return $user->id === $model->user_id;
        return false;
    }
    public function restore(User $user, Gallery $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, Gallery $model) { return $user->isSuperAdmin(); }
}