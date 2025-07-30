<x-filament-panels::page>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">{{ $this->getTitle() }}</h2>
            
            <div class="flex space-x-2">
                @if ($this->getTable()->getRecords()->count() > 0)
                    <x-filament::button
                        icon="heroicon-o-document-arrow-down"
                        wire:click="exportPdf"
                        color="success"
                    >
                        Exportar a PDF
                    </x-filament::button>
                @endif
            </div>
        </div>
        
        {{ $this->table }}
    </div>
    
    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('exportPdf', (filters) => {
                    const queryString = new URLSearchParams(filters).toString();
                    window.open(`/reports/claim-attentions?${queryString}`, '_blank');
                });
                
                Livewire.on('exportBulkPdf', (ids) => {
                    window.open(`/reports/claim-attentions/bulk-pdf?ids=${ids.join(',')}`, '_blank');
                });
            });
        </script>
    @endpush
</x-filament-panels::page>
