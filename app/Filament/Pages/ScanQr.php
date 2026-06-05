<?php

namespace App\Filament\Pages;

use App\Models\Item;
use Filament\Pages\Page;

class ScanQr extends Page
{
    // protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    // protected static ?string $navigationLabel = 'Scan QR Asset';

    // protected static ?string $navigationGroup = 'Tools';

    
    protected static ?string $model = Item::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-qr-code';
    protected static string|\UnitEnum|null $navigationGroup = 'Tools';
    protected static ?string $navigationLabel = 'Scan QR Asset';
    protected static ?int $navigationSort = 1;
    protected string $view = 'filament.pages.scan-qr';
    public function mount()
    {
        redirect()->route('items.scan-camera');
    }

}
