<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case Editor = 'editor';
    case Contributor = 'contributor';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => __('Super Admin'),
            self::Editor => __('Editor'),
            self::Contributor => __('Kontributor'),
        };
    }
}
