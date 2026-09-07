<?php

namespace App\Services;

use App\Models\DynamicPage;
use App\Models\Menu;
use Illuminate\Support\Str;

/**
 * Some menus were seeded with hardcoded legacy links (e.g. "/profil/visi-misi",
 * "/regulasi/undang-undang") that are served by dedicated legacy routes/controllers
 * which look up a DynamicPage by slug — completely independent of the "menu_id"
 * foreign key. Those DynamicPage rows therefore have menu_id = NULL even though
 * they already have real content and are shown on the frontend.
 *
 * The Filament admin ("Pilih Menu Website") only checked DynamicPage::menu_id to
 * decide whether a menu "already has a page", so it wrongly reported these menus
 * as empty — leading admins to create a brand new (empty) page and duplicate slug
 * such as "visi-misi-2", which then overwrote the menu's link and broke the page
 * ("Konten belum tersedia") while the real content stayed orphaned.
 *
 * This service centralizes the lookup so admin screens can find the *existing*
 * legacy page for a menu instead of assuming there isn't one.
 */
class DynamicPageLinker
{
    /**
     * Prefixes used by legacy hardcoded routes that resolve a DynamicPage by slug.
     * See routes/web.php ("/profil/*", "/regulasi/*", "/dokumen/*", "/halaman/*").
     */
    private const LEGACY_PREFIXES = ['profil', 'regulasi', 'dokumen', 'halaman', 'layanan'];

    /**
     * Resolve the DynamicPage that actually belongs to this menu — whether it is
     * properly linked via menu_id, or only discoverable via its legacy slug-based link.
     */
    public static function resolveForMenu(Menu $menu): ?DynamicPage
    {
        $linked = DynamicPage::query()->where('menu_id', $menu->id)->first();

        if ($linked) {
            return $linked;
        }

        $slug = self::extractSlugFromLink($menu->link);

        if ($slug === null) {
            return null;
        }

        return DynamicPage::query()
            ->where('slug', $slug)
            ->whereNull('menu_id')
            ->first();
    }

    /**
     * Extract the trailing slug segment from a legacy link such as "/profil/visi-misi".
     */
    public static function extractSlugFromLink(?string $link): ?string
    {
        $link = trim((string) $link);

        if ($link === '' || $link === '/' || $link === '#') {
            return null;
        }

        $prefixPattern = implode('|', self::LEGACY_PREFIXES);

        if (! preg_match('~^/(?:' . $prefixPattern . ')/([a-z0-9\-]+)~i', $link, $matches)) {
            return null;
        }

        return Str::slug($matches[1]);
    }
}
