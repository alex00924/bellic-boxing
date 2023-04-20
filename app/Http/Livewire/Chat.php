<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Chat extends Component
{
    public $search;
    public $message;
    public $users;
    public $selectedUser;
    public $chatLists = [];

    public function mount()
    {
        $this->filterUsers();
    }

    private function filterUsers()
    {
        $myId = auth()->user()->id;
        if (empty($this->search)) {
            $this->users = User::where('id', "!=", $myId)->get();
        } else {
            $this->users = User::where('name', 'LIKE', "%" . $this->search . "%")
                ->where('id', '!=', $myId)->get();
        }
    }

    public function updatedSearch()
    {
        $this->filterUsers();
    }

    public function updatedSelectedUser()
    {
        $this->getChatLists();
    }

    private function getChatLists()
    {
        if (empty($this->selectedUser)) {
            $this->chatLists = [];
            return;
        }

        $myId = auth()->user()->id;
        $this->chatLists = \App\Models\Chat::with(['sender', 'receiver'])
            ->where(function ($query) use ($myId) {
                $query->where('sender_id', $this->selectedUser)
                    ->where('receiver_id', $myId);
            })
            ->orWhere(function ($query) use ($myId) {
                $query->where('sender_id', $myId)
                    ->where('receiver_id', $this->selectedUser);
            })
            ->orderBy('created_at')
            ->get();
    }

    public function sendMessage()
    {
        if (empty($this->selectedUser) || empty($this->message)) {
            return;
        }

        \App\Models\Chat::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->selectedUser,
            'message' => $this->message
        ]);
        $this->message = '';
        $this->getChatLists();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}