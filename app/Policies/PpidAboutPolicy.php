<?php
namespace App\Policies;
use App\Models\PpidAbout;
use App\Models\User;
class PpidAboutPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function view(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function update(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function delete(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function restore(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isEditor(); }
}