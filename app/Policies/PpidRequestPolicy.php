<?php
namespace App\Policies;
use App\Models\PpidRequest;
use App\Models\User;
class PpidRequestPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin(); }
    public function view(User $user, PpidRequest $model) { return $user->isSuperAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin(); }
    public function update(User $user, PpidRequest $model) { return $user->isSuperAdmin(); }
    public function delete(User $user, PpidRequest $model) { return $user->isSuperAdmin(); }
    public function restore(User $user, PpidRequest $model) { return $user->isSuperAdmin(); }
    public function forceDelete(User $user, PpidRequest $model) { return $user->isSuperAdmin(); }
}