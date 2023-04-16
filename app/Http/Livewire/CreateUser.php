<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

class CreateUser extends Component
{
    public $countries = [];
    public $states = [];
    public $account_types = ['Boxer', 'Promoter', 'Match Maker', 'Manager'];
    public $divisions = [];
    public $rounds = ['4', '6', '8', '10'];
    public $languages = ['English', 'Spanish', 'Portuguese'];

    public $account_type = 'Boxer';
    public $name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';
    public $country = '';
    public $state = '';
    public $division = '';
    public $round = '4';
    public $passport = false;
    public $visa = false;
    public $language = 'English';
    public $boxrec_id = '';
    public $home_town = '';

    protected function rules()
    {
        return [
            'account_type' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['required'],
            'state' => ['required'],
            'language' => ['required'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'country' => $this->country,
            'state' => $this->state,
            'division' => $this->division,
            'round' => $this->round,
            'passport' => $this->passport,
            'visa' => $this->visa,
            'language' => $this->language,
            'boxrec_id' => $this->boxrec_id,
            'home_town' => $this->home_town,
        ]);

        switch ($this->account_type) {
            case $this->account_types[0]:
                $user->assignRole('Boxer');
                break;
            case $this->account_types[1]:
                $user->assignRole('Promoter');
                break;
            case $this->account_types[2]:
                $user->assignRole('MatchMaker');
                break;
            case $this->account_types[3]:
                $user->assignRole('Manager');
                break;
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function mount()
    {
        $this->countries = \App\Models\Country::orderBy('name')->get()->toArray();
        // $this->country = $this->countries[0]['id'];

        $this->states = \App\Models\State::where('country_id', $this->country)->orderBy('name')->get()->toArray();
        // $this->state = $this->states[0]['id'];

        $this->divisions = \App\Models\Division::get()->toArray();
        // $this->division = $this->divisions[0]['id'];
    }

    public function updatedCountry($countryId)
    {
        if ($countryId) {
            $this->states = \App\Models\State::where('country_id', $countryId)->orderBy('name')->get()->toArray();
        } else {
            $this->states = [];
        }
        // $this->state = null;
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}