<?php

namespace App\Livewire\Admin\Achievements;

use App\Models\Achievement;
use Livewire\Component;
use Livewire\WithPagination;

class AchievementList extends Component
{
    use WithPagination;

    public function paginationView(): string { return 'components.admin-pagination'; }

    public string $search = '';
    public string $level  = '';

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingLevel(): void  { $this->resetPage(); }

    public function delete(int $id): void
    {
        $item = Achievement::findOrFail($id);
        if ($item->certificate_photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($item->certificate_photo);
        }
        $name = $item->name;
        $item->delete();
        $this->dispatch('notify', ['type' => 'success', 'message' => "Prestasi \"{$name}\" berhasil dihapus."]);
    }

    public function render()
    {
        $achievements = Achievement::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('competition_type', 'like', "%{$this->search}%"))
            ->when($this->level, fn($q) => $q->where('level', $this->level))
            ->orderByDesc('year')
            ->paginate(10);

        return view('livewire.admin.achievements.achievement-list', compact('achievements'))
            ->layout('layouts.admin')->title('Data Prestasi');
    }
}
