<?php

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $inputName,
        public string $inputId,
        public Collection|array $inputData,
        public $inputValue = '',
        public $inputAttributes = '',
        public string $inputLabel = '',
        public string $placeholder = '',
        public string $inputHint = '',
        public string $inputRequired = '',
        public string $inputClass = '',
        public string $inputType = '',
        public $showButtons = 'true'
    )
    {
        //
    }

    public function isSelected($id, $data) : bool{
        
        if ($this->inputType == 'multiple')
            return (in_array($id, old($this->inputId, [])) || is_array($data) ? false : $data->contains($id));
        else
            return $id == $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputs.select');
    }
}
