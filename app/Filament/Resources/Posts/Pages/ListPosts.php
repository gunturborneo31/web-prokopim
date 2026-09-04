<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Models\PostCategory;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        $categories = PostCategory::query()
            ->orderBy('name')
            ->get();

        return [
            Action::make('categories')
                ->label(__('Kelola Kategori'))
                ->icon('heroicon-o-tag')
                ->modalHeading(__('Daftar Kategori Tulisan'))
                ->modalContent(fn () => view('filament.resources.posts.pages.categories-modal'))
                ->modalSubmitAction(false)
                ->modalCancelAction(false)
                ->slideOver(false)
                ->modalWidth('4xl'),

            ActionGroup::make(
                $categories->map(
                    fn (PostCategory $category): Action => Action::make('create_' . $category->id)
                        ->label(__($category->name))
                        ->url(PostResource::getUrl('create', ['category_id' => $category->id]))
                )->all()
            )
                ->label(__('Tambah Tulisan'))
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->button()
                ->extraDropdownAttributes([
                    'data-category-search-dropdown' => 'posts-create',
                ])
                ->dropdownMaxHeight('24rem')
                ->dropdownWidth('xl'),
        ];
    }
}
