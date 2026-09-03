<?php

namespace App\Observers;

use App\Models\Menu;
use App\Models\Post;

class PostObserver
{
    /**
     * Sync order di tabel menus saat sort_order profil_buletin berubah.
     */
    public function updated(Post $post): void
    {
        $this->syncMenuOrder($post);
    }

    public function saved(Post $post): void
    {
        $this->syncMenuOrder($post);
    }

    protected function syncMenuOrder(Post $post): void
    {
        if ($post->type !== 'profil_buletin' || $post->sort_order === null) {
            return;
        }

        // Cari menu yang link-nya mengarah ke slug profil ini
        $link = '/buletin/profil/' . $post->slug;

        Menu::where('link', $link)
            ->update(['order' => $post->sort_order]);
    }
}
