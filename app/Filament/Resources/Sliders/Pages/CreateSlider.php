<?php

namespace App\Filament\Resources\Sliders\Pages;

use App\Filament\Resources\Sliders\SliderResource;
use App\Models\Slider;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateSlider extends CreateRecord
{
    protected static string $resource = SliderResource::class;

    protected static bool $canCreateAnother = false;

    public function mount(): void
    {
        if (Slider::count() >= 10) {
            Notification::make()
                ->title(__('Batas Maksimal Tercapai'))
                ->body(__('Maksimal 10 slider sudah tercapai. Silakan hapus slider lama untuk menambah baru.'))
                ->danger()
                ->send();

            $this->redirect($this->getResource()::getUrl('index'));
            return;
        }

        parent::mount();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return __('Tambah Slider');
    }

    public function getHeadContent(): ?string
    {
        return <<<'HTML'
            <style>
                /* Override Filament page layout */
                .fi-main {
                    max-width: 100% !important;
                    padding-left: 0 !important;
                }
                .fi-page {
                    max-width: 100% !important;
                    background: #f5f5f5 !important;
                }
                .fi-page-content-wrapper {
                    max-width: 100% !important;
                }
                .fi-page-content {
                    max-width: 100% !important;
                    padding: 0 !important;
                }
                
                /* Page header */
                .fi-header {
                    background: white;
                    padding: 1rem 1.5rem;
                    border-bottom: 1px solid #e5e7eb;
                    margin-bottom: 0;
                }
                
                .fi-header-heading {
                    font-size: 1.125rem;
                    font-weight: 600;
                    color: #111827;
                    text-transform: uppercase;
                }
                
                /* Form container - align left with max-width */
                .fi-fo {
                    max-width: 1200px !important;
                    background: white;
                    border-radius: 0;
                    box-shadow: none;
                    padding: 2rem;
                    margin: 1.5rem 0 0 1.5rem !important;
                }
                
                /* Form fields layout */
                .fi-fo-component-ctn {
                    max-width: 100%;
                }
                
                /* Form labels - simple and clean */
                .fi-fo-field-wrp-label label {
                    font-weight: 400;
                    color: #374151;
                    font-size: 0.875rem;
                    margin-bottom: 0.5rem;
                    display: block;
                }
                
                /* Input fields - minimal styling */
                .fi-input,
                .fi-textarea {
                    width: 100%;
                    border: 1px solid #d1d5db !important;
                    border-radius: 0.25rem !important;
                    padding: 0.5rem 0.75rem !important;
                    font-size: 0.875rem !important;
                    background: white !important;
                    transition: border-color 0.15s !important;
                }
                
                .fi-input:focus,
                .fi-textarea:focus {
                    border-color: #06b6d4 !important;
                    outline: none !important;
                    box-shadow: none !important;
                }
                
                /* Section styling - minimal */
                .fi-section {
                    background: transparent;
                    border: none;
                    border-radius: 0;
                    padding: 0;
                    margin-top: 1.5rem;
                }
                
                .fi-section-header {
                    margin-bottom: 1rem;
                }
                
                .fi-section-header-heading {
                    font-weight: 400;
                    color: #374151;
                    font-size: 0.875rem;
                }
                
                /* Radio buttons - inline style */
                .fi-fo-radio {
                    display: flex;
                    gap: 1.5rem;
                    margin-top: 0.5rem;
                }
                
                .fi-fo-radio-option {
                    padding: 0;
                    border: none;
                    background: transparent;
                }
                
                .fi-fo-radio-option label {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    cursor: pointer;
                    font-weight: 400;
                }
                
                /* File upload - simple box */
                .fi-fo-file-upload {
                    border: 1px solid #d1d5db !important;
                    border-radius: 0.25rem !important;
                    padding: 3rem 1rem !important;
                    background: #fafafa !important;
                    text-align: center;
                }
                
                .fi-fo-file-upload:hover {
                    border-color: #06b6d4 !important;
                    background: white !important;
                }
                
                /* Buttons - cyan primary like reference */
                .fi-btn {
                    border-radius: 0.25rem !important;
                    font-weight: 500 !important;
                    padding: 0.5rem 1rem !important;
                    font-size: 0.875rem !important;
                    text-transform: uppercase;
                    letter-spacing: 0.025em;
                }
                
                .fi-btn-primary,
                .fi-btn[type="submit"] {
                    background: #06b6d4 !important;
                    color: white !important;
                    border: none !important;
                }
                
                .fi-btn-primary:hover,
                .fi-btn[type="submit"]:hover {
                    background: #0891b2 !important;
                }
                
                .fi-btn-secondary {
                    background: #0891b2 !important;
                    color: white !important;
                    border: none !important;
                }
                
                .fi-btn-secondary:hover {
                    background: #0e7490 !important;
                }
                
                /* Cancel button */
                .fi-link {
                    color: #6b7280 !important;
                    text-decoration: none !important;
                    font-size: 0.875rem !important;
                }
                
                .fi-link:hover {
                    color: #374151 !important;
                }
                
                /* Helper text */
                .fi-fo-field-wrp-hint {
                    color: #6b7280;
                    font-size: 0.75rem;
                    margin-top: 0.25rem;
                }
                
                /* Form actions */
                .fi-form-actions {
                    margin-top: 2rem;
                    padding-top: 1.5rem;
                    border-top: 1px solid #e5e7eb;
                }
                
                /* Mobile responsive */
                @media (max-width: 640px) {
                    .fi-page-content {
                        padding: 0 !important;
                    }
                    
                    .fi-fo {
                        margin: 1rem !important;
                        padding: 1.5rem;
                        max-width: 100% !important;
                    }
                    
                    .fi-header {
                        padding: 0.75rem 1rem;
                    }
                }
            </style>
        HTML;
    }

    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()
            ->label(__('Simpan'));
    }

    protected function getCreateAnotherFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateAnotherFormAction()
            ->label(__('Simpan & Buat Lagi'));
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label(__('Batal'));
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return __('Slider berhasil ditambahkan');
    }
}
