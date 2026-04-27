<?php

namespace App\Livewire\Admin\Teachers;

use App\Imports\TeachersImport;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class TeacherList extends Component
{
    use WithPagination, WithFileUploads;

    public function paginationView(): string { return 'components.admin-pagination'; }

    public string $search = '';
    public string $status = '';

    // Import modal
    public bool $showImportModal = false;
    public $importFile = null;
    public array $importErrors = [];
    public ?int $importCount = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStatus(): void { $this->resetPage(); }

    public function openImportModal(): void
    {
        $this->reset(['importFile', 'importErrors', 'importCount']);
        $this->showImportModal = true;
    }

    public function closeImportModal(): void
    {
        $this->showImportModal = false;
        $this->reset(['importFile', 'importErrors', 'importCount']);
    }

    public function importCsv(): void
    {
        $this->validate([
            'importFile' => 'required|file|mimes:csv,xlsx,xls|max:5120',
        ], [
            'importFile.required' => 'Silakan pilih file terlebih dahulu.',
            'importFile.mimes'    => 'Format file harus CSV, XLSX, atau XLS.',
            'importFile.max'      => 'Ukuran file maksimal 5 MB.',
        ]);

        $this->importErrors = [];
        $this->importCount  = null;

        $import = new TeachersImport();
        Excel::import($import, $this->importFile->getRealPath());

        // Kumpulkan error validasi per baris
        foreach ($import->failures() as $failure) {
            $this->importErrors[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
        }

        $this->importCount = Teacher::count();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Import selesai! Silakan cek data guru yang baru ditambahkan.']);
        $this->showImportModal = false;
    }

    public function delete(int $id): void
    {
        $teacher = Teacher::findOrFail($id);
        if ($teacher->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($teacher->photo);
        }
        $name = $teacher->name;
        $teacher->delete();
        $this->dispatch('notify', ['type' => 'success', 'message' => "Data guru \"{$name}\" berhasil dihapus."]);
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
