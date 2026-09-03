<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PpidItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PpidIntegrationService
{
    public static function generateAndSendToPpid(Post $post, $ppidCategoryId)
    {
        // 1. Generate PDF content
        $html = view('pdf.berita', compact('post'))->render();
        $pdf = Pdf::loadHtml($html);

        $filename = 'ppid-berita-'.$post->id.'-'.time().'.pdf';
        $path = 'ppid/'.$filename;
        Storage::disk('public')->put($path, $pdf->output());

        // 2. Check for existing PPID Item related to this post
        $existingItem = PpidItem::where('file', 'like', 'ppid/ppid-berita-'.$post->id.'-%')->first();

        if ($existingItem) {
            // Delete old physical file
            if (Storage::disk('public')->exists($existingItem->file)) {
                Storage::disk('public')->delete($existingItem->file);
            }

            // Update existing record
            $existingItem->update([
                'ppid_id' => $ppidCategoryId,
                'name' => $post->title,
                'description' => 'Salinan berita yang diterbitkan dari portal: '.$post->title,
                'penanggung_jawab' => $post->penulis ?? 'Inspektorat Kabupaten Mahakam Ulu',
                'file' => $path,
            ]);
        } else {
            // Insert into PPID Items
            PpidItem::create([
                'ppid_id' => $ppidCategoryId,
                'name' => $post->title,
                'description' => 'Salinan berita yang diterbitkan dari portal: '.$post->title,
                'tempat_pembuatan' => 'Mahakam Ulu',
                'penanggung_jawab' => $post->penulis ?? 'Inspektorat Kabupaten Mahakam Ulu',
                'format_informasi' => 'PDF',
                'tanggal_pembuatan' => $post->created_at ? $post->created_at->format('Y-m-d') : date('Y-m-d'),
                'jangka_waktu_penyimpanan' => '10 Tahun',
                'file' => $path,
                'views' => 0,
                'downloads' => 0,
            ]);
        }
    }
}
