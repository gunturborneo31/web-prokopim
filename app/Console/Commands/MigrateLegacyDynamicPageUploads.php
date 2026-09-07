<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * FileUpload fields for dynamic-pages templates (Gambar1, Galeri, Aparatur,
 * ProfilPimpinan, BlankEditor media, Dokumen) did not specify ->disk('public'),
 * so they inherited config('filament.default_filesystem_disk'), which resolves
 * to whatever FILESYSTEM_DISK is set to in .env. When FILESYSTEM_DISK=local,
 * uploads silently landed in the private "local" disk (storage/app/private)
 * instead of the public disk (storage/app/public) that is served via the
 * "storage" symlink — so images appeared fine in the Filament admin preview
 * (which can read the private disk directly) but were unreachable from the
 * public frontend URL, showing as broken/missing images.
 *
 * This command moves any files already uploaded to the wrong (private) disk,
 * under the known directories used by these templates, into the public disk
 * so existing content starts working without needing to be re-uploaded.
 */
class MigrateLegacyDynamicPageUploads extends Command
{
    protected $signature = 'dynamic-pages:migrate-legacy-disk {--fix : Actually move the files instead of only reporting}';

    protected $description = 'Move dynamic-page uploads that ended up on the private "local" disk into the public disk';

    private const DIRECTORIES = [
        'dynamic-pages',
        'dynamic-pages/aparatur',
        'dynamic-pages/leaders',
        'dynamic-pages/media',
        'dokumen-dinamis',
    ];

    public function handle(): int
    {
        $fix = (bool) $this->option('fix');
        $local = Storage::disk('local');
        $public = Storage::disk('public');

        $moved = 0;
        $skipped = 0;

        foreach (self::DIRECTORIES as $directory) {
            if (! $local->exists($directory)) {
                continue;
            }

            foreach ($local->allFiles($directory) as $path) {
                if ($public->exists($path)) {
                    $this->comment("SKIP (already on public disk): {$path}");
                    $skipped++;

                    continue;
                }

                $this->line($path);

                if ($fix) {
                    $public->put($path, $local->get($path));
                    $local->delete($path);
                    $this->info('  ✔ Moved to public disk');
                } else {
                    $this->comment('  → would move (run with --fix to apply)');
                }

                $moved++;
            }
        }

        $this->newLine();
        $this->info(($fix ? 'Moved' : 'Would move') . ": {$moved}");
        $this->info("Already correct (skipped): {$skipped}");

        if (! $fix && $moved > 0) {
            $this->newLine();
            $this->comment('Run again with --fix to apply the move.');
        }

        return self::SUCCESS;
    }
}
