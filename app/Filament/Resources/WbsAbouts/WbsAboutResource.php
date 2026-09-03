<?php

namespace App\Filament\Resources\WbsAbouts;

use App\Filament\Resources\WbsAbouts\Pages\ManageWbsAbouts;
use App\Models\WbsAbout;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WbsAboutResource extends Resource
{
    protected static ?string $model = WbsAbout::class;
    protected static bool $shouldRegisterNavigation = true;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationParentItem(): ?string
    {
        return __('Layanan Pengaduan');
    }

    public static function getNavigationLabel(): string
    {
        return __('Tentang WBS');
    }

    public static function getModelLabel(): string
    {
        return __('Tentang WBS');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Tentang WBS');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('Judul'))
                    ->required()
                    ->placeholder(__('Contoh: APA ITU WBS?')),
                \Filament\Forms\Components\RichEditor::make('description')
                    ->label(__('Deskripsi / Isi'))
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label(__('Aktif'))
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label(__('Judul'))
                    ->searchable(),
                TextColumn::make('description')
                    ->label(__('Deskripsi / Isi'))
                    ->limit(100)
                    ->wrap()
                    ->extraCellAttributes(['class' => 'long-text-column'])
                    ->html()
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label(__('Aktif'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(__('Dibuat Pada'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('Diubah Pada'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ])
            ->actionsColumnLabel(__('AKSI'));
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageWbsAbouts::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable(app(static::getModel())->getTable())) {
            return true;
        }

        return \App\Models\WbsAbout::count() < 1;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
}
