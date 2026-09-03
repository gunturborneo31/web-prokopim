<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'pesan' => ['required', 'string', 'min:10'],
        ]);

        $ticketCode = 'FB-' . now()->format('Y') . '-' . str_pad((string) random_int(1, 99999), 5, '0', STR_PAD_LEFT);

        Pengaduan::create([
            'kode_laporan' => $ticketCode,
            'kategori' => 'saran',
            'nama_lengkap' => $data['nama'],
            'telepon' => $data['no_hp'],
            'judul_laporan' => 'Masukan dan Saran Website',
            'kronologis' => $data['pesan'],
            'status' => 'baru',
        ]);

        return response()->json([
            'message' => 'Masukan berhasil dikirim.',
            'ticket' => $ticketCode,
        ]);
    }
}