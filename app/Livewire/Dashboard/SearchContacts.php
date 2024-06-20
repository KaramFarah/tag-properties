<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class SearchContacts extends Component
{
    public function render()
    {
        return view('livewire.'.config('panel.template').'.search-contacts');
    }
}
