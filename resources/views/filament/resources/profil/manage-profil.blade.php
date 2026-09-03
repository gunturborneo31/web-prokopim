<x-filament-panels::page>
    @php
        $record = $this->getRecord();
    @endphp

    <div class="space-y-6">
        @include('filament.resources.profil.preview-card', ['record' => $record])
    </div>
</x-filament-panels::page>
