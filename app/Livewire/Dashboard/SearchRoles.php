<?php

namespace App\Livewire\Dashboard;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SearchRoles extends Component
{
    public $roles;
    public $title;
    public $permissions;
    public $permission;
    public $id;

    public function search(){
        $query = Role::with('permissions');

        if(!empty($this->id)){
            $query->where('id', $this->id);
        }

        if(!empty($this->title)){
            $query->where('title', 'like', '%'.$this->title.'%');
        }

        if(!empty($this->permission)){
            dd($this->permission);
            // $query->where('title', 'like', '%'.$this->title.'%');
            $query->whereHas('permissions', function (Builder $sQuery){
                $sQuery->where('id', $this->permission);
            });
        }

        // if(!empty($this->email)){
        //     $query->where('email', 'like', '%'.$this->email.'%');
        // }

        $this->roles = $query->latest()->get();
    }

    public function mount()
    {   
        $this->permissions = Permission::orderBy('title')->get()->pluck('title', 'id')->prepend(__('- Choose'), '');
        $this->search();
    }

    public function render()
    {
        return view('livewire.'.config('panel.template').'.search-roles');
    }
}
