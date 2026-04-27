<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    public string $search   = '';
    public string $category = '';
    public string $status   = '';

    // Reset pagination saat filter berubah
    public function updatingSearch(): void    { $this->resetPage(); }
    public function updatingCategory(): void  { $this->resetPage(); }
    public function updatingStatus(): void    { $this->resetPage(); }

    // Konfirmasi hapus
    public function delete(int $id): void
    {
        $post = Post::findOrFail($id);

        // Hapus gambar jika ada
        if ($post->featured_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($post->featured_image);
        }

        $title = $post->title;
        $post->delete();
        $this->dispatch('notify', ['type' => 'success', 'message' => "Berita \"{$title}\" berhasil dihapus."]);
    }

    public function render()
    {
        $posts = Post::with('user')
            ->when($this->search,   fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->category, fn($q) => $q->where('category', $this->category))
            ->when($this->status === 'published', fn($q) => $q->where('is_published', true))
            ->when($this->status === 'draft',     fn($q) => $q->where('is_published', false))
            ->latest()
            ->paginate(10);

        $categories = Post::select('category')->distinct()->pluck('category');

        return view('livewire.admin.posts.post-list', compact('posts', 'categories'))
            ->layout('layouts.admin')
            ->title('Kelola Berita');
    }
}
