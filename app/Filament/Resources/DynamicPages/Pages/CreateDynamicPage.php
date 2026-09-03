<?php

namespace App\Filament\Resources\DynamicPages\Pages;

use App\Filament\Resources\DynamicPages\DynamicPageResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateDynamicPage extends CreateRecord
{
    protected static string $resource = DynamicPageResource::class;

    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    // Persistent Livewire properties — survive re-renders (query params are lost after initial request)
    public ?int    $pageMenuId  = null;
    public string  $pageTemplate = '';
    public string  $pageTitle   = '';
    public string  $pageSlug    = '';
    public string  $pagePublicUrl = '';

    public function mount(): void
    {
        parent::mount();

        // Pre-fill from query params (passed from SelectTemplatePage)
        if (request()->has('template')) {
            $this->pageMenuId   = request()->integer('menu_id') ?: null;
            $this->pageTemplate = request('template', '');
            $this->pageTitle    = request('title', '');
            $this->pageSlug     = request('slug', Str::slug(request('title', '')));
            $this->pagePublicUrl = request('public_url', '/halaman/' . $this->pageSlug);

            $this->form->fill([
                'template' => $this->pageTemplate,
                'title'    => $this->pageTitle,
                'slug'     => $this->pageSlug,
                'public_url' => $this->pagePublicUrl,
                'menu_id'  => $this->pageMenuId,
            ]);
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure critical fields are always set using persisted Livewire properties
        // as fallback (hidden field values can be lost on Livewire re-renders)
        if (empty($data['menu_id']) && $this->pageMenuId)    $data['menu_id']  = $this->pageMenuId;
        if (empty($data['template']) && $this->pageTemplate) $data['template'] = $this->pageTemplate;
        if (empty($data['title']) && $this->pageTitle)       $data['title']    = $this->pageTitle;
        if (empty($data['slug']) && $this->pageSlug)         $data['slug']     = $this->pageSlug;

        $publicUrl = $this->normalizePublicUrl($data['public_url'] ?? $this->pagePublicUrl);
        $data['public_url'] = $publicUrl;
        $data['slug'] = $this->extractSlugFromPublicUrl($publicUrl, $data['slug'] ?? $this->pageSlug);

        if (($data['template'] ?? null) === 'blank_editor') {
            $content = $data['content'] ?? [];

            if (is_array($content) && array_key_exists('isi_konten', $content)) {
                $content['isi_konten'] = $this->normalizeEditorContentToString($content['isi_konten']);
                unset($content['editor']);
                $data['content'] = $content;
            }
        }

        unset($data['public_url']);

        return $data;
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // 1-to-1 enforcement: if a page already exists for this menu, update it instead of creating
        if (!empty($data['menu_id'])) {
            $existing = \App\Models\DynamicPage::where('menu_id', $data['menu_id'])->first();
            if ($existing) {
                $existing->update($data);
                return $existing;
            }
        }

        // Also handle duplicate slug gracefully: append suffix if needed
        $baseSlug = $data['slug'];
        $slug     = $baseSlug;
        $i        = 2;
        while (\App\Models\DynamicPage::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }
        $data['slug'] = $slug;

        return parent::handleRecordCreation($data);
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        
        if ($record->menu_id) {
            $menu = \App\Models\Menu::find($record->menu_id);
            if ($menu) {
                $menu->update([
                    'link' => $this->resolvePublicUrl($record->slug, $this->pagePublicUrl)
                ]);
            }
        }
    }

    protected function normalizePublicUrl(?string $url): string
    {
        $path = trim((string) $url);

        if ($path === '') {
            return '/halaman';
        }

        if (! str_starts_with($path, '/')) {
            $path = '/' . $path;
        }

        return rtrim($path, '/');
    }

    protected function extractSlugFromPublicUrl(string $publicUrl, string $fallbackSlug): string
    {
        $segments = array_values(array_filter(explode('/', trim($publicUrl, '/'))));
        $lastSegment = $segments[array_key_last($segments)] ?? '';

        if ($lastSegment === 'halaman' || $lastSegment === '') {
            return $fallbackSlug ?: Str::slug($this->pageTitle ?: 'halaman');
        }

        return Str::slug($lastSegment);
    }

    protected function resolvePublicUrl(string $slug, ?string $publicUrl = null): string
    {
        $normalized = $this->normalizePublicUrl($publicUrl ?: $this->pagePublicUrl);

        if ($normalized !== '/halaman' && str_ends_with($normalized, '/' . $slug)) {
            return $normalized;
        }

        if ($normalized === '/halaman') {
            return $normalized;
        }

        return '/halaman/' . ltrim($slug, '/');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label(__('Kembali'))
                ->color('gray')
                ->icon('heroicon-m-arrow-left')
                ->url(function () {
                    $menuId = $this->pageMenuId ?? request()->query('menu_id');
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
        ];
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
}
