<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyApplication extends Component
{
    public $fights = [];

    public function mount()
    {
        $this->fights = \App\Models\Fight::orderBy('date')
            ->where('applied_by', auth()->user()->id)
            ->whereDate('date', '>=', now())
            ->with(['countryDetail', 'stateDetail', 'divisionDetail', 'createrDetail'])
            ->get()->toArray();
    }

    public function showModal($id)
    {
        $this->emit('modal:fight-detail', $id);
    }

    public function render()
    {
        return view('livewire.my-application');
    }
}
