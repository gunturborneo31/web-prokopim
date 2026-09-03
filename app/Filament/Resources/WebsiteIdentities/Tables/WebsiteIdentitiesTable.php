<?php

namespace App\Filament\Resources\WebsiteIdentities\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WebsiteIdentitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->contentGrid([
                'default' => 1,
                'md' => 1,
                'xl' => 1,
            ])
            ->columns([
                \Filament\Tables\Columns\Layout\Split::make([
                    \Filament\Tables\Columns\ImageColumn::make('logo')
                        ->disk('public')
                        ->visibility('public')
                        ->size(120) // Medium/Large logo
                        ->circular()
                        ->extraImgAttributes(['style' => 'border: 2px solid #e2e8f0; padding: 4px;'])
                        ->grow(false),

                    \Filament\Tables\Columns\Layout\Stack::make([
                        \Filament\Tables\Columns\TextColumn::make('name')
                            ->size(\Filament\Support\Enums\TextSize::Large)
                            ->weight(\Filament\Support\Enums\FontWeight::Bold)
                            ->color('primary')
                            ->extraAttributes(['style' => 'margin-bottom: 0.5rem;']),
                        
                        \Filament\Tables\Columns\TextColumn::make('email')
                            ->icon('heroicon-m-envelope')
                            ->color('gray')
                            ->size(\Filament\Support\Enums\TextSize::Small)
                            ->placeholder(__('Email belum diisi')),
                        
                        \Filament\Tables\Columns\TextColumn::make('phone')
                            ->icon('heroicon-m-phone')
                            ->color('gray')
                            ->size(\Filament\Support\Enums\TextSize::Small)
                            ->placeholder(__('Telepon belum diisi')),
                        
                        \Filament\Tables\Columns\TextColumn::make('whatsapp')
                            ->icon('heroicon-m-chat-bubble-left-right')
                            ->color('gray')
                            ->size(\Filament\Support\Enums\TextSize::Small)
                            ->placeholder(__('WhatsApp belum diisi')),
                    ])->space(2)->grow(true),
                ])
                ->from('md')
                ->extraAttributes([
                    'class' => 'p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 relative',
                ]),
            ])
            ->actions([
                \Filament\Actions\EditAction::make()
                    ->label(__('Kelola'))
                    ->icon('heroicon-m-pencil-square')
                    ->button()
                    ->color('primary')
                    ->extraAttributes([
                        'class' => 'absolute bottom-4 right-4',
                    ]),
            ])
            ->paginated(false)
            ->searchable(false)
            ->recordUrl(null);
    }
}
