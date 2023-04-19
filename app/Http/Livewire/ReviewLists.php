<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReviewLists extends Component
{
    public $reviews = [];
    public $rating = 0;
    public function mount($id = null)
    {
        $user = null;
        if (!empty($id)) {
            $user = User::find($id);
        }

        if (empty($this->user)) {
            $user = auth()->user();
        }
        $this->reviews = $user->myReviews()->get()->toArray();
        if (count($this->reviews) > 0) {
            foreach ($this->reviews as $review) {
                $this->rating += $review['mark'];
            }

            $this->rating = $this->rating / count($this->reviews);
        }
    }
    public function render()
    {
        return view('livewire.review-lists');
    }
}
