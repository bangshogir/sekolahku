<?php

namespace App\Livewire\Admin\Pages;

use App\Models\SchoolSetting;
use Livewire\Component;

class VisionMissionPage extends Component
{
    public $visionMissionContent;

    public function mount()
    {
        $this->visionMissionContent = SchoolSetting::get('vision_mission_content', '');
    }

    public function save()
    {
        SchoolSetting::set('vision_mission_content', $this->visionMissionContent);
        session()->flash('success', 'Halaman Visi & Misi berhasil diperbarui!');
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.admin.pages.vision-mission-page')
            ->layout('layouts.admin');
    }
}
