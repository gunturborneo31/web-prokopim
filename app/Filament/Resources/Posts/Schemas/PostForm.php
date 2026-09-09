<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Tabs::make('Post')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Konten Utama')
                            ->icon('heroicon-m-document-text')
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('Judul'))
                                    ->required()
                                    ->columnSpanFull()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, \Filament\Schemas\Components\Utilities\Set $set) {
                                        if ($operation === 'create') {
                                            $set('slug', \Illuminate\Support\Str::slug($state));
                                        }
                                    }),
                                Select::make('category_id')
                                    ->label(__('Kategori'))
                                    ->relationship('category', 'name')
                                    ->native(false)
                                    ->required()
                                    ->default(fn () => \App\Models\PostCategory::where('slug', 'berita')->value('id'))
                                    ->helperText(__('Pilih "Uncategorized" agar tulisan ini disembunyikan dari daftar & pencarian Berita publik (hanya bisa diakses lewat tautan langsung).'))
                                    ->columnSpanFull(),
                                \Filament\Forms\Components\TagsInput::make('tags')
                                    ->label(__('Hashtag'))
                                    ->columnSpanFull()
                                    ->helperText(__('Tekan tombol enter setelah mengetik setiap hashtag. Hashtag ini dipakai sebagai filter di halaman daftar Berita.'))
                                    ->suggestions(fn () => \App\Models\Post::query()
                                        ->whereNotNull('tags')
                                        ->pluck('tags')
                                        ->flatMap(fn ($tags) => is_array($tags) ? $tags : [])
                                        ->unique()
                                        ->sort()
                                        ->values()
                                        ->all()),
                                \Filament\Forms\Components\FileUpload::make('thumbnail')
                                    ->label(__('Thumbnail'))
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->directory('posts/thumbnails')
                                    ->visibility('public')
                                    ->helperText(__('Format: JPG, PNG, atau GIF.'))
                                    ->columnSpanFull()
                                    ->dehydrated(false)
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state) {
                                            $name = is_string($state) ? basename($state) : $state->getClientOriginalName();
                                            $size = 0;
                                            $path = $state;

                                            try {
                                                if ($state instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                                                    $size = $state->getSize();
                                                    $path = $state->store('posts/thumbnails', 'public');
                                                } else {
                                                    $size = \Storage::disk('public')->size($state);
                                                }
                                            } catch (\Exception $e) {
                                                $size = 0;
                                            }

                                            $file = \App\Models\File::create([
                                                'name' => $name,
                                                'path' => $path,
                                                'type' => 'image',
                                                'size' => $size,
                                            ]);
                                            $set('file_id', $file->id);
                                        }
                                    }),
                                DateTimePicker::make('published_at')
                                    ->label(__('Tanggal Publish')),
                                TextInput::make('penulis')
                                    ->label(__('Penulis'))
                                    ->default(fn() => auth()->user()->name),
                                \Filament\Forms\Components\RichEditor::make('content')
                                    ->label(__('Konten'))
                                    ->columnSpanFull(),
                                Select::make('status')
                                    ->options([
                                        1 => __('Tayang'),
                                        0 => __('Konsep'),
                                    ])
                                    ->default(1)
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        \Filament\Schemas\Components\Tabs\Tab::make('Optimasi SEO')
                            ->icon('heroicon-m-magnifying-glass-circle')
                            ->schema([
                                TextInput::make('seo.meta_title')
                                    ->label(__('Meta Title'))
                                    ->placeholder(__('Biarkan kosong untuk menggunakan Judul Berita'))
                                    ->maxLength(60)
                                    ->hintIcon('heroicon-m-information-circle', tooltip: __('Maksimal 60 karakter agar tidak terpotong di Google.')),
                                    
                                Textarea::make('seo.meta_description')
                                    ->label(__('Meta Description'))
                                    ->placeholder(__('Biarkan kosong untuk menggunakan potongan awal konten berita'))
                                    ->rows(3)
                                    ->maxLength(160)
                                    ->hintIcon('heroicon-m-information-circle', tooltip: __('Maksimal 160 karakter agar tampil utuh di pencarian.')),
                                    
                                \Filament\Forms\Components\FileUpload::make('seo.meta_image')
                                    ->label(__('Meta Share Image (Opsional)'))
                                    ->image()
                                    ->directory('posts/seo')
                                    ->visibility('public')
                                    ->hintIcon('heroicon-m-information-circle', tooltip: __('Biarkan kosong untuk menggunakan thumbnail utama.')),
                            ])
                            ->columns(1),
                    ])
                    ->columnSpanFull(),

                \Filament\Forms\Components\Hidden::make('slug')
                    ->default(fn($record) => $record?->slug ?? ''),
                \Filament\Forms\Components\Hidden::make('file_id'),
                \Filament\Forms\Components\Hidden::make('type')
                    ->default('post'),
                \Filament\Forms\Components\Hidden::make('user_id')
                    ->default(fn() => auth()->id()),
            ]);
    }
}
