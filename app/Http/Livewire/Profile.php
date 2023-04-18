<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $user;

    public function mount($id = null)
    {
        if (!empty($id)) {
            $this->user = User::find($id);
        }

        if (empty($this->user)) {
            $this->user = auth()->user();
        }
    }

    public function saveAvatar()
    {
        $avatar = $this->user->store('images', 'public');
        $this->user->update(compact('avatar'));
    }

    public function render()
    {
        if ($this->user->id == auth()->user()->id) {
            return view('livewire.edit-profile');
        }

        return view('livewire.profile');
    }
}
