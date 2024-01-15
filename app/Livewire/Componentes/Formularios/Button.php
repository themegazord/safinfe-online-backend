<?php

namespace App\Livewire\Componentes\Formularios;

use Livewire\Component;

class Button extends Component
{
    public $type;
    public $value;
    public $adicional;
    public $class;

    public function render()
    {
        return view('livewire.componentes.formularios.button', [
            'type' => $this->type,
            'value' => $this->value,
            'adicional' => $this->adicional,
            'class' => $this->class
        ]);
    }
}
