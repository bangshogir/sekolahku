<?php

namespace App\Livewire\Admin\Achievements;

use App\Models\Achievement;
use Livewire\Component;
use Livewire\WithFileUploads;

class AchievementForm extends Component
{
    use WithFileUploads;

    public ?Achievement $achievement = null;
    public bool $isEditing = false;

    public string  $name              = '';
    public string  $competition_type  = '';
    public string  $level             = 'kabupaten';
    public int     $year;
    public string  $description       = '';
    public         $certificate_photo = null;
    public ?string $existingPhoto     = null;

    public function mount(Achievement $achievement = null): void
    {
        $this->year = (int) date('Y');

        if ($achievement && $achievement->exists) {
            $this->achievement      = $achievement;
            $this->isEditing        = true;
            $this->name             = $achievement->name;
            $this->competition_type = $achievement->competition_type;
            $this->level            = $achievement->level;
            $this->year             = $achievement->year;
            $this->description      = $achievement->description ?? '';
            $this->existingPhoto    = $achievement->certificate_photo;
        }
    }

    protected function rules(): array
    {
        return [
            'name'             => 'required|string|max:255',
            'competition_type' => 'required|string|max:255',
            'level'            => 'required|in:sekolah,kecamatan,kabupaten,provinsi,nasional,internasional',
            'year'             => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'description'      => 'nullable|string',
            'certificate_photo'=> 'nullable|image|max:3072',
        ];
    }

    protected array $messages = [
        'name.required'             => 'Nama prestasi wajib diisi.',
        'competition_type.required' => 'Jenis lomba wajib diisi.',
        'level.required'            => 'Tingkat wajib dipilih.',
        'year.required'             => 'Tahun wajib diisi.',
        'certificate_photo.image'   => 'File harus berupa gambar.',
        'certificate_photo.max'     => 'Ukuran file maksimal 3MB.',
    ];

    public function save(): void
    {
        $this->validate();

        $photoPath = $this->existingPhoto;
        if ($this->certificate_photo) {
            if ($this->existingPhoto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($this->existingPhoto);
            }
            $photoPath = $this->certificate_photo->store('achievements', 'public');
        }

        $data = [
            'name'              => $this->name,
            'competition_type'  => $this->competition_type,
            'level'             => $this->level,
            'year'              => $this->year,
            'description'       => $this->description ?: null,
            'certificate_photo' => $photoPath,
        ];

        if ($this->isEditing) {
            $this->achievement->update($data);
            session()->flash('success', 'Data prestasi berhasil diperbarui.');
        } else {
            Achievement::create($data);
            session()->flash('success', 'Data prestasi berhasil ditambahkan.');
        }

        $this->redirect(route('admin.achievements.index'), navigate: true);
    }

    public function render()
    {
        $levels = Achievement::LEVELS;

        return view('livewire.admin.achievements.achievement-form', compact('levels'))
            ->layout('layouts.admin')
            ->title($this->isEditing ? 'Edit Prestasi' : 'Tambah Prestasi');
    }
}
