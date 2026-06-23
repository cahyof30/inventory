<?php

namespace App\Filament\Resources\Items\Pages;

use App\Filament\Resources\Items\ItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    //  protected string $view = 'filament.pages.list-items';

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

   public function getFooter(): ?View
    {
        return view('livewire.items.mobile-card-footer', [
            'activeTab' => $this->activeTab ?? 'all',
        ]);
    }

//  public function getMobileRecords(int $perPage = 15)
//     {
//         $query = $this->getFilteredTableQuery();
 
//         // Terapkan search jika ada
//         if ($search = $this->getTableSearch()) {
//             $query->where(function (Builder $q) use ($search) {
//                 $q->where('name', 'like', "%{$search}%")
//                     ->orWhere('code', 'like', "%{$search}%");
//             });
//         }
 
//         return $query
//             ->with(['category', 'vehicleDetail', 'location', 'company'])
//             ->orderByDesc('created_at')
//             ->paginate($perPage, pageName: 'mobile_page');
//     }
 
    /**
     * Expose search value ke view.
     */
    public function getTableSearch(): ?string
    {
        return $this->tableSearch ?? null;
    }

    
}

