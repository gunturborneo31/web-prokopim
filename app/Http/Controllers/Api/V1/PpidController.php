<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ppid;
use App\Http\Resources\V1\PpidResource;
use Illuminate\Http\Request;

class PpidController extends Controller
{
    public function index(Request $request)
    {
        // Ambil root PPID (Jenis) yang tidak punya parent saja, tanpa meload semua isinya
        $query = Ppid::whereNull('parent_id');

        // Filter berdasarkan nama (jenis) jika diperlukan
        if ($request->filled('nama')) {
            $query->where('name', 'like', '%' . $request->nama . '%');
        }

        // Karena datanya berbentuk list parent, kita pakai get() saja tanpa pagination
        $ppids = $query->get();

        return PpidResource::collection($ppids);
    }
    
    // Mendapatkan spesifik Jenis/Kategori beserta Kategori Anak dan File-nya
    public function show($id)
    {
        // Hanya load immediate children (kategori anak) dan items (file)
        $ppid = Ppid::with(['children', 'items'])->findOrFail($id);
        
        return new PpidResource($ppid);
    }
}
