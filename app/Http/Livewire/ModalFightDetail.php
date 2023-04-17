<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Fight;

class ModalFightDetail extends Component
{
    public $fight;
    public $showModal = false;
    protected $listeners = ['modal:fight-detail' => 'showModal'];

    public function showModal($id)
    {
        $this->fight = Fight::find($id);
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.modal-fight-detail');
    }
}
