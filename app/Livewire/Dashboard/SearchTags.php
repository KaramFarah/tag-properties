<?php

namespace App\Livewire\Dashboard;

use App\Models\Dashboard\Tag;
use Livewire\Component;

class SearchTags extends Component
{
    public $id;
    public $name;
    public $type;
    public $tags;

    public function search(){
        $query = Tag::orderBy('type')->orderBy('name');

        if(!empty($this->name)){
            $query->where('name', 'like', '%'.$this->name.'%');  
        }

        if(!empty($this->type)){
            $query->where('type', 'like', '%'.$this->type.'%');  
        }
        
        $this->tags = $query->get();
    }

    public function mount()
    {
        $this->search();
    }
    
    public function render()
    {
        return view('livewire.'.config('panel.template').'.search-tags');
    }
}
