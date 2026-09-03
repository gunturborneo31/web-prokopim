<?php
namespace App\Policies;
use App\Models\Service;
use App\Models\User;
class ServicePolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function view(User $user, Service $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function update(User $user, Service $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function delete(User $user, Service $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function restore(User $user, Service $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, Service $model) { return $user->isSuperAdmin() || $user->isEditor(); }
}