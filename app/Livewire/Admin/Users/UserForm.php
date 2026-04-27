<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserForm extends Component
{
    public ?User $user = null;
    public bool $isEditing = false;

    public string $name     = '';
    public string $email    = '';
    public string $password = '';
    public string $role     = 'admin';

    protected function rules(): array
    {
        $emailRule = $this->isEditing
            ? 'required|email|unique:users,email,' . $this->user->id
            : 'required|email|unique:users,email';

        return [
            'name'     => 'required|string|max:255',
            'email'    => $emailRule,
            'password' => $this->isEditing ? 'nullable|min:8' : 'required|min:8',
            'role'     => 'required|in:admin,user',
        ];
    }

    protected array $messages = [
        'name.required'     => 'Nama wajib diisi.',
        'email.required'    => 'Email wajib diisi.',
        'email.unique'      => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi.',
        'password.min'      => 'Password minimal 8 karakter.',
    ];

    public function mount(User $user = null): void
    {
        if ($user && $user->exists) {
            $this->user      = $user;
            $this->isEditing = true;
            $this->name      = $user->name;
            $this->email     = $user->email;
            $this->role      = $user->role;
        }
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->isEditing) {
            $this->user->update($data);
            session()->flash('success', 'Data user berhasil diperbarui.');
        } else {
            User::create($data);
            session()->flash('success', 'User baru berhasil ditambahkan.');
        }

        $this->redirect(route('admin.users.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.users.user-form')
            ->layout('layouts.admin')
            ->title($this->isEditing ? 'Edit User' : 'Tambah User');
    }
}
