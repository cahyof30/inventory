<?php

namespace App\Filament\Resources\Items\Pages;

use App\Filament\Resources\Items\ItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
{
    return [
        'all' => Tab::make('Semua Data'),
        
        'kendaraan' => Tab::make('Kendaraan')
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('category', function ($q) {
                $q->where('slug', 'kendaraan');
            }))
            ->icon('heroicon-m-truck'),

        'peralatan' => Tab::make('Peralatan')
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('category', function ($q) {
                $q->where('slug', '!=', 'kendaraan');
            }))
            ->icon('heroicon-m-tv'),
    ];
}
}

