<?php

namespace App\Livewire\Admin\Extracurriculars;

use App\Models\Extracurricular;
use Livewire\Component;
use Livewire\WithPagination;

class ExtracurricularList extends Component
{
    use WithPagination;

    public function paginationView(): string { return 'components.admin-pagination'; }

    public string $search = '';

    public function updatingSearch(): void { $this->resetPage(); }

    public function delete(int $id): void
    {
        $item = Extracurricular::findOrFail($id);
        if ($item->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($item->photo);
        }
        $name = $item->name;
        $item->delete();
        $this->dispatch('notify', ['type' => 'success', 'message' => "Ekskul \"{$name}\" berhasil dihapus."]);
    }

    public function render()
    {
        $extracurriculars = Extracurricular::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('supervisor', 'like', "%{$this->search}%"))
            ->latest()->paginate(10);

        return view('livewire.admin.extracurriculars.extracurricular-list', compact('extracurriculars'))
            ->layout('layouts.admin')->title('Ekstrakurikuler');
    }
}
