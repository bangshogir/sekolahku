<?php

namespace App\Livewire\Admin\Infrastructures;

use App\Models\Infrastructure;
use Livewire\Component;
use Livewire\WithFileUploads;

class InfrastructureForm extends Component
{
    use WithFileUploads;

    public ?Infrastructure $infrastructure = null;
    public bool $isEditing = false;

    public string  $name          = '';
    public string  $condition     = 'baik';
    public string  $description   = '';
    public int     $quantity      = 1;
    public         $photo         = null;
    public ?string $existingPhoto = null;

    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'condition'   => 'required|in:baik,rusak_ringan,rusak_berat',
            'description' => 'nullable|string',
            'quantity'    => 'required|integer|min:1',
            'photo'       => 'nullable|image|max:2048',
        ];
    }

    protected array $messages = [
        'name.required'     => 'Nama fasilitas wajib diisi.',
        'condition.required'=> 'Kondisi wajib dipilih.',
        'quantity.min'      => 'Jumlah minimal 1.',
        'photo.image'       => 'File harus berupa gambar.',
        'photo.max'         => 'Ukuran gambar maksimal 2MB.',
    ];

    public function mount(Infrastructure $infrastructure = null): void
    {
        if ($infrastructure && $infrastructure->exists) {
            $this->infrastructure  = $infrastructure;
            $this->isEditing       = true;
            $this->name            = $infrastructure->name;
            $this->condition       = $infrastructure->condition;
            $this->description     = $infrastructure->description ?? '';
            $this->quantity        = $infrastructure->quantity;
            $this->existingPhoto   = $infrastructure->photo;
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
            $photoPath = $this->photo->store('infrastructures', 'public');
        }

        $data = [
            'name'        => $this->name,
            'condition'   => $this->condition,
            'description' => $this->description ?: null,
            'quantity'    => $this->quantity,
            'photo'       => $photoPath,
        ];

        if ($this->isEditing) {
            $this->infrastructure->update($data);
            session()->flash('success', 'Data infrastruktur berhasil diperbarui.');
        } else {
            Infrastructure::create($data);
            session()->flash('success', 'Data infrastruktur berhasil ditambahkan.');
        }

        $this->redirect(route('admin.infrastructures.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.infrastructures.infrastructure-form')
            ->layout('layouts.admin')
            ->title($this->isEditing ? 'Edit Infrastruktur' : 'Tambah Infrastruktur');
    }
}
