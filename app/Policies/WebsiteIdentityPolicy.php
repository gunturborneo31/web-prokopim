<?php
namespace App\Policies;
use App\Models\WebsiteIdentity;
use App\Models\User;
class WebsiteIdentityPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin(); }
    public function view(User $user, WebsiteIdentity $model) { return $user->isSuperAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin(); }
    public function update(User $user, WebsiteIdentity $model) { return $user->isSuperAdmin(); }
    public function delete(User $user, WebsiteIdentity $model) { return $user->isSuperAdmin(); }
    public function restore(User $user, WebsiteIdentity $model) { return $user->isSuperAdmin(); }
    public function forceDelete(User $user, WebsiteIdentity $model) { return $user->isSuperAdmin(); }
}