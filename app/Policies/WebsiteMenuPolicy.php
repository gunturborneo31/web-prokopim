<?php
namespace App\Policies;
use App\Models\WebsiteMenu;
use App\Models\User;
class WebsiteMenuPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function view(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function update(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function delete(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function restore(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isEditor(); }
}