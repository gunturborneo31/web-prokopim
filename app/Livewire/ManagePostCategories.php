<?php

namespace App\Livewire;

use App\Models\PostCategory;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Livewire\Component;

class ManagePostCategories extends Component implements HasForms, HasTable, HasActions
{
    use InteractsWithForms;
    use InteractsWithTable;
    use InteractsWithActions;

    public function table(Table $table): Table
    {
        return $table
            ->query(PostCategory::query()->withCount('posts'))
            ->columns([
                TextColumn::make('index')
                    ->label('#')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label(__('Nama Kategori'))
                    ->searchable(),
                TextColumn::make('posts_count')
                    ->label(__('Jumlah Post'))
                    ->badge()
                    ->color('info')
                    ->alignCenter(),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make()
                    ->label(__('Tambah Kategori'))
                    ->modalHeading(__('Tambah Kategori'))
                    ->form([
                        TextInput::make('name')
                            ->label(__('Nama Kategori'))
                            ->required()
                            ->live(onBlur: true),
                        TextInput::make('slug')
                            ->hidden(),
                    ])
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['slug'] = Str::slug($data['name']);
                        return $data;
                    })
                    ->createAnother(false),
            ])
            ->actions([
                EditAction::make()
                    ->label(__('Ubah'))
                    ->button()
                    ->modalHeading(__('Ubah Kategori Post'))
                    ->form([
                         TextInput::make('name')
                            ->label(__('Nama Kategori'))
                            ->required()
                            ->live(onBlur: true),
                        TextInput::make('slug')
                            ->hidden(),
                    ])
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['slug'] = Str::slug($data['name']);
                        return $data;
                    }),
                DeleteAction::make()
                    ->label(__('Hapus'))
                    ->button(),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->actionsAlignment('center');
    }

    public function render()
    {
        return view('livewire.manage-post-categories');
    }
}
