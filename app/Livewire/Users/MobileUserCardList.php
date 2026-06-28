<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MobileUserCardList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatedSearch(): void
    {
        $this->resetPage('user_page');
    }

    public function deleteRecord(int $id): void
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->dispatch('notify', [
            'type'    => 'success',
            'message' => 'Pengguna berhasil dihapus.',
        ]);
    }

    public function render()
    {
        $records = User::query()
            ->when($this->search, fn ($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
            )
            ->latest()
            ->orderBy('name', 'asc')
            ->paginate(10, pageName: 'user_page');

        return view('livewire.users.mobile-user-card-list', compact('records'));
    }
}