<?php
namespace App\Policies;
use App\Models\FileSharing;
use App\Models\User;
class FileSharingPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function view(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function update(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function delete(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function restore(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isEditor(); }
}