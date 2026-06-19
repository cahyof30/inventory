<x-filament-widgets::widget>
    <x-filament::section>
       
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

        <div class="mt-6">
            @if($activeTab === 'recent')
                @livewire(\App\Filament\Widgets\RecentAssetWidget::class)
            @endif

            @if($activeTab === 'damaged')
                @livewire(\App\Filament\Widgets\DamagedAssetWidget::class)
            @endif
        </div>


    </x-filament::section>
</x-filament-widgets::widget>
