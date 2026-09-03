<?php

namespace App\Filament\Resources\PortalSettings\Schemas;

use Filament\Schemas\Schema;

class PortalSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make(__('Pengaturan Portal'))
                    ->description(__('Aktifkan atau nonaktifkan akses ke halaman portal utama.'))
                    ->schema([
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->label(__('Status Portal'))
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true)
                            ->helperText(__('Jika nonaktif, pengunjung akan dialihkan otomatis ke halaman Buletin.'))
                            ->required(),
                    ]),
            ]);
    }
}
