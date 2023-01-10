<?php

namespace App\Http\Controllers;

use App\Models\Kerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\CarbonPeriod;

class PrintController extends Controller
{
    public function print(Request $request)
    {
        // dd($request->all());
        $now = Carbon::now()->translatedFormat('F Y');
        $date = Carbon::now();
        $startMonth = Carbon::now()->startOfMonth()->format('d-m-Y');
        $endMonth = Carbon::now()->endOfMonth()->format('d-m-Y');
        $range =  CarbonPeriod::create($startMonth, $endMonth);
        $days = [];
        foreach($range as $item)
        {
            $days[] = $item->format('d-m-Y');
        }
        $new = [];
        // dd(Kerja::whereDate('hari', '=', $date->format('Y-m-d') )->count());
        $dateNow = Carbon::parse($date)->translatedFormat('l, d/m/Y');
        $dateCetak = Carbon::parse($date)->translatedFormat('d F Y');
        $kerja = Kerja::whereYear('hari', Carbon::now()->year)
                        ->whereMonth('hari', Carbon::now()->month)
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
        ]);
        return $pdf->stream();
    }
}
