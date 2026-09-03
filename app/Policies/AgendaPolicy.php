<?php
namespace App\Policies;
use App\Models\Agenda;
use App\Models\User;
class AgendaPolicy {
    public function viewAny(User $user) { return true; }
    public function view(User $user, Agenda $model) { return true; }
    public function create(User $user) { return true; }
    public function update(User $user, Agenda $model) { 
        if ($user->isSuperAdmin() || $user->isEditor()) return true;
        if (isset($model->user_id)) return $user->id === $model->user_id;
        return false;
    }
    public function delete(User $user, Agenda $model) { 
        if ($user->isSuperAdmin() || $user->isEditor()) return true;
        if (isset($model->user_id)) return $user->id === $model->user_id;
        return false;
    }
    public function restore(User $user, Agenda $model) { return $user->isSuperAdmin() || $user->isEditor(); }
    public function forceDelete(User $user, Agenda $model) { return $user->isSuperAdmin(); }
}