<?php

namespace App\Filament\Pages;

use App\Models\Widget;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;

class GprWidget extends Page implements HasForms
{
    use InteractsWithForms;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-chat-bubble-bottom-center-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false; // Dipindahkan ke WebsiteIdentity
    }

    protected static ?int $navigationSort = 7;

    protected static ?string $title = 'GPR Kominfo';

    protected string $view = 'filament.pages.gpr-widget';

    public ?array $data = [];

    public function mount(): void
    {
        $widget = Widget::firstOrCreate([], [
            'status' => false,
            'rss_url' => 'https://widget.kominfo.go.id/data/latest/gpr.xml',
            'position' => 'sidebar_right',
            'width' => 500,
        ]);

        $this->form->fill($widget->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Konfigurasi GPR Kominfo'))
                    ->description(__('Atur tampilan widget GPR Kominfo pada website utama.'))
                    ->schema([
                        Toggle::make('status')
                            ->label(__('Status Widget'))
                            ->helperText(__('Aktifkan untuk menampilkan widget di website.'))
                            ->default(false),
                            
                        TextInput::make('rss_url')
                            ->label(__('URL RSS'))
                            ->default('https://widget.kominfo.go.id/data/latest/gpr.xml')
                            ->required()
                            ->url()
                            ->columnSpanFull(),
                    ])->columns(1),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Validate RSS URL
        if ($data['status']) {
            try {
                $response = Http::timeout(5)->get($data['rss_url']);
                if ($response->failed()) {
                     Notification::make()
                        ->title(__('Peringatan: URL RSS Tidak Dapat Diakses'))
                        ->body(__('Widget tetap disimpan, namun URL RSS tampaknya tidak valid atau tidak dapat diakses dari server ini.'))
                        ->warning()
                        ->send();
                }
            } catch (\Exception $e) {
                 Notification::make()
                    ->title(__('Peringatan: Gagal Menghubungi URL RSS'))
                    ->body(__('Widget tetap disimpan. Error: ') . $e->getMessage())
                    ->warning()
                    ->send();
            }
        }

        $widget = Widget::first();
        if ($widget) {
            $widget->update($data);
        } else {
            Widget::create($data);
        }

        Notification::make()
            ->title(__('Berhasil disimpan'))
            ->success()
            ->send();
    }

    public function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label(__('Simpan Perubahan'))
                ->submit('save'),
            \Filament\Actions\Action::make('preview')
                ->label(__('Lihat Preview'))
                ->url(url('/')) 
                ->openUrlInNewTab()
                ->color('gray'),
        ];
    }
}
