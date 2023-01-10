<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Kerja;
use Livewire\Component;
use Carbon\CarbonPeriod;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class KerjaIndex extends Component
{
    use WithPagination;
    public $statusUpdate = false;
    protected $listeners = [
        'dataStored'=>'handleStored',
        'dataUpdated'=>'handleUpdated'
    ];
    protected $paginationTheme = 'bootstrap';
    public $statusPrint=false;
    public $tglPrint;
    public $tglAwal;
    public $tglAkhir;

    public function render()
    {
        $kerja = Kerja::orderBy('hari','desc')->orderBy('awal', 'desc')->paginate(10);
        return view('livewire.kerja-index',['kerja'=>$kerja]);
        // session()->flash('message', 'Data kerja berhasil di tambahkan!');
    }
    public function handleStored()
    {
        session()->flash('message', 'Data berhasil ditambahkan!');
    }

    public function getContact($id)
    {
        $this->statusUpdate=true;
        $kerja = Kerja::find($id);
        $this->emit('getContact', $kerja);
    }

    public function  delete($id)
    {
        $kerja = Kerja::find($id);
        $kerja->delete();

        $this->handleDelete($kerja);
    }

    public function handleDelete($kerja)
    {
        session()->flash('message', 'Data '.$kerja['id'].' sudah  terhapus!');
    }

    public function handleUpdated($kerja)
    {
        $this->statusUpdate=false;
        session()->flash('message', 'Data '.$kerja['id'].' sudah  diupdate!');
    }

    public function changeStatusPrint()
    {
        $status = $this->statusPrint;
        return $this->statusPrint = !$status;
    }

    public function print()
    {
        $now = Carbon::parse($this->tglPrint)->translatedFormat('F Y');
        $date = Carbon::parse($this->tglPrint);
        $startMonth = Carbon::now()->startOfMonth()->format('d-m-Y');
        $endMonth = Carbon::now()->endOfMonth()->format('d-m-Y');
        $range =  CarbonPeriod::create($this->tglAwal, $this->tglAkhir);
        $days = [];
        foreach($range as $item)
        {
            $days[] = $item->format('d-m-Y');
        }
        $new = [];
        // dd(Kerja::whereDate('hari', '=', $date->format('Y-m-d') )->count());
        $dateNow = Carbon::parse($date)->translatedFormat('l, d/m/Y');
        $dateCetak = Carbon::parse($date)->translatedFormat('d F Y');
        $kerja = Kerja::whereYear('hari', Carbon::parse($this->tglAwal)->year)
                        ->whereMonth('hari', Carbon::parse($this->tglAwal)->month)
                        ->get();
        $data=[];
        foreach($kerja as $k){
            $data[]=$k;
        }
        $dayIn=[];
        foreach($data as $d)
        {
            foreach($days as $day)
            {
                if(Carbon::parse($d->hari)->format('d-m-Y') == $day){
                    if(!in_array($day, $dayIn, true)){
                        $dayIn[] = $day;
                    }
                }
            }
        }

        $pdf = Pdf::loadView('livewire.kerja-print',[
            'data'=>$data,
            'now'=>$now,
            'days'=>$days,
            'dateNow' => $dateNow,
            'dayIn'=> $dayIn,
            'dateCetak'=>$dateCetak
        ])->output();
        return response()->streamDownload(
            fn () => print($pdf),
            "Laporan Renal Eki Riyanto - ".$now.".pdf"
        );
        // return $pdf->stream();
    }

}
