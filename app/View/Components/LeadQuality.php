<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use App\Models\Dashboard\Contact;
use Illuminate\Contracts\View\View;

class LeadQuality extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Contact $variable ,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.lead-quality');
    }
}
