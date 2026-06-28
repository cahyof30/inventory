<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class MobileCompanyCardList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatedSearch(): void
    {
        $this->resetPage('company_page');
    }

    public function deleteRecord(int $id): void
    {
        $company = Company::findOrFail($id);
        $company->delete();

        $this->dispatch('notify', [
            'type'    => 'success',
            'message' => 'Perusahaan berhasil dihapus.',
        ]);
    }

    public function render()
    {
        $records = Company::query()
            ->when($this->search, fn ($q) =>
                $q->where('company_name', 'like', "%{$this->search}%")
                  ->orWhere('slug', 'like', "%{$this->search}%")
            )
            ->latest()
            ->paginate(10, pageName: 'company_page');

        return view('livewire.companies.mobile-company-card-list', compact('records'));
    }
}