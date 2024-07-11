<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class SearchUsers extends Component
{
    public $name = '';
    public $email = '';
    public $id = '';
    public $users = [];

    public function search(){
        $query = User::with('roles');

        if(!empty($this->id)){
            $query->where('id', $this->id);
        }

        if(!empty($this->name)){
            $query->where('name', 'like', '%'.$this->name.'%');
        }
        if(!empty($this->email)){
            $query->where('email', 'like', '%'.$this->email.'%');
        }

        $this->users = $query->latest()->get();  
    }

    public function mount()
    {   
        $this->search();
    }
    public function render()
    {
        return view('livewire.'.config('panel.template').'.search-users');
    }
}
