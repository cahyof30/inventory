<?php

namespace App\Filament\Pages;

use App\Models\Item;
use Filament\Pages\Page;

class PeminjamanPage extends Page
{
    protected string $view = 'filament.pages.peminjaman';

    protected static ?string $slug           = 'peminjaman';   // → /admin/peminjaman
    protected static string|\BackedEnum|null $navigationIcon  = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Peminjaman';
    protected static string|\UnitEnum|null $navigationGroup = 'Peminjaman';
    protected static ?string $title           = 'Daftar Barang Dipinjam';
   protected static ?int    $navigationSort  = 10;
 
    public string $search  = '';
    public string $sortBy  = 'name';
    public int    $perPage = 15;
    public int    $currentPage = 1;
 
    protected $queryString = [
        'search'      => ['except' => ''],
        'sortBy'      => ['except' => 'name'],
        'currentPage' => ['as' => 'page', 'except' => 1],
    ];
 
    public function updatedSearch(): void
    {
        $this->currentPage = 1;
    }
 
    public function updatedSortBy(): void
    {
        $this->currentPage = 1;
    }
 
    public function goToPage(int $page): void
    {
        $this->currentPage = $page;
    }
 
    public function getItems(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Item::query()
            ->with(['pic', 'location'])
            ->whereNotNull('pic_id')
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('name', 'like', "%{$this->search}%")
                        ->orWhere('brand', 'like', "%{$this->search}%")
                        ->orWhere('code', 'like', "%{$this->search}%")
                        ->orWhereHas('pic', fn ($u) =>
                            $u->where('name', 'like', "%{$this->search}%")
                        );
                });
            })
            ->orderBy($this->sortBy === 'location' ? 'location_id' : $this->sortBy)
            ->paginate($this->perPage, ['*'], 'page', $this->currentPage);
    }
}