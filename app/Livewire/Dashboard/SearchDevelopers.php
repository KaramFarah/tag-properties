<?php

namespace App\Livewire\Dashboard;

use App\Models\Dashboard\Developer;
use App\Models\Dashboard\Tag;
use Livewire\Component;

class SearchDevelopers extends Component
{
    public $id;
    public $name;
    public $type;
    public $developers;

    public function search(){
        $query = Developer::orderBy('name');

        if(!empty($this->name)){
            $query->where('name', 'like', '%'.$this->name.'%');  
        }

        if(!empty($this->description)){
            $query->where('description', 'like', '%'.$this->description.'%');  
        }
        
        $this->developers = $query->get();
    }

    public function mount()
    {
        $this->search();
    }
    
    public function render()
    {
        return view('livewire.'.config('panel.template').'.search-developers');
    }
}
