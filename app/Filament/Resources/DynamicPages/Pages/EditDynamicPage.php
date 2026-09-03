<?php

namespace App\Filament\Resources\DynamicPages\Pages;

use App\Filament\Resources\DynamicPages\DynamicPageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class EditDynamicPage extends EditRecord
{
    protected static string $resource = DynamicPageResource::class;

    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Pastikan field utama terisi jika otomatisasi gagal
        $data['title'] = $this->record->title;
        $data['slug'] = $this->record->slug;
        $data['template'] = $this->record->template;
        $data['menu_id'] = $this->record->menu_id;
        $data['public_url'] = $this->record->menu?->link ?: '/halaman/' . $this->record->slug;

        if (($data['template'] ?? null) === 'blank_editor') {
            $content = $data['content'] ?? [];

            if (is_array($content) && filled($content['editor'] ?? null) && blank($content['isi_konten'] ?? null)) {
                $content['isi_konten'] = $content['editor'];
            }

            if (is_array($content)) {
                $content['isi_konten'] = $this->normalizeEditorContentToString($content['isi_konten'] ?? null);
                $data['content'] = $content;
            }
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['public_url']);

        if (($data['template'] ?? null) === 'blank_editor') {
            $content = $data['content'] ?? [];

            if (is_array($content) && array_key_exists('isi_konten', $content)) {
                $content['isi_konten'] = $this->normalizeEditorContentToString($content['isi_konten']);
                unset($content['editor']);
                $data['content'] = $content;
            }
        }

        return $data;
    }

    private function normalizeEditorContentToString(mixed $value): string
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        if (! is_array($value)) {
            return '';
        }

        foreach (['isi_konten', 'editor', 'content', 'body', 'text'] as $key) {
            if (array_key_exists($key, $value)) {
                $candidate = $this->normalizeEditorContentToString($value[$key]);

                if (trim($candidate) !== '') {
                    return $candidate;
                }
            }
        }

        return collect($value)
            ->map(fn ($item) => $this->normalizeEditorContentToString($item))
            ->filter(fn ($item) => trim($item) !== '')
            ->implode("\n\n");
    }

    protected function afterSave(): void
    {
        $record = $this->record;
        
        if ($record->menu_id) {
            $menu = \App\Models\Menu::find($record->menu_id);
            if ($menu) {
                $menu->update([
                    'link' => $this->resolvePublicUrl($record)
                ]);
            }
        }
    }

    protected function resolvePublicUrl(\App\Models\DynamicPage $record): string
    {
        $publicUrl = trim((string) ($record->menu?->link ?: '/halaman/' . $record->slug));

        if ($publicUrl === '') {
            return '/halaman';
        }

        if (! str_starts_with($publicUrl, '/')) {
            $publicUrl = '/' . $publicUrl;
        }

        return rtrim($publicUrl, '/');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label(__('Kembali'))
                ->color('gray')
                ->icon('heroicon-m-arrow-left')
                ->url(function () {
                    $menuId = $this->record->menu_id;
                    if ($menuId) {
                        $menu = \App\Models\Menu::find($menuId);
                        if ($menu) {
                            $root = $menu;
                            while ($root->parent_id) {
                                $parent = \App\Models\Menu::find($root->parent_id);
                                if (!$parent) break;
                                $root = $parent;
                            }
                            return DynamicPageResource::getUrl('index', ['active_id' => $root->id]);
                        }
                    }
                    return DynamicPageResource::getUrl('index');
                }),

            Action::make('save')
                ->label(__('Simpan Perubahan'))
                ->color('primary')
                ->icon('heroicon-m-check-circle')
                ->action('save'),


            DeleteAction::make(),
        ];
    }
}
