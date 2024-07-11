<?php

namespace App\Livewire\Dashboard;

use App\Models\Permission;
use Livewire\Component;

class SearchPermissions extends Component
{
    public $title;
    public $permissions;

    public function search(){
        $query = Permission::orderBy('title', 'asc');

        if(!empty($this->title)){
            $query->where('title', 'like', '%'.$this->title.'%');  
        }

        $this->permissions = $query->get();
    }

    public function mount()
    {
        $this->search();
    }

    public function render()
    {
        return view('livewire.'.config('panel.template').'.search-permissions');
    }
}
