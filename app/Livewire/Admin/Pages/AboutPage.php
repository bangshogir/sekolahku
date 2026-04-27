<?php

namespace App\Livewire\Admin\Pages;

use App\Models\SchoolSetting;
use Livewire\Component;

class AboutPage extends Component
{
    public $aboutContent;

    public function mount()
    {
        $this->aboutContent = SchoolSetting::get('about_content', '');
    }

    public function save()
    {
        SchoolSetting::set('about_content', $this->aboutContent);
        session()->flash('success', 'Halaman Tentang Kami berhasil diperbarui!');
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.admin.pages.about-page')
            ->layout('layouts.admin');
    }
}
