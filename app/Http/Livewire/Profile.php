<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Exception;
use Goutte;

class Profile extends Component
{
    public $countries = [];
    public $states = [];
    public $genders = ['Male', 'Female'];
    public $divisions = [];
    public $rounds = ['4', '6', '8', '10'];
    public $languages = ['English', 'Spanish', 'Portuguese'];

    public $user;
    public $WLD = ['win' => 0, 'loos' => 0, 'draw' => 0, 'win_ko' => 0, 'loos_ko' => 0];

    public $name = '';
    public $gender = 'Male';
    public $email = '';
    public $country = '';
    public $state = '';
    public $division = '';
    public $company = '';
    public $round = '4';
    public $phone = '';
    public $passport = false;
    public $visa = false;
    public $language = 'English';
    public $boxrec_id = '';
    public $home_town = '';

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'country' => ['required'],
            'state' => ['required']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedCountry($countryId)
    {
        if ($countryId) {
            $this->states = \App\Models\State::where('country_id', $countryId)->orderBy('name')->get()->toArray();
        } else {
            $this->states = [];
        }
    }

    public function mount($id = null)
    {
        if (!empty($id)) {
            $this->user = User::find($id);
        }

        if (empty($this->user)) {
            $this->user = auth()->user();
        }

        if ($this->user->hasRole('Boxer')) {
            $this->getWLD();
        }

        $this->countries = \App\Models\Country::orderBy('name')->get()->toArray();
        $this->states = \App\Models\State::where('country_id', $this->user->country)->orderBy('name')->get()->toArray();
        $this->divisions = \App\Models\Division::get()->toArray();

        $this->name = $this->user->name;
        $this->gender = $this->user->gender;
        $this->email = $this->user->email;
        $this->country = $this->user->country;
        $this->state = $this->user->state;
        $this->division = $this->user->division;
        $this->company = $this->user->company;
        $this->round = $this->user->round;
        $this->phone = $this->user->phone;
        $this->passport = $this->user->passport;
        $this->visa = $this->user->visa;
        $this->language = $this->user->language;
        $this->boxrec_id = $this->user->boxrec_id;
        $this->home_town = $this->user->home_town;
    }

    private function getWLD()
    {
        if (empty($this->user) || empty($this->user->boxrec_id)) {
            return;
        }
        try {
            // Go to the Boxrec Profile page
            $url = 'https://boxrec.com/en/box-pro/' . $this->user->boxrec_id;
            $crawler = Goutte::request('GET', $url);

            $crawler->filter('table.profileWLD tbody tr td')->each(function ($node, $index) {
                if ($index == 0) {
                    $this->WLD['win'] = $node[0]->text();
                }
                if ($index == 1) {
                    $this->WLD['loos'] = $node[1]->text();
                }
                if ($index == 2) {
                    $this->WLD['draw'] = $node[2]->text();
                }
            });

            $crawler->filter('table.profileWLD tbody tr th')->each(function ($node, $index) {
                if ($index == 0) {
                    $this->WLD['win_ko'] = explode(" ", $node[0]->text())[0];
                }
                if ($index == 1) {
                    $this->WLD['loos_ko'] = explode(" ", $node[0]->text())[1];
                }
            });
        } catch (Exception $e) {
            var_dump($e);
        }
    }

    public function updateProfile()
    {
        $this->validate();
        $this->user->update([
            'name' => $this->name,
            'gender' => $this->gender,
            'email' => $this->email,
            'country' => $this->country,
            'state' => $this->state,
            'division' => $this->division,
            'company' => $this->company,
            'round' => $this->round,
            'phone' => $this->phone,
            'passport' => $this->passport,
            'visa' => $this->visa,
            'language' => $this->language,
            'boxrec_id' => $this->boxrec_id,
            'home_town' => $this->home_town
        ]);

        // show alert
        $this->notify('Your profile was updated.', 'success');
    }

    public function render()
    {
        if ($this->user->id == auth()->user()->id) {
            return view('livewire.edit-profile');
        }

        return view('livewire.profile');
    }
}
