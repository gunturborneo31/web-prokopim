<?php

namespace App\Filament\Widgets;

use App\Models\PpidRequest;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class PpidRequestTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Daftar Permohonan Informasi';
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(PpidRequest::query())
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->label('NAMA')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('no_telepon')
                    ->label('TELP'),
                TextColumn::make('nik')
                    ->label('NIK'),
                TextColumn::make('alamat')
                    ->limit(30),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diajukan' => 'gray',
                        'diproses' => 'warning',
                        'disetujui' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('TANGGAL')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ]);
    }
}
