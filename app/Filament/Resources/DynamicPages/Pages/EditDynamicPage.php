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

    // Set when navigating from a menu whose page was only found via its legacy
    // hardcoded link (e.g. "/profil/visi-misi") and menu_id is still null. See
    // DynamicPageLinker and select-menu.blade.php for why this is needed.
    public ?int $linkMenuId = null;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        $linkMenuId = request()->integer('link_menu_id');

        if ($linkMenuId && blank($this->record->menu_id)) {
            $this->linkMenuId = $linkMenuId;
        }
    }

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

        $pendingMenu = $this->linkMenuId ? \App\Models\Menu::find($this->linkMenuId) : null;
        $data['public_url'] = $this->record->menu?->link ?: $pendingMenu?->link ?: '/halaman/' . $this->record->slug;

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

        // Backfill the menu_id link for legacy pages that were only discoverable
        // via their hardcoded route (e.g. "/profil/visi-misi"), so the admin's
        // "Pilih Menu Website" screen correctly detects this page next time
        // instead of prompting to create a duplicate.
        if ($this->linkMenuId && blank($data['menu_id'] ?? $this->record->menu_id)) {
            $data['menu_id'] = $this->linkMenuId;
        }

        $oldTemplate = $this->record->template;
        $newTemplate = $data['template'] ?? $oldTemplate;

        if ($oldTemplate !== $newTemplate) {
            $data['content'] = $this->migrateContentBetweenTemplates(
                is_array($data['content'] ?? null) ? $data['content'] : [],
                $oldTemplate,
                $newTemplate,
            );
        }

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

    /**
     * When the template is switched (e.g. "Penjelasan 2 Panel" -> "Penjelasan 1 Panel"),
     * the underlying content fields differ ("box_1_content"/"box_2_content" vs "isi_konten").
     * Without this, previously written text stays in the old fields and the new template
     * renders empty ("Konten belum tersedia") even though the old data still exists.
     */
    private function migrateContentBetweenTemplates(array $content, ?string $oldTemplate, ?string $newTemplate): array
    {
        $textTemplates = ['penjelasan_1', 'penjelasan_2', 'blank_editor'];

        if (! in_array($oldTemplate, $textTemplates, true) || ! in_array($newTemplate, $textTemplates, true)) {
            return $content;
        }

        $legacyText = collect([
            $content['isi_konten'] ?? null,
            $content['editor'] ?? null,
            trim(($content['box_1_content'] ?? '') . "\n\n" . ($content['box_2_content'] ?? '')),
        ])
            ->map(fn ($value) => $this->normalizeEditorContentToString($value))
            ->first(fn ($value) => trim($value) !== '');

        if (blank($legacyText)) {
            return $content;
        }

        if (in_array($newTemplate, ['penjelasan_1', 'blank_editor'], true) && blank($content['isi_konten'] ?? null)) {
            $content['isi_konten'] = $legacyText;
        } elseif ($newTemplate === 'penjelasan_2' && blank($content['box_1_content'] ?? null)) {
            $content['box_1_content'] = $legacyText;
        }

        return $content;
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
