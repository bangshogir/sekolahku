<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostForm extends Component
{
    use WithFileUploads;

    // Mode
    public ?Post $post = null;
    public bool $isEditing = false;

    // Fields
    public string $title          = '';
    public string $slug           = '';
    public string $excerpt        = '';
    public string $content        = '';
    public string $category       = 'Umum';
    public bool   $is_published   = false;
    public        $featured_image = null; // TemporaryUploadedFile | null
    public ?string $existingImage = null;

    public array $categories = ['Umum', 'Akademik', 'Kegiatan', 'Pengumuman', 'Prestasi', 'Humas'];

    protected function rules(): array
    {
        $slugRule = $this->isEditing
            ? 'required|string|max:255|unique:posts,slug,' . $this->post->id
            : 'required|string|max:255|unique:posts,slug';

        return [
            'title'          => 'required|string|max:255',
            'slug'           => $slugRule,
            'excerpt'        => 'nullable|string|max:500',
            'content'        => 'required|string|min:10',
            'category'       => 'required|string',
            'is_published'   => 'boolean',
            'featured_image' => $this->isEditing ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
        ];
    }

    protected array $messages = [
        'title.required'   => 'Judul berita wajib diisi.',
        'slug.unique'      => 'Slug sudah digunakan, silakan ubah.',
        'content.required' => 'Konten berita wajib diisi.',
        'content.min'      => 'Konten minimal 10 karakter.',
        'featured_image.image' => 'File harus berupa gambar.',
        'featured_image.max'   => 'Ukuran gambar maksimal 2MB.',
    ];

    public function mount(Post $post = null): void
    {
        if ($post && $post->exists) {
            $this->post          = $post;
            $this->isEditing     = true;
            $this->title         = $post->title;
            $this->slug          = $post->slug;
            $this->excerpt       = $post->excerpt ?? '';
            $this->content       = $post->content;
            $this->category      = $post->category;
            $this->is_published  = $post->is_published;
            $this->existingImage = $post->featured_image;
        }
    }

    // Auto-generate slug dari title
    public function updatedTitle(string $value): void
    {
        if (! $this->isEditing) {
            $this->slug = Str::slug($value);
        }
    }

    // Listener untuk konten Quill.js
    public function updateContent(string $content): void
    {
        $this->content = $content;
    }

    public function save(): void
    {
        $validated = $this->validate();

        // Handle file upload
        $imagePath = $this->existingImage;
        if ($this->featured_image) {
            // Hapus gambar lama jika ada
            if ($this->existingImage) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($this->existingImage);
            }
            $imagePath = $this->featured_image->store('posts', 'public');
        }

        $data = [
            'title'          => $this->title,
            'slug'           => $this->slug,
            'excerpt'        => $this->excerpt,
            'content'        => $this->content,
            'category'       => $this->category,
            'is_published'   => $this->is_published,
            'featured_image' => $imagePath,
            'published_at'   => $this->is_published ? now() : null,
        ];

        if ($this->isEditing) {
            $this->post->update($data);
            session()->flash('success', 'Berita berhasil diperbarui.');
        } else {
            Post::create(array_merge($data, ['user_id' => auth()->id()]));
            session()->flash('success', 'Berita berhasil ditambahkan.');
        }

        $this->redirect(route('admin.posts.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.posts.post-form')
            ->layout('layouts.admin')
            ->title($this->isEditing ? 'Edit Berita' : 'Tambah Berita');
    }
}
