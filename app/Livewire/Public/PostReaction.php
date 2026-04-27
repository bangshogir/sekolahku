<?php

namespace App\Livewire\Public;

use App\Models\Post;
use Livewire\Component;

class PostReaction extends Component
{
    public Post $post;
    public array $reactions = [];
    public ?string $userReaction = null;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadReactions();
    }

    public function loadReactions()
    {
        // Load count of reactions
        $reactionCounts = $this->post->reactions()
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        $this->reactions = [
            'like' => $reactionCounts['like'] ?? 0,
            'love' => $reactionCounts['love'] ?? 0,
            'wow'  => $reactionCounts['wow'] ?? 0,
            'sad'  => $reactionCounts['sad'] ?? 0,
        ];

        // Check if current session has reacted
        $sessionId = session()->getId();
        $this->userReaction = $this->post->reactions()
            ->where('session_id', $sessionId)
            ->value('type');
    }

    public function toggleReaction($type)
    {
        if (!in_array($type, ['like', 'love', 'wow', 'sad'])) {
            return;
        }

        $sessionId = session()->getId();
        
        $existing = $this->post->reactions()->where('session_id', $sessionId)->first();

        if ($existing) {
            if ($existing->type === $type) {
                // If clicking the same reaction, remove it (toggle off)
                $existing->delete();
                $this->userReaction = null;
            } else {
                // Change reaction
                $existing->update(['type' => $type]);
                $this->userReaction = $type;
            }
        } else {
            // New reaction
            $this->post->reactions()->create([
                'type' => $type,
                'session_id' => $sessionId,
            ]);
            $this->userReaction = $type;
        }

        $this->loadReactions();
    }

    public function render()
    {
        return view('livewire.public.post-reaction');
    }
}
