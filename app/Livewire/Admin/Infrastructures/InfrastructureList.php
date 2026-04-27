<?php

namespace App\Livewire\Admin\Infrastructures;

use App\Models\Infrastructure;
use Livewire\Component;
use Livewire\WithPagination;

class InfrastructureList extends Component
{
    use WithPagination;

    public string $search    = '';
    public string $condition = '';

    public function updatingSearch(): void    { $this->resetPage(); }
    public function updatingCondition(): void { $this->resetPage(); }

    public function delete(int $id): void
    {
        $item = Infrastructure::findOrFail($id);
        if ($item->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($item->photo);
        }
        $name = $item->name;
        $item->delete();
        session()->flash('success', "Data infrastruktur \"{$name}\" berhasil dihapus.");
    }

    public function render()
    {
        $infrastructures = Infrastructure::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->condition, fn($q) => $q->where('condition', $this->condition))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.infrastructures.infrastructure-list', compact('infrastructures'))
            ->layout('layouts.admin')->title('Data Infrastruktur');
    }
}
