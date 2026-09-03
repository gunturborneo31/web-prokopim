<x-layouts.app>
    <!-- GLOBAL WRAPPER -->
    <div class="min-h-screen text-instansi-text-main relative">

        @include('sections.hero')

        @include('sections.slider-pengumuman')

        @include('sections.layanan-utama')

        @include('sections.kabar-terkini')
        
        @include('sections.agenda')

        @include('sections.gallery')

        @include('sections.insight')

        @include('sections.sosmed')
        
        @include('sections.layanan')
    </div>
</x-layouts.app>
