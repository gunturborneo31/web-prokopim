<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PpidAboutResource\RelationManagers;
use App\Filament\Resources\PpidAboutResource\Pages;
use App\Models\PpidAbout;
use App\Models\PpidAboutFile;
use App\Models\Ppid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class PpidAboutResource extends Resource
{
    protected static ?string $model = PpidAbout::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $slug = 'tentang-ppid';

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-information-circle';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationParentItem(): ?string
    {
        return __('PPID');
    }

    public static function getNavigationLabel(): string
    {
        return __('Tentang PPID');
    }

    public static function getModelLabel(): string
    {
        return __('Tentang PPID');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Tentang PPID');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make(__('KONTEN TENTANG PPID'))
                    ->schema([
                        RichEditor::make('profil')
                            ->label(__('PROFIL'))
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('visi')
                            ->label(__('VISI'))
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('misi')
                            ->label(__('MISI'))
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('maklumat')
                            ->label(__('MAKLUMAT'))
                            ->required()
                            ->columnSpanFull(),
                    ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('profil')
                    ->label(__('PROFIL PPID'))
                    ->formatStateUsing(fn ($state) => $state ? strip_tags($state) : '-')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('visi')
                    ->label(__('VISI'))
                    ->formatStateUsing(fn ($state) => $state ? strip_tags($state) : '-')
                    ->limit(60)
                    ->wrap(),
                TextColumn::make('misi')
                    ->label(__('MISI'))
                    ->formatStateUsing(fn ($state) => $state ? strip_tags($state) : '-')
                    ->limit(60)
                    ->wrap(),
                TextColumn::make('maklumat')
                    ->label(__('MAKLUMAT'))
                    ->formatStateUsing(fn ($state) => $state ? strip_tags($state) : '-')
                    ->limit(60)
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->icon('heroicon-o-pencil-square')
                    ->label(false)
                    ->modalWidth('5xl')
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePpidAbouts::route('/'),
        ];
    }
}
