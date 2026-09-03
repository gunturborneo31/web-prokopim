<?php
namespace App\Policies;
use App\Models\Pengaduan;
use App\Models\User;
class PengaduanPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin(); }
    public function view(User $user, Pengaduan $model) { return $user->isSuperAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin(); }
    public function update(User $user, Pengaduan $model) { return $user->isSuperAdmin(); }
    public function delete(User $user, Pengaduan $model) { return $user->isSuperAdmin(); }
    public function restore(User $user, Pengaduan $model) { return $user->isSuperAdmin(); }
    public function forceDelete(User $user, Pengaduan $model) { return $user->isSuperAdmin(); }
}