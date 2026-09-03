<?php

namespace App\Filament\Resources\FileSharings;

use App\Filament\Resources\FileSharings\Pages\CreateFileSharing;
use App\Filament\Resources\FileSharings\Pages\EditFileSharing;
use App\Filament\Resources\FileSharings\Pages\ListFileSharings;
use App\Filament\Resources\FileSharings\Schemas\FileSharingForm;
use App\Filament\Resources\FileSharings\Tables\FileSharingsTable;
use App\Models\FileSharing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FileSharingResource extends Resource
{
    protected static ?string $model = FileSharing::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Media & Arsip';
    }

    public static function getNavigationLabel(): string
    {
        return __('File/Dokumen');
    }

    public static function getModelLabel(): string
    {
        return __('File');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Daftar File');
    }

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocument;

    public static function form(Schema $schema): Schema
    {
        return FileSharingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // Try to get viewMode from Livewire component
        $viewMode = 'grid';
        try {
            $livewire = $table->getLivewire();
            if ($livewire && property_exists($livewire, 'viewMode')) {
                $viewMode = $livewire->viewMode;
            }
        } catch (\Exception $e) {
            // Default to grid if we can't get the Livewire component
        }

        return FileSharingsTable::configure($table, $viewMode);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getFileIcon(?string $type): string
    {
        return match (strtolower($type ?? '')) {
            'pdf' => 'heroicon-o-document-text',
            'doc', 'docx' => 'heroicon-o-document-text',
            'xls', 'xlsx', 'csv' => 'heroicon-o-table-cells',
            'ppt', 'pptx' => 'heroicon-o-presentation-chart-bar',
            'zip', 'rar', '7z' => 'heroicon-o-archive-box',
            'mp3', 'wav', 'ogg' => 'heroicon-o-musical-note',
            'mp4', 'avi', 'mov' => 'heroicon-o-video-camera',
            default => 'heroicon-o-document',
        };
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFileSharings::route('/'),
            'create' => CreateFileSharing::route('/create'),
            'edit' => EditFileSharing::route('/{record}/edit'),
        ];
    }
}
