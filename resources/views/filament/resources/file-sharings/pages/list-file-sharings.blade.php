<x-filament-panels::page>
    {{-- Custom CSS from Page Class --}}
    @if(isset($customCss))
        {!! $customCss !!}
    @endif

    <script>
        function copyShareLink(button) {
            const url = button.getAttribute('data-share-url');
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(() => {
                    window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Link berhasil disalin!', type: 'success' } }));
                });
            }
        }
    </script>

    <div id="file-sharing-container" class="{{ $this->viewMode === 'list' ? 'list-mode-view' : 'grid-mode-view' }}">
        {{ $this->table }}
    </div>
</x-filament-panels::page>
