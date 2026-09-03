<?php
namespace App\Policies;
use App\Models\Slider;
use App\Models\User;
class SliderPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function view(User $user, Slider $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function update(User $user, Slider $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function delete(User $user, Slider $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function restore(User $user, Slider $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, Slider $model) { return $user->isSuperAdmin() || $user->isEditor(); }
}