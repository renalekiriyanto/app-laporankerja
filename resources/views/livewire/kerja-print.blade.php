<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Print</title>
    <style>
    </style>
</head>

<body>
    <div>
        <div>
            <table>
                <tr>
                    <td>

                    </td>
                    <td>
                        <img src="{{ public_path('img/bukittinggi-logo-fit.jpg') }}" width="100" height="100">
                    </td>
                    <td style="text-align: center">
                        <span style="font-weight: bold">PEMERINTAH KOTA BUKITTINGGI</span>
                        <br>
                        <span style="font-weight: bold">BADAN KEUANGAN</span>
                        <br>
                        <span>Jl. Jend. Sudirman No.27-29 Sapiran Bukittingi - Sumatera Barat - Indonesia</span>
                        <br>
                        <span>Telepon : (0752) 32485 Kode Pos : 26181</span>
                    </td>
                </tr>
            </table>
            <h4 style="text-align: center">LAPORAN KERJA HARIAN</h4>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>Renal Eki Riyanto</td>
                </tr>
                <tr>
                    <td>Bulan</td>
                    <td>:</td>
                    <td>{{ $now }}</td>
                </tr>
            </table>
            <br>
            <br>
            <table style="border: 1px solid black; border-collapse:collapse; width: 100%;">
                <thead style="border: 1px solid black; border-collapse:collapse">
                    <tr style="border: 1px solid black; border-collapse:collapse; rowspan:2;">
                        <th style="border: 1px solid black; border-collapse:collapse;" rowspan="2">No.</th>
                        <th style="border: 1px solid black; border-collapse:collapse;" rowspan="2">Kegiatan</th>
                        <th style="border: 1px solid black; border-collapse:collapse;" colspan="2">Jam</th>
                    </tr>
                    <tr style="border: 1px solid black; border-collapse:collapse;">
                        <th style="border: 1px solid black; border-collapse:collapse; text-align:center;">Awal</th>
                        <th style="border: 1px solid black; border-collapse:collapse; text-align:center;">Akhir</th>
                    </tr>
                    {{-- mulai --}}
                    @foreach ($dayIn as $day)
                        <tr style="border: 1px solid black; border-collapse:collapse;">
                            <td style="border: 1px solid black; border-collapse:collapse;font-weight:bold;"
                                colspan="4">
                                {{ Carbon\Carbon::parse($day)->translatedFormat('l, d/m/Y') }}</td>
                        </tr>
                        @php
                            $datanya = App\Models\Kerja::where('hari', Carbon\Carbon::parse($day)->format('Y-m-d'))->get();
                        @endphp
                        @foreach ($datanya as $item)
                            @if ($item->cuti == true)
                                <tr style="border: 1px solid black; border-collapse:collapse;">
                                    <td style="border: 1px solid black; border-collapse:collapse;text-align:center;">
                                    </td>
                                    <td style="border: 1px solid black; border-collapse:collapse;color:red;">
                                        {{ $item->detail }}</td>
                                    <td style="border: 1px solid black; border-collapse:collapse;">
                                    </td>
                                    <td style="border: 1px solid black; border-collapse:collapse;">
                                    </td>
                                </tr>
                            @else
                                <tr style="border: 1px solid black; border-collapse:collapse;">
                                    <td style="border: 1px solid black; border-collapse:collapse;text-align:center;">
                                        {{ $loop->iteration }}</td>
                                    <td style="border: 1px solid black; border-collapse:collapse;">
                                        {{ $item->detail }}</td>
                                    <td style="border: 1px solid black; border-collapse:collapse;">
                                        {{ $item->awal }}</td>
                                    <td style="border: 1px solid black; border-collapse:collapse;">
                                        {{ $item->akhir }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </thead>
            </table>
            <table style="width:100%;margin-top: 25px;">
                <tr style="text-align:center;">
                    <td style="">Atasan Langsung</td>
                    <td style="">Bukittinggi, {{ $dateCetak }}</td>
                </tr>
                <tr style="text-align:center;">
                    <td style="">
                        <strong>Kepala Sub Bidang Pendapatan</strong>
                    </td>
                    <td style="">
                        <strong>Pembuat Laporan</strong>
                    </td>
                </tr>
                <tr style="text-align:center;">
                    <td style="">
                        <strong>lainnya dan Pelaporan</strong>
                    </td>
                    <td></td>
                </tr>
                <tr style="text-align:center;" rowspan="4">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    {{-- <td style="">
                    </td> --}}
                </tr>
                <tr style="text-align:center;">
                    <td style="">
                        <u>
                            <strong>ELSHI RAHMI OKTAVIA, S.Kom, M.Kom</strong>
                        </u>
                    </td>
                    <td style="">
                        <strong>RENAL EKI RIYANTO, S.Kom</strong>
                    </td>
                </tr>
                <tr style="text-align:center;">
                    <td style="">
                        NIP : 19781020 200901 2001
                    </td>
                    <td style="">

                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
