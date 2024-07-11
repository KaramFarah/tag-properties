<?php

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Text extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $inputName,
        public string $inputId,
        public string $inputValue,
        public string $inputLabel = '',
        public string $inputPlaceholder = '',
        public string $inputHint = '',
        public string $inputRequired = '',
        public string $inputClass = '',
        public string $inputLabelClass = '',
        public string $inputAttributes = '',
        public string $wire = '',
        public string $type = 'text',
        public int $inputMaxLength = 255,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputs.text');
    }
}
