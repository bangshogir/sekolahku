<?php

namespace App\Livewire\Admin\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePassword extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected function rules()
    {
        return [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected $messages = [
        'current_password.required' => 'Password lama wajib diisi.',
        'password.required' => 'Password baru wajib diisi.',
        'password.min' => 'Password baru minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
    ];

    public function updatePassword()
    {
        $this->validate();

        $user = Auth::user();

        // Validasi password lama
        if (!Hash::check($this->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Password lama yang Anda masukkan tidak sesuai.',
            ]);
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);

        session()->flash('success', 'Password berhasil diperbarui.');
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Password Anda telah berhasil diubah!']);
    }

    public function render()
    {
        return view('livewire.admin.profile.change-password')
            ->layout('layouts.admin')
            ->title('Ganti Password');
    }
}
