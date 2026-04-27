<?php

namespace App\Livewire\Admin;

use App\Models\SchoolSetting;
use Livewire\Component;
use Livewire\WithFileUploads;

class SchoolSettings extends Component
{
    use WithFileUploads;

    public string $school_name      = '';
    public string $school_tagline   = '';
    public string $school_address   = '';
    public string $school_phone     = '';
    public string $school_email     = '';
    public string $school_website   = '';
    public string $principal_name   = '';
    public string $accreditation    = '';
    public string $established_year = '';
    public string $facebook_url     = '';
    public string $instagram_url    = '';
    public string $youtube_url      = '';
    public string $about_text       = '';
    public string $principal_message= '';
    public        $principal_photo  = null;
    public ?string $existingPrincipalPhoto = null;
    public        $logo             = null;
    public ?string $existingLogo    = null;
    public        $hero_background  = null;
    public ?string $existingHeroBackground = null;

    protected array $rules = [
        'school_name'      => 'required|string|max:255',
        'school_tagline'   => 'nullable|string|max:255',
        'school_address'   => 'nullable|string',
        'school_phone'     => 'nullable|string|max:30',
        'school_email'     => 'nullable|email|max:255',
        'school_website'   => 'nullable|string|max:255',
        'principal_name'   => 'nullable|string|max:255',
        'accreditation'    => 'nullable|string|max:10',
        'established_year' => 'nullable|string|max:4',
        'facebook_url'     => 'nullable|url|max:255',
        'instagram_url'    => 'nullable|url|max:255',
        'youtube_url'      => 'nullable|url|max:255',
        'about_text'       => 'nullable|string',
        'principal_message'=> 'nullable|string',
        'logo'             => 'nullable|image|max:1024',
        'hero_background'  => 'nullable|image|max:2048',
        'principal_photo'  => 'nullable|image|max:1024',
    ];

    protected array $messages = [
        'school_name.required' => 'Nama sekolah wajib diisi.',
        'school_email.email'   => 'Format email tidak valid.',
        'logo.image'           => 'File logo harus berupa gambar.',
        'logo.max'             => 'Ukuran logo maksimal 1MB.',
        'hero_background.image'=> 'File background hero harus berupa gambar.',
        'hero_background.max'  => 'Ukuran background hero maksimal 2MB.',
        'principal_photo.image'=> 'File foto kepala sekolah harus berupa gambar.',
        'principal_photo.max'  => 'Ukuran foto maksimal 1MB.',
    ];

    public function mount(): void
    {
        $settings = SchoolSetting::getAllSettings();

        foreach (array_keys($this->rules) as $key) {
            if (!in_array($key, ['logo', 'hero_background', 'principal_photo']) && isset($settings[$key])) {
                $this->$key = $settings[$key];
            }
        }

        $this->existingLogo = $settings['school_logo'] ?? null;
        $this->existingHeroBackground = $settings['hero_background'] ?? null;
        $this->existingPrincipalPhoto = $settings['principal_photo'] ?? null;
    }

    public function save(): void
    {
        $this->validate();

        $logoPath = $this->existingLogo;
        if ($this->logo) {
            if ($this->existingLogo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($this->existingLogo);
            }
            $logoPath = $this->logo->store('school', 'public');
            SchoolSetting::set('school_logo', $logoPath);
            $this->existingLogo = $logoPath;
            $this->logo = null;
        }

        $heroPath = $this->existingHeroBackground;
        if ($this->hero_background) {
            if ($this->existingHeroBackground) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($this->existingHeroBackground);
            }
            $heroPath = $this->hero_background->store('school', 'public');
            SchoolSetting::set('hero_background', $heroPath);
            $this->existingHeroBackground = $heroPath;
            $this->hero_background = null;
        }

        $principalPath = $this->existingPrincipalPhoto;
        if ($this->principal_photo) {
            if ($this->existingPrincipalPhoto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($this->existingPrincipalPhoto);
            }
            $principalPath = $this->principal_photo->store('school', 'public');
            SchoolSetting::set('principal_photo', $principalPath);
            $this->existingPrincipalPhoto = $principalPath;
            $this->principal_photo = null;
        }

        $fields = [
            'school_name', 'school_tagline', 'school_address', 'school_phone',
            'school_email', 'school_website', 'principal_name', 'principal_message', 'accreditation',
            'established_year', 'facebook_url', 'instagram_url', 'youtube_url', 'about_text',
        ];

        foreach ($fields as $field) {
            SchoolSetting::set($field, $this->$field);
        }

        session()->flash('success', 'Profil sekolah berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.school-settings')
            ->layout('layouts.admin')
            ->title('Profil Sekolah');
    }
}
