<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class MobileCardList extends Component
{
    use WithPagination;

    public string $activeTab = 'all';

    public string $search = '';

    protected $paginationTheme = 'simple-bootstrap';

    // Sinkronisasi tab dari ListItems (dikirim via event)
    protected $listeners = ['tabChanged' => 'onTabChanged'];

    public bool $showQrModal = false;

    public ?string $selectedQrCode = null;

    public ?string $selectedItemName = null;

    public function showQr(string $qrCode, string $name): void
    {
        $this->selectedQrCode = $qrCode;
        $this->selectedItemName = $name;
        $this->showQrModal = true;
    }

    public function closeQr(): void
    {
        $this->showQrModal = false;
    }

    public function onTabChanged(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function getRecords()
    {
        $query = Item::query()
            ->with(['category', 'vehicleDetail', 'location'])
            ->orderByDesc('created_at');

        // Filter tab
        if ($this->activeTab === 'kendaraan') {
            $query->whereHas('category', fn ($q) => $q->where('slug', 'kendaraan'));
        } elseif ($this->activeTab === 'peralatan') {
            $query->whereHas('category', fn ($q) => $q->where('slug', '!=', 'kendaraan'));
        }

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('code', 'like', "%{$this->search}%");
            });
        }

        return $query->paginate(12, pageName: 'card_page');
    }

    public function deleteRecord(int $id): void
    {
        $item = Item::findOrFail($id);
        $item->delete();
        session()->flash('message', "Barang '{$item->name}' berhasil dihapus.");
    }

    public function render()
    {
        return view('livewire.items.mobile-card-list', [
            'records' => $this->getRecords(),
        ]);
    }
}
