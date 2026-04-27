<?php

namespace App\Livewire\Admin\Extracurriculars;

use App\Models\Extracurricular;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExtracurricularForm extends Component
{
    use WithFileUploads;

    public ?Extracurricular $extracurricular = null;
    public bool $isEditing = false;

    public string  $name        = '';
    public string  $supervisor  = '';
    public string  $schedule    = '';
    public string  $description = '';
    public bool    $is_active   = true;
    public         $photo       = null;
    public ?string $existingPhoto = null;

    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'supervisor'  => 'required|string|max:255',
            'schedule'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
            'photo'       => 'nullable|image|max:2048',
        ];
    }

    protected array $messages = [
        'name.required'       => 'Nama ekskul wajib diisi.',
        'supervisor.required' => 'Nama pembina wajib diisi.',
        'schedule.required'   => 'Jadwal wajib diisi.',
    ];

    public function mount(Extracurricular $extracurricular = null): void
    {
        if ($extracurricular && $extracurricular->exists) {
            $this->extracurricular = $extracurricular;
            $this->isEditing       = true;
            $this->name            = $extracurricular->name;
            $this->supervisor      = $extracurricular->supervisor;
            $this->schedule        = $extracurricular->schedule;
            $this->description     = $extracurricular->description ?? '';
            $this->is_active       = $extracurricular->is_active;
            $this->existingPhoto   = $extracurricular->photo;
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
            $photoPath = $this->photo->store('extracurriculars', 'public');
        }

        $data = [
            'name'        => $this->name,
            'supervisor'  => $this->supervisor,
            'schedule'    => $this->schedule,
            'description' => $this->description ?: null,
            'is_active'   => $this->is_active,
            'photo'       => $photoPath,
        ];

        if ($this->isEditing) {
            $this->extracurricular->update($data);
            session()->flash('success', 'Data ekskul berhasil diperbarui.');
        } else {
            Extracurricular::create($data);
            session()->flash('success', 'Data ekskul berhasil ditambahkan.');
        }

        $this->redirect(route('admin.extracurriculars.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.extracurriculars.extracurricular-form')
            ->layout('layouts.admin')
            ->title($this->isEditing ? 'Edit Ekskul' : 'Tambah Ekskul');
    }
}
