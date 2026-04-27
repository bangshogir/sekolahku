<?php

namespace App\Livewire\Admin\Teachers;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStatus(): void { $this->resetPage(); }

    public function delete(int $id): void
    {
        $teacher = Teacher::findOrFail($id);
        if ($teacher->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($teacher->photo);
        }
        $name = $teacher->name;
        $teacher->delete();
        session()->flash('success', "Data guru \"{$name}\" berhasil dihapus.");
    }

    public function render()
    {
        $teachers = Teacher::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('nip', 'like', "%{$this->search}%")
                ->orWhere('subject', 'like', "%{$this->search}%"))
            ->when($this->status === 'active',   fn($q) => $q->where('is_active', true))
            ->when($this->status === 'inactive', fn($q) => $q->where('is_active', false))
            ->orderBy('sort_order')->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.teachers.teacher-list', compact('teachers'))
            ->layout('layouts.admin')->title('Data Guru');
    }
}
