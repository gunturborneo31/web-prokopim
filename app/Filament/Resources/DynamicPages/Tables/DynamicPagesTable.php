<?php

namespace App\Filament\Resources\DynamicPages\Tables;

use App\Models\DynamicPage;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class DynamicPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label(__('NO'))
                    ->rowIndex()
                    ->width('48px')
                    ->alignCenter(),

                TextColumn::make('title')
                    ->label(__('JUDUL HALAMAN'))
                    ->searchable()
                    ->html()
                    ->formatStateUsing(function ($state, DynamicPage $record) {
                        $templateLabel = DynamicPage::templates()[$record->template] ?? $record->template;
                        $color = DynamicPage::templateColor($record->template);

                        $palettes = [
                            'info' => ['bg' => '#dbeafe', 'text' => '#1d4ed8', 'border' => '#bfdbfe'],
                            'success' => ['bg' => '#dcfce7', 'text' => '#3255AA', 'border' => '#bbf7d0'],
                            'warning' => ['bg' => '#fef9c3', 'text' => '#a16207', 'border' => '#fef08a'],
                            'danger' => ['bg' => '#fee2e2', 'text' => '#b91c1c', 'border' => '#fecaca'],
                            'primary' => ['bg' => '#f3e8ff', 'text' => '#7e22ce', 'border' => '#e9d5ff'],
                            'gray' => ['bg' => '#f1f5f9', 'text' => '#475569', 'border' => '#e2e8f0'],
                        ];

                        $p = $palettes[$color] ?? $palettes['gray'];

                        return new HtmlString("
                            <div style='display:flex;flex-direction:column;gap:2px;'>
                                <div style='display:flex;align-items:center;gap:8px;'>
                                    <span style='font-size:14px;font-weight:600;'>" . e($state) . "</span>
                                    <span style='
                                        display:inline-block;
                                        padding:1px 8px;
                                        border-radius:4px;
                                        font-size:9px;
                                        font-weight:700;
                                        letter-spacing:.05em;
                                        text-transform:uppercase;
                                        background:{$p['bg']};
                                        color:{$p['text']};
                                        border:1px solid {$p['border']};
                                        white-space:nowrap;
                                        flex-shrink:0;
                                    '>" . e($templateLabel) . "</span>
                                </div>
                                <div style='font-size:11px;font-family:monospace;opacity:.55;'>/halaman/" . e($record->slug) . "</div>
                            </div>
                        ");
                    })
                    ->alignLeft(),

                TextColumn::make('menu.name')
                    ->label(__('MENU TERKAIT'))
                    ->html()
                    ->formatStateUsing(function ($state, DynamicPage $record) {
                        if (!$record->menu) {
                            return new HtmlString('<span style="opacity:.35;font-size:12px;">—</span>');
                        }
                        $parts = [];
                        if ($record->menu->parent?->parent) {
                            $parts[] = '<span style="opacity:.5;">' . e($record->menu->parent->parent->name) . '</span>';
                        }
                        if ($record->menu->parent) {
                            $parts[] = '<span style="opacity:.7;">' . e($record->menu->parent->name) . '</span>';
                        }
                        $parts[] = '<span style="font-weight:600;">' . e($record->menu->name) . '</span>';

                        $sep = '<span style="opacity:.3;margin:0 3px;font-size:10px;">›</span>';
                        return new HtmlString(
                            '<div style="display:flex;align-items:center;flex-wrap:wrap;gap:2px;font-size:12px;">'
                            . implode($sep, $parts)
                            . '</div>'
                        );
                    })
                    ->alignCenter(),

                TextColumn::make('published')
                    ->label(__('PUBLIKASI'))
                    ->html()
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            return new HtmlString(
                                '<span style="
                                    display:inline-flex;align-items:center;gap:5px;
                                    padding:3px 10px;border-radius:999px;
                                    font-size:11px;font-weight:600;letter-spacing:.03em;
                                    background:#dcfce7;color:#3255AA;border:1px solid #bbf7d0;
                                ">
                                    <span style="width:6px;height:6px;border-radius:50%;background:#16a34a;display:inline-block;"></span>
                                    ' . e(__('Publik')) . '
                                </span>'
                            );
                        }
                        return new HtmlString(
                            '<span style="
                                display:inline-flex;align-items:center;gap:5px;
                                padding:3px 10px;border-radius:999px;
                                font-size:11px;font-weight:600;letter-spacing:.03em;
                                background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;
                            ">
                                <span style="width:6px;height:6px;border-radius:50%;background:#94a3b8;display:inline-block;"></span>
                                ' . e(__('Draf')) . '
                            </span>'
                        );

                    })
                    ->alignCenter()
                    ->width('110px'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                EditAction::make()->label('Ubah'),
                DeleteAction::make()->label('Hapus'),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->searchPlaceholder(__('Cari halaman...'))
            ->emptyStateHeading(__('Belum ada halaman dinamis'))
            ->emptyStateDescription('Klik tombol "Buat Halaman Baru" untuk menambahkan halaman pertama pada menu ini.')
            ->emptyStateIcon('heroicon-o-document-plus');
    }
}
