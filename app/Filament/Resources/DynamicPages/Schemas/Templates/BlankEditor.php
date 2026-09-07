<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class BlankEditor implements TemplateSchema
{
    public static function schema(): array
    {
        return [
            Section::make('Konten Bebas')
                ->schema([
                    MarkdownEditor::make('content.isi_konten')
                        ->label('Isi Konten Bebas')
                        ->placeholder('Tulis konten bebas di sini...')
                        ->helperText('Editor ini mendukung input teks normal dan upload gambar langsung dari toolbar.')
                        ->toolbarButtons([
                            ['bold', 'italic', 'strike', 'link'],
                            ['heading'],
                            ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                            ['table', 'attachFiles'],
                            ['undo', 'redo'],
                        ])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('dynamic-pages/editor')
                        ->fileAttachmentsMaxSize(12288)
                        ->minHeight('600px')
                        ->columnSpanFull()
                        ,
                ]),

            Section::make('Media Pendukung')
                ->description('Tambahkan beberapa gambar dan video dari upload file atau URL eksternal.')
                ->schema([
                    Repeater::make('content.media_items')
                        ->label('Daftar Media')
                        ->defaultItems(0)
                        ->schema([
                            Select::make('type')
                                ->label('Jenis Media')
                                ->options([
                                    'image' => 'Gambar',
                                    'video' => 'Video',
                                ])
                                ->default('image')
                                ->required()
                                ->native(false),

                            FileUpload::make('upload')
                                ->label('Upload File')
                                ->disk('public')
                                ->directory('dynamic-pages/media')
                                ->imageEditor()
                                ->visible(fn ($get) => $get('type') === 'image')
                                ->image(),

                            FileUpload::make('video_upload')
                                ->label('Upload Video')
                                ->disk('public')
                                ->directory('dynamic-pages/media')
                                ->acceptedFileTypes([
                                    'video/mp4',
                                    'video/webm',
                                    'video/ogg',
                                    'video/quicktime',
                                ])
                                ->maxSize(102400)
                                ->visible(fn ($get) => $get('type') === 'video'),

                            TextInput::make('url')
                                ->label('URL Media')
                                ->placeholder('https://example.com/file atau YouTube/Vimeo URL')
                                ->url(),

                            TextInput::make('caption')
                                ->label('Caption')
                                ->placeholder('Keterangan media'),
                        ])
                        ->columns(2)
                        ->grid(1)
                        ->columnSpanFull(),
                ])
                ->columns(1),
        ];
    }
}
