<x-filament::page>
    {{ $this->form }}

    <x-filament::button wire:click="generateReport" color="primary" class="mt-4">
        {{ __('reports.buttons.generate_report') }}
    </x-filament::button>

    <script>
        window.addEventListener('download-report', event => {
            window.open(event.detail.url, '_blank');
        });
    </script>
</x-filament::page>
