<?php

namespace App\Livewire\Admin\Teachers;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;

class TeacherForm extends Component
{
    use WithFileUploads;

    public ?Teacher $teacher = null;
    public bool $isEditing   = false;

    public string  $nip       = '';
    public string  $name      = '';
    public string  $position  = '';
    public string  $subject   = '';
    public string  $bio       = '';
    public bool    $is_active = true;
    public int     $sort_order = 0;
    public         $photo     = null;
    public ?string $existingPhoto = null;

    public array $positions = [
        // Pimpinan
        'Kepala Madrasah',
        'Wakil Kepala Bidang Kurikulum',
        'Wakil Kepala Bidang Kesiswaan',
        'Wakil Kepala Bidang Humas',
        'Wakil Kepala Bidang Sarana & Prasarana',
        // Guru
        'Guru Mata Pelajaran',
        'Guru Kelas',
        'Guru BK / Konselor',
        'Guru Tahfidz',
        'Guru Pendamping Khusus',
        // Wali Kelas
        'Wali Kelas VII',
        'Wali Kelas VIII',
        'Wali Kelas IX',
        // Koordinator / Kepala Urusan
        'Kepala Tata Usaha',
        'Koordinator Ekstrakurikuler',
        'Koordinator Perpustakaan',
        'Koordinator Laboratorium',
        'Koordinator UKS',
        'Koordinator Tahfidz',
        // Staf
        'Staf Tata Usaha',
        'Staf Keuangan',
        'Staf Perpustakaan',
        'Operator Sekolah',
        'Pustakawan',
        'Laboran',
        // Lainnya
        'Tenaga Kebersihan',
        'Satpam / Penjaga Sekolah',
    ];

    protected function rules(): array
    {
        return [
            'nip'        => 'nullable|string|max:30|unique:teachers,nip,' . ($this->teacher?->id ?? 'NULL'),
            'name'       => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'subject'    => 'nullable|string|max:255',
            'bio'        => 'nullable|string',
            'is_active'  => 'boolean',
            'sort_order' => 'integer|min:0',
            'photo'      => 'nullable|image|max:2048',
        ];
    }

    protected array $messages = [
        'name.required'     => 'Nama guru wajib diisi.',
        'position.required' => 'Jabatan wajib diisi.',
        'nip.unique'        => 'NIP sudah digunakan.',
        'photo.image'       => 'File harus berupa gambar.',
        'photo.max'         => 'Ukuran gambar maksimal 2MB.',
    ];

    public function mount(Teacher $teacher = null): void
    {
        if ($teacher && $teacher->exists) {
            $this->teacher       = $teacher;
            $this->isEditing     = true;
            $this->nip           = $teacher->nip ?? '';
            $this->name          = $teacher->name;
            $this->position      = $teacher->position;
            $this->subject       = $teacher->subject ?? '';
            $this->bio           = $teacher->bio ?? '';
            $this->is_active     = $teacher->is_active;
            $this->sort_order    = $teacher->sort_order;
            $this->existingPhoto = $teacher->photo;
        }
    }

    public function save(): void
    {
        $this->validate();

        $photoPath = $this->existingPhoto;
        if ($this->photo) {
            if ($this->existingPhoto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($this->existingPhoto);
            }
            $photoPath = $this->photo->store('teachers', 'public');
        }

        $data = [
            'nip'        => $this->nip ?: null,
            'name'       => $this->name,
            'position'   => $this->position,
            'subject'    => $this->subject ?: null,
            'bio'        => $this->bio ?: null,
            'is_active'  => $this->is_active,
            'sort_order' => $this->sort_order,
            'photo'      => $photoPath,
        ];

        if ($this->isEditing) {
            $this->teacher->update($data);
            session()->flash('success', 'Data guru berhasil diperbarui.');
        } else {
            Teacher::create($data);
            session()->flash('success', 'Data guru berhasil ditambahkan.');
        }

        $this->redirect(route('admin.teachers.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.teachers.teacher-form')
            ->layout('layouts.admin')
            ->title($this->isEditing ? 'Edit Guru' : 'Tambah Guru');
    }
}
