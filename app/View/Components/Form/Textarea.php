<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;

    public $rows;

    public $label;

    public $value;

    public $placeholder;

    public $isRequired;

    public function __construct($name, $rows = 4, $label = null, $value = null, $placeholder = null, $isRequired = true)
    {
        $this->name = $name;
        $this->rows = $rows;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->isRequired = $isRequired;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.textarea');
    }
}
