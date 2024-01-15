<?php

namespace App\Livewire\Componentes\Formularios;

use Livewire\Component;

class Input extends Component
{
    public $type;
    public $label;
    public $for;
    public $classGrupoInput;
    public $classLabel;
    public $classInput;

    public function render()
    {
        return view('livewire.componentes.formularios.input', [
            'type' => $this->type,
            'label' => $this->label,
            'for' => $this->for,
            'classGrupoInput' => $this->classGrupoInput,
            'classLabel' => $this->classLabel,
            'classInput' => $this->classInput,
        ]);
    }
}
