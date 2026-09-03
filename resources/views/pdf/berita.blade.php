<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $post->title }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #10b981;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #042f2e;
            margin-bottom: 10px;
        }
        .meta {
            font-size: 12px;
            color: #64748b;
        }
        .content {
            text-align: justify;
        }
        .content img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $post->title }}</div>
        <div class="meta">
            Oleh: {{ $post->penulis ?? 'Inspektorat' }} | 
            Kategori: {{ $post->category ? $post->category->name : 'Berita' }} | 
            Tanggal: {{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('d F Y') }}
        </div>
    </div>
    
    @if($post->file && $post->file->path)
        <div style="text-align: center; margin-bottom: 20px;">
            @php
                $thumbnailPath = public_path('storage/' . $post->file->path);
            @endphp
            @if(file_exists($thumbnailPath))
                <img src="{{ $thumbnailPath }}" alt="Thumbnail Berita" style="max-width: 100%; height: auto; border-radius: 4px;">
            @endif
        </div>
    @endif

    <div class="content">
        {!! $post->content !!}
    </div>
</body>
</html>
