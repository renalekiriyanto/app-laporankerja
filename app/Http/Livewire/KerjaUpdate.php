<?php

namespace App\Http\Livewire;

use App\Models\Kerja;
use Carbon\Carbon;
use Livewire\Component;

class KerjaUpdate extends Component
{
    public $hari;
    public $detail;
    public $awal;
    public $akhir;
    public $kerjaId;

    protected $listeners = [
        'getContact' => 'handleGetContact'
    ];

    public function render()
    {
        return view('livewire.kerja-update',
        [
            'data'=>$this->hari
        ]);
    }
    
    public function handleGetContact($kerja)
    {
        // dd($kerja['hari']);
        // dd();
        $this->hari = Carbon::parse($kerja['hari'])->format('Y-m-d');
        $this->detail = $kerja['detail'];
        $this->awal = $kerja['awal'];
        $this->akhir = $kerja['akhir'];
        $this->kerjaId = $kerja['id'];
    }

    public function update()
    {
        $this->validate([
            'hari'=>'required',
            'detail'=>'required',
            'awal'=>'required'
        ]);
        if($this->kerjaId)
        {
            $kerja = Kerja::find($this->kerjaId);
            $kerja->update([
                'hari' => $this->hari,
                'detail'=>$this->detail,
                'awal'=>$this->awal,
                'akhir'=>$this->akhir
            ]);
            $this->resetInput();
            $this->emit('dataUpdated', $kerja);
        }
    }

    public function resetInput()
    {
        $this->hari = null;
        $this->detail = null;
        $this->awal = null;
        $this->akhir = null;
        $this->kerjaId = null;
    }
}
