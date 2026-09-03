<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PpidItemResource\Pages;
use App\Models\PpidItem;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class PpidItemResource extends Resource
{
    protected static ?string $model = PpidItem::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->extraAttributes(['style' => 'width: 100% !important; max-width: none !important;'])
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->columns(2)
                    ->extraAttributes(['style' => 'width: 100% !important; max-width: none !important;'])
                    ->schema([
                        TextInput::make('name')
                            ->label(__('NAMA'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label(__('DESKRIPSI'))
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),

                        FileUpload::make('file')
                            ->label(__('FILE'))
                            ->disk('public')
                            ->directory('ppid-files')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->openable()
                            ->downloadable()
                            ->required()
                            ->maxSize(102400) // 100 MB
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-powerpoint',
                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            ])
                            ->helperText(__('Maks. 100 MB. Format: PDF, Word, Excel, PowerPoint'))
                            ->columnSpanFull(),
                        Hidden::make('ppid_id')
                            ->default(fn () => request()->query('ppid_id')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('NAMA'))
                    ->searchable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->wrap()
                    ->extraCellAttributes(['class' => 'ppid-name-col', 'style' => 'text-align: left !important; min-width: 200px; max-width: 280px;'])
                    ->extraHeaderAttributes(['class' => 'ppid-name-col', 'style' => 'text-align: left !important;'])
                    ->extraAttributes(['style' => 'justify-content: flex-start !important;']),

                TextColumn::make('file')
                    ->label(__('FILE'))
                    ->formatStateUsing(fn ($state) => $state ? basename($state) : '-')
                    ->url(fn ($state) => $state ? asset('storage/' . $state) : null)
                    ->openUrlInNewTab()
                    ->wrap()
                    ->extraCellAttributes(['style' => 'max-width: 250px;'])
                    ->color('info')
                    ->placeholder('-'),


            ])
            ->filters([])
            ->actions([
                EditAction::make()
                    ->label(false)
                    ->icon('heroicon-s-pencil-square')
                    ->color('warning')
                    ->tooltip(__('Edit')),
                DeleteAction::make()
                    ->label(false)
                    ->icon('heroicon-s-trash')
                    ->color('danger')
                    ->tooltip(__('Hapus')),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->actionsAlignment('center')
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([]);
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
            'index' => Pages\ListPpidItems::route('/'),
            'create' => Pages\CreatePpidItem::route('/create'),
            'edit' => Pages\EditPpidItem::route('/{record}/edit'),
        ];
    }
}
