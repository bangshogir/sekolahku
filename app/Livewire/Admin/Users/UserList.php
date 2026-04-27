<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void { $this->resetPage(); }

    public function delete(int $id): void
    {
        if ($id === auth()->id()) {
            $this->dispatch('notify', ['type' => 'error', 'message' => 'Anda tidak dapat menghapus akun Anda sendiri.']);
            return;
        }

        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();
        $this->dispatch('notify', ['type' => 'success', 'message' => "User \"{$name}\" berhasil dihapus."]);
    }

    public function render()
    {
        $users = User::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->latest()->paginate(10);

        return view('livewire.admin.users.user-list', compact('users'))
            ->layout('layouts.admin')->title('Manajemen User');
    }
}
