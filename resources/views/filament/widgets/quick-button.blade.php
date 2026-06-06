<x-filament-widgets::widget>
   <div style="display:flex; justify-content:flex-end; width:100%;">
    <div style="display:flex; gap:12px;">
        @foreach($buttons as $button)
            <a href="{{ $button['url'] }}">
                <x-filament::button
                    :color="$button['color']"
                    :icon="$button['icon']"
                    class="w-full">
                    {{ $button['label'] }}
                </x-filament::button>
            </a>
        @endforeach
            </div>
    </div>
</x-filament-widgets::widget>
