<?php

namespace App\Http\Livewire;

use App\Models\Kerja;
use Carbon\Carbon;
use Livewire\Component;

class KerjaCreate extends Component
{
    public $hari;
    public $detail;
    public $awal;
    public $akhir;
    public $cuti=false;

    public function mount(){
        $this->hari = Carbon::now()->format('Y-m-d');
    }
    public function render()
    {
        return view('livewire.kerja-create');
    }

    public function store()
    {
        $this->validate([
            'hari'=>'required',
            'detail'=>'required',
            'awal'=>'required'
        ]);

        $kerja = Kerja::create([
            'hari'=>$this->hari,
            'detail'=>$this->detail,
            'awal'=>$this->awal,
            'akhir'=>$this->akhir,
            'cuti'=>$this->cuti
        ]);
        $this->resetInput();
        $this->emit('dataStored');
    }

    public function resetInput()
    {
        $this->hari = null;
        $this->detail = null;
        $this->awal = null;
        $this->akhir = null;
    }
}
