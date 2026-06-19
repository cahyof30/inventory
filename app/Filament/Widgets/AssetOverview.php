<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use Filament\Forms\Components\Builder;
use Filament\Widgets\Widget;

class AssetOverview extends Widget
{
    protected string $view = 'filament.widgets.asset-overview';

    public string $activeTab = 'recent';

    public function getTableQuery(): Builder
{
    return match ($this->type) {
        'recent' => Item::latest(),
        'damaged' => Item::where('condition', 'damaged'),
    };
}
}
