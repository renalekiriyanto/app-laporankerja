<?php

namespace App\Http\Livewire\Setup;

use Livewire\Component;

class Index extends Component
{
    public $stateShowForm = false;

    public function render()
    {
        return view('livewire.setup.index');
    }

    public function showForm()
    {
        $status = $this->stateShowForm;
        return $this->stateShowForm = !$status;
    }
}
