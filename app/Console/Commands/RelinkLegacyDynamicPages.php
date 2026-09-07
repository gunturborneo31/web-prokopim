<?php

namespace App\Console\Commands;

use App\Models\DynamicPage;
use App\Models\Menu;
use App\Services\DynamicPageLinker;
use Illuminate\Console\Command;

/**
 * Backfills DynamicPage::menu_id for legacy pages that are only discoverable
 * through a hardcoded route (e.g. "/profil/visi-misi") so the admin's
 * "Pilih Menu Website" screen stops reporting them as missing and admins stop
 * accidentally creating duplicate pages (see DynamicPageLinker for context).
 */
class RelinkLegacyDynamicPages extends Command
{
    protected $signature = 'dynamic-pages:relink-legacy {--fix : Actually write the menu_id backfill instead of only reporting}';

    protected $description = 'Audit (and optionally fix) dynamic pages that exist but are not linked to their menu via menu_id';

    public function handle(): int
    {
        $fix = (bool) $this->option('fix');
        $menus = Menu::query()->whereNotNull('link')->get();

        $backfilled = 0;
        $conflicts = 0;
        $ok = 0;

        foreach ($menus as $menu) {
            $linked = DynamicPage::query()->where('menu_id', $menu->id)->first();

            if ($linked) {
                $ok++;
                continue;
            }

            $slug = DynamicPageLinker::extractSlugFromLink($menu->link);

            if ($slug === null) {
                continue;
            }

            $candidates = DynamicPage::query()->where('slug', $slug)->get();

            if ($candidates->isEmpty()) {
                continue;
            }

            $unlinked = $candidates->whereNull('menu_id');

            if ($unlinked->count() === 1) {
                $page = $unlinked->first();

                $this->line("Menu #{$menu->id} \"{$menu->name}\" ({$menu->link}) -> DynamicPage #{$page->id} (slug={$page->slug})");

                if ($fix) {
                    $page->update(['menu_id' => $menu->id]);
                    $this->info("  ✔ Linked (menu_id set to {$menu->id})");
                } else {
                    $this->comment('  → would link (run with --fix to apply)');
                }

                $backfilled++;

                continue;
            }

            if ($unlinked->count() > 1) {
                $conflicts++;
                $this->warn("Menu #{$menu->id} \"{$menu->name}\" ({$menu->link}) has MULTIPLE unlinked candidate pages with slug \"{$slug}\":");
                foreach ($unlinked as $page) {
                    $hasContent = filled(array_filter((array) $page->content));
                    $this->warn("    - DynamicPage #{$page->id} (template={$page->template}, content=" . ($hasContent ? 'FILLED' : 'EMPTY') . ')');
                }
                $this->warn('    Please resolve manually (pick the correct page and set its menu_id).');
            }
        }

        $this->newLine();
        $this->info("Already linked: {$ok}");
        $this->info(($fix ? 'Linked now' : 'Would link') . ": {$backfilled}");

        if ($conflicts > 0) {
            $this->warn("Conflicts needing manual review: {$conflicts}");
        }

        if (! $fix && $backfilled > 0) {
            $this->newLine();
            $this->comment('Run again with --fix to apply the backfill.');
        }

        return self::SUCCESS;
    }
}
