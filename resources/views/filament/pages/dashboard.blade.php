<x-filament-panels::page>
    {{ $this->getHeaderWidgets() }}

    {{ $this->getWidgets() }}

    <x-filament::tabs>
        <x-filament::tabs.item
            :active="$activeTab === 'recent'"
            wire:click="$set('activeTab', 'recent')"
        >
            Recent Asset
        </x-filament::tabs.item>

        <x-filament::tabs.item
            :active="$activeTab === 'damaged'"
            wire:click="$set('activeTab', 'damaged')"
        >
            Damaged Asset
        </x-filament::tabs.item>
    </x-filament::tabs>

    @if ($activeTab === 'recent')
        @livewire(\App\Filament\Widgets\RecentAssetWidget::class)
    @endif

    @if ($activeTab === 'damaged')
        @livewire(\App\Filament\Widgets\DamagedAssetWidget::class)
    @endif

</x-filament-panels::page>
