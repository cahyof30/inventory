<?php

namespace App\Filament\Pages;

use App\Models\Item;
use Filament\Pages\Page;

class AssetDetail extends Page
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = Item::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-archive-box';

    // protected static string|\UnitEnum|null $navigationGroup = 'Tools';

    // protected static ?string $navigationLabel = 'Scan QR Asset';

     protected string $view = 'filament.pages.asset-detail';

    public Item $item;

     public function mount(string $uuid): void
    {
        dd($uuid);
        // $this->item = Item::with([
        //     'company',
        //     'location',
        // ])
        // ->where('public_uuid', $uuid)
        // ->firstOrFail();
    }
}
