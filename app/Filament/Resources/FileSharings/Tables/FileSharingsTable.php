<?php

namespace App\Filament\Resources\FileSharings\Tables;

use Filament\Actions\Action;
use Filament\Tables\Table;

class FileSharingsTable
{
    public static function configure(Table $table, $viewMode = 'grid'): Table
    {
        return $table
            ->modifyQueryUsing(function ($query, Table $table) {
                // Eager load relationships
                $query->with(['user'])->withCount('children');

                // Get Livewire Component State
                $livewire = $table->getLivewire();
                $folderId = $livewire->folderId;
                $activeTab = $livewire->activeTab ?? request()->query('activeTab');

                // If specialized tab (Recent, Favorites, Trash), DO NOT filter by folder
                if (in_array($activeTab, ['recent', 'favorites', 'trash'])) {
                    return $query;
                }

                // Standard "My Drive" Navigation
                if ($folderId) {
                    $query->where('parent_id', $folderId);
                } else {
                    // Default: Root
                    $query->whereNull('parent_id');
                }

                return $query;
            })
            ->contentGrid(fn ($livewire) => ($livewire?->viewMode ?? 'grid') === 'grid' ? [
                'sm' => 2,
                'md' => 3,
                'lg' => 4,
                'xl' => 5,
                '2xl' => 6,
            ] : null)
            ->recordUrl(function ($record) use ($table) {
                $livewire = $table->getLivewire();
                if (($livewire->viewMode ?? 'grid') === 'grid') {
                    return null;
                }

                if ($record->is_folder) {
                    return \App\Filament\Resources\FileSharings\FileSharingResource::getUrl('index', [
                        'folder_id' => $record->id,
                    ]);
                }
                $isImage = in_array(strtolower($record->type ?? ''), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                if (! $isImage && $record->file_path) {
                    return \Illuminate\Support\Facades\Storage::url($record->file_path);
                }

                return null;
            })
            ->openRecordUrlInNewTab(fn ($record) => ! $record->is_folder)
            ->recordAction(function ($record) use ($table) {
                $livewire = $table->getLivewire();
                if (($livewire->viewMode ?? 'grid') === 'grid') {
                    return null;
                }

                if ($record->is_folder) {
                    return null;
                }
                $isImage = in_array(strtolower($record->type ?? ''), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);

                return $isImage ? 'preview' : null;
            })
            ->columns($viewMode === 'grid' ? [
                // GRID VIEW LAYOUT
                \Filament\Tables\Columns\Layout\View::make('filament.resources.file-sharings.card'),
            ] : [
                // LIST VIEW COLUMNS
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label(__('NAMA'))
                    ->icon(fn ($record) => $record->is_folder ? 'heroicon-s-folder' : 'heroicon-s-document')
                    ->iconColor(fn ($record) => $record->is_folder ? 'warning' : 'gray')
                    // ->sortable()
                    ->searchable()
                    ->extraCellAttributes(['class' => 'column-nama-menu'])
                    ->extraHeaderAttributes(['class' => 'column-nama-menu']),

                \Filament\Tables\Columns\TextColumn::make('user.name')
                    ->label(__('DIBUAT OLEH'))
                    // ->sortable()
                    ->alignCenter(),

                \Filament\Tables\Columns\TextColumn::make('size')
                    ->label(__('UKURAN'))
                    ->formatStateUsing(fn ($record) => $record->is_folder ? $record->children_count . ' ' . __('item') : ($record->file_size_formatted ?? '0 B'))
                    ->alignCenter(),

                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('TERAKHIR DIUBAH'))
                    ->dateTime('d M Y, H:i')
                    // ->sortable()
                    ->alignCenter(),
            ])
            ->filters([
                \Filament\Tables\Filters\Filter::make('search')
                    ->label(__('Pencarian'))
                    ->form([
                        \Filament\Forms\Components\TextInput::make('search')
                            ->label('')
                            ->placeholder(__('Cari file atau folder...'))
                            ->prefixIcon('heroicon-m-magnifying-glass')
                            ->columnSpan(1),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['search'],
                            fn ($query, $search) => $query->where('title', 'like', "%{$search}%")
                        );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (! $data['search']) {
                            return null;
                        }

                        return __('Pencarian') . ': ' . $data['search'];
                    })
                    ->columnSpan(2),

                \Filament\Tables\Filters\Filter::make('is_favorite')
                    ->label(__('Favorit'))
                    ->form([
                        \Filament\Forms\Components\Checkbox::make('is_favorite')
                            ->label(__('Favorit'))
                            ->inline(true),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['is_favorite'],
                            fn ($query) => $query->where('is_favorite', true)
                        );
                    })
                    ->columnSpan(1),

                \Filament\Tables\Filters\Filter::make('is_public')
                    ->label(__('Umum'))
                    ->form([
                        \Filament\Forms\Components\Checkbox::make('is_public')
                            ->label(__('Umum'))
                            ->inline(true),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['is_public'],
                            fn ($query) => $query->where('is_public', true)
                        );
                    })
                    ->columnSpan(1),

                \Filament\Tables\Filters\Filter::make('date_range')
                    ->label(__('Dibuat Dari'))
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('created_from')
                            ->label(__('Dibuat Dari'))
                            ->placeholder('dd/mm/yyyy')
                            ->displayFormat('d/m/Y')
                            ->native(false)
                            ->prefixIcon('heroicon-m-calendar'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn ($query, $date) => $query->whereDate('created_at', '>=', $date)
                            );
                    })
                    ->columnSpan(1),

                \Filament\Tables\Filters\TernaryFilter::make('this_month')
                    ->label(__('Bulan Ini'))
                    ->placeholder(__('Semua Bulan'))
                    ->trueLabel(__('Bulan Ini'))
                    ->falseLabel(__('Bukan Bulan Ini'))
                    ->queries(
                        true: fn ($query) => $query->whereMonth('created_at', now()->month),
                        false: fn ($query) => $query->whereMonth('created_at', '!=', now()->month),
                        blank: fn ($query) => $query,
                    )
                    ->columnSpan(1),

                \Filament\Tables\Filters\TernaryFilter::make('this_year')
                    ->label(__('Tahun Ini'))
                    ->placeholder(__('Semua Tahun'))
                    ->trueLabel(__('Tahun Ini'))
                    ->falseLabel(__('Bukan Tahun Ini'))
                    ->queries(
                        true: fn ($query) => $query->whereYear('created_at', now()->year),
                        false: fn ($query) => $query->whereYear('created_at', '!=', now()->year),
                        blank: fn ($query) => $query,
                    )
                    ->columnSpan(1),

                \Filament\Tables\Filters\SelectFilter::make('user_id')
                    ->label(__('Dibuat Oleh'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder(__('Pilih User'))
                    ->columnSpan(2),
            ])
            ->filtersLayout(\Filament\Tables\Enums\FiltersLayout::AboveContent)
            ->persistFiltersInSession()
            ->filtersFormColumns(9)
            ->actions([
                Action::make('preview')
                    ->modalHeading(fn ($record) => $record->title ?? 'Preview')
                    ->modalContent(fn ($record) => ($record && $record->file_path) ? new \Illuminate\Support\HtmlString('
                        <div class="flex justify-center w-full">
                            <img src="'.\Illuminate\Support\Facades\Storage::url($record->file_path).'" style="max-height: 70vh; max-width: 100%; object-fit: contain;" alt="Preview">
                        </div>
                    ') : null)
                    ->modalWidth('5xl')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel(__('Tutup'))
                    ->label('')
                    ->icon(null)
                    ->extraAttributes(['class' => 'hidden']),

                Action::make('openFile')
                    ->url(fn ($record) => ($record && $record->file_path) ? \Illuminate\Support\Facades\Storage::url($record->file_path) : null)
                    ->openUrlInNewTab()
                    ->label('')
                    ->icon(null)
                    ->extraAttributes(['class' => 'hidden']),

                Action::make('toggleFavorite')
                    ->label(fn ($record) => ($record && $record->is_favorite) ? __('Hapus Favorit') : __('Tambah Favorit'))
                    ->icon(fn ($record) => ($record && $record->is_favorite) ? 'heroicon-s-star' : 'heroicon-o-star')
                    ->color(fn ($record) => ($record && $record->is_favorite) ? 'warning' : 'gray')
                    ->tooltip(fn ($record) => ($record && $record->is_favorite) ? __('Hapus dari Favorit') : __('Tambah ke Favorit'))
                    ->iconButton()
                    ->visible(fn ($record) => $record && ! $record->deleted_at)
                    ->action(function ($record) {
                        $record->update(['is_favorite' => ! $record->is_favorite]);
                        \Filament\Notifications\Notification::make()
                            ->title($record->is_favorite ? __('Ditambahkan ke favorit') : __('Dihapus dari favorit'))
                            ->success()
                            ->send();
                    }),

                \Filament\Actions\ActionGroup::make([

                    Action::make('download')
                        ->label(__('Download'))
                        ->icon('heroicon-o-arrow-down-tray')
                        ->visible(fn ($record) => $record && ! $record->is_folder && $record->file_path)
                        ->url(fn ($record) => route('file-sharing.download', $record->share_code))
                        ->openUrlInNewTab(false),

                    Action::make('rename')
                        ->label(__('Ganti Nama'))
                        ->icon('heroicon-o-pencil-square')
                        ->mountUsing(fn (\Filament\Schemas\Schema $form, ?\App\Models\FileSharing $record) => $record ? $form->fill([
                            'title' => $record->title,
                        ]) : null)
                        ->form([
                            \Filament\Forms\Components\TextInput::make('title')->required()->label(__('Nama Baru')),
                        ])
                        ->action(function (array $data, ?\App\Models\FileSharing $record) {
                            $record?->update(['title' => $data['title']]);
                            \Filament\Notifications\Notification::make()->title(__('Nama berhasil diubah'))->success()->send();
                        }),

                    Action::make('share')
                        ->label(__('Bagikan'))
                        ->icon('heroicon-o-share')
                        ->modalHeading(fn (\Filament\Actions\Action $action) => __('Bagikan') . ' "' . (($action->getRecord())?->title ?? __('File')) . '"')
                        ->modalWidth('md')
                        ->modalSubmitActionLabel(__('Selesai'))
                        ->modalCancelAction(false)
                        ->extraModalFooterActions(fn (\Filament\Actions\Action $action) => [
                            Action::make('copyLink')
                                ->label(__('Salin Link'))
                                ->icon('heroicon-m-link')
                                ->color('primary')
                                ->outlined()
                                ->action(function () {
                                    // Action side-effect if needed, but JS handles the copy
                                })


                                ->extraAttributes(function (\Filament\Actions\Action $action) {
                                    $record = $action->getRecord();
                                    if (! $record) return [];
                                    $url = route('file-sharing.view', $record->share_code);

                                    return [
                                        'x-on:click.prevent.stop' => "
                                            (function() {
                                                let targetInput = null;
                                                const inputs = document.querySelectorAll('.fi-modal-content input');
                                                
                                                inputs.forEach(el => {
                                                    if (el.value === '{$url}') {
                                                        targetInput = el;
                                                    }
                                                });

                                                if (!targetInput && inputs.length > 0) {
                                                    targetInput = inputs[inputs.length - 1]; 
                                                }

                                                if (targetInput) {
                                                    targetInput.select();
                                                    targetInput.setSelectionRange(0, 99999);
                                                    
                                                    if (navigator.clipboard) {
                                                        navigator.clipboard.writeText(targetInput.value).then(() => {
                                                            \$dispatch('notify', { message: '{{ __('Link berhasil disalin!') }}', type: 'success' });
                                                        });
                                                    } else {
                                                        document.execCommand('copy');
                                                        \$dispatch('notify', { message: '{{ __('Link berhasil disalin!') }}', type: 'success' });
                                                    }
                                                } else {
                                                    const url = '{$url}';
                                                    if (navigator.clipboard) {
                                                        navigator.clipboard.writeText(url).then(() => {
                                                            \$dispatch('notify', { message: '{{ __('Link berhasil disalin!') }}', type: 'success' });
                                                        });
                                                    }
                                                }
                                            })();
                                        ",
                                    ];
                                }),
                        ])

                        ->mountUsing(function (\Filament\Schemas\Schema $form, \Filament\Actions\Action $action, $record) {
                            $record = $record ?? $action->getRecord();
                            if (!$record) return;
                            
                            // Ensure share_code exists
                            if (empty($record->share_code)) {
                                $shareCode = \Illuminate\Support\Str::random(10);
                                while (\App\Models\FileSharing::where('share_code', $shareCode)->exists()) {
                                    $shareCode = \Illuminate\Support\Str::random(10);
                                }
                                $record->share_code = $shareCode;
                                $record->save();
                            }

                            $shareUrl = url('/file-sharing/view/' . $record->share_code);
                            
                            $form->fill([
                                'access_level' => $record->is_public ? 'public' : 'restricted',
                                'share_url' => $shareUrl,
                            ]);
                        })
                        ->form([
                            // Owner Info
                            \Filament\Forms\Components\Placeholder::make('owner_info')
                                ->label(__('Orang dengan akses'))
                                ->content(function (\Filament\Actions\Action $action, $record) {
                                    $record = $record ?? $action->getRecord();
                                    if (!$record) return 'Memuat...';
                                    
                                    $userName = $record->user->name ?? 'Administrator';
                                    $userEmail = $record->user->email ?? 'admin@perumda.co.id';
                                    $initial = strtoupper(substr($userName, 0, 1) ?: 'A');

                                    return new \Illuminate\Support\HtmlString('
                                        <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f3f4f6; border-radius: 12px; border: 1px solid #e5e7eb;">
                                            <div style="width: 40px; height: 40px; background: #6366f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                '.$initial.'
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="font-weight: 700; font-size: 14px; color: #111827;">'.$userName.'</div>
                                                <div style="font-size: 12px; color: #6b7280; font-weight: 500;">'.$userEmail.'</div>
                                            </div>
                                            <div style="font-size: 12px; background: #eef2ff; color: #4338ca; padding: 2px 8px; border-radius: 20px; font-weight: 700;">' . __('Pemilik') . '</div>
                                        </div>
                                    ');
                                }),

                            // General Access
                            \Filament\Schemas\Components\Section::make(__('Akses Umum'))
                                ->description(__('Pilih siapa yang dapat mengakses file ini'))
                                ->schema([
                                    \Filament\Forms\Components\Select::make('access_level')
                                        ->label(__('Tingkat Akses'))
                                        ->options([
                                            'restricted' => __('Dibatasi - Hanya Anda'),
                                            'public' => __('Publik - Siapa saja dengan link'),
                                        ])
                                        ->selectablePlaceholder(false)
                                        ->live()
                                        ->afterStateUpdated(fn ($state, $record) => $record?->update(['is_public' => $state === 'public']))
                                        ->prefixIcon(fn ($state) => $state === 'public' ? 'heroicon-m-globe-alt' : 'heroicon-m-lock-closed')
                                        ->helperText(fn ($get) => $get('access_level') === 'public'
                                            ? __('✓ Siapa saja yang memiliki link dapat mengakses file ini.')
                                            : __('✗ Hanya Anda yang dapat mengakses file ini.')),

                                    \Filament\Forms\Components\TextInput::make('share_url')
                                        ->label(__('Link Berbagi'))
                                        ->readOnly()
                                        ->visible(fn ($get) => $get('access_level') === 'public')
                                        ->suffixAction(
                                            Action::make('copy')
                                                ->icon('heroicon-m-clipboard')
                                                ->label('')
                                                ->action(function () {})
                                                ->extraAttributes(function (\Filament\Actions\Action $action) {
                                                    $record = $action->getRecord();
                                                    if (! $record) return [];
                                                    $url = route('file-sharing.view', $record->share_code);

                                                    return [
                                                        'x-on:click.prevent.stop' => "
                                                            const url = '{$url}';
                                                            const input = \$el.closest('.fi-input-wrp').querySelector('input');
                                                            input.select();
                                                            if (navigator.clipboard) {
                                                                navigator.clipboard.writeText(url).then(() => {
                                                                    \$dispatch('notify', { message: '{{ __('Link berhasil disalin!') }}', type: 'success' });
                                                                });
                                                            } else {
                                                                document.execCommand('copy');
                                                                \$dispatch('notify', { message: '{{ __('Link berhasil disalin!') }}', type: 'success' });
                                                            }
                                                        ",
                                                    ];
                                                })
                                        ),
                                ])
                                ->compact(),
                        ])
                        ->action(function (\Filament\Actions\Action $action) {
                            $record = $action->getRecord();
                            \Filament\Notifications\Notification::make()
                                ->title(__('Pengaturan berbagi berhasil diperbarui'))
                                ->success()
                                ->send();
                        }),

                    Action::make('move')
                        ->label(__('Pindahkan'))
                        ->icon('heroicon-o-arrow-right-start-on-rectangle')
                        ->form([
                            \Filament\Forms\Components\Select::make('parent_id')
                                ->label(__('Folder Tujuan'))
                                ->options(function ($record) {
                                    if (! $record) return [];
                                    return \App\Models\FileSharing::where('is_folder', true)
                                        ->where('id', '!=', $record->id)
                                        ->pluck('title', 'id');
                                })
                                ->searchable()
                                ->placeholder(__('Root (Utama)')),
                        ])
                        ->action(function (array $data, $record) {
                            $record?->update(['parent_id' => $data['parent_id'] ?? null]);
                            \Filament\Notifications\Notification::make()->title(__('Berhasil dipindahkan'))->success()->send();
                        }),

                    Action::make('delete')
                        ->label(__('Hapus'))
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn ($record) => $record && ! $record->deleted_at)
                        ->action(function ($record) {
                            $record?->delete();
                            \Filament\Notifications\Notification::make()->title(__('Berhasil dihapus'))->success()->send();
                        }),

                    Action::make('restore')
                        ->label(__('Pulihkan'))
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->visible(fn ($record) => $record && $record->deleted_at)
                        ->action(function ($record) {
                            $record->restore();
                            \Filament\Notifications\Notification::make()->title(__('Berhasil dipulihkan'))->success()->send();
                        }),

                    Action::make('forceDelete')
                        ->label(__('Hapus Permanen'))
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn ($record) => $record && $record->deleted_at)
                        ->action(function ($record) {
                            $record->forceDelete();
                            \Filament\Notifications\Notification::make()->title(__('Berhasil dihapus permanen'))->success()->send();
                        }),
                ])
                    ->icon('heroicon-m-ellipsis-vertical'),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->defaultSort('is_folder', 'desc')
            ->bulkActions([]);
    }
}
