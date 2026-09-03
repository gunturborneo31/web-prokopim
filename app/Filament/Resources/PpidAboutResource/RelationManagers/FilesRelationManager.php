<?php

namespace App\Filament\Resources\PpidAboutResource\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class FilesRelationManager extends RelationManager
{
    protected static string $relationship = 'files';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->label(__('Nama Dokumen'))
                    ->required()
                    ->maxLength(255),
                FileUpload::make('file')
                    ->label(__('Pilih File'))
                    ->disk('public')
                    ->directory('ppid-about-files')
                    ->required(),
                Select::make('ppid_id')
                    ->label(__('Jenis PPID'))
                    ->options(\App\Models\Ppid::whereNull('parent_id')->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label(__('NO'))
                    ->state(
                        static function (\HasRelationships $livewire, \Illuminate\Database\Eloquent\Model $record): string {
                            return (string) (array_search($record->getKey(), $livewire->getTableRecords()->pluck($record->getKeyName())->toArray()) + 1);
                        }
                    ),
                TextColumn::make('name')
                    ->label(__('NAMA'))
                    ->weight(\Filament\Support\Enums\FontWeight::Bold),
                TextColumn::make('ppid.name')
                    ->label(__('JENIS PPID'))
                    ->badge()
                    ->color('info'),
                Tables\Columns\IconColumn::make('view')
                    ->label(__('LIHAT'))
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->alignCenter()
                    ->url(fn ($record) => asset('storage/' . $record->file), true),
                Tables\Columns\IconColumn::make('download')
                    ->label(__('DOWNLOAD'))
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->alignCenter()
                    ->url(fn ($record) => asset('storage/' . $record->file), true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label(__('Tambah Dokumen'))
                    ->icon('heroicon-o-plus')
                    ->button(),
            ])
            ->actions([
                EditAction::make()
                    ->icon('heroicon-o-pencil-square')
                    ->label(false)
                    ->color('primary'),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->label(false)
                    ->color('danger'),
            ])
            ->actionsColumnLabel(__('PENGATURAN'))
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->extraAttributes([
                'class' => 'ppid-about-table-custom',
                'style' => '--blue-header: #0ea5e9; -white-text: #ffffff;'
            ]);
    }
}
