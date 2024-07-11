<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Tag extends Component
{
    public Tag $tag;
    
    public function render()
    {
        return view('livewire.dashboard.tag');
    }
}
