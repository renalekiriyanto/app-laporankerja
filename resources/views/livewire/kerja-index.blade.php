<div>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> Logout</button>
    </form>
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if ($statusUpdate)
        <livewire:kerja-update />
    @else
        <livewire:kerja-create />
    @endif
    <form action="{{ route('print') }}" method="post">
        @csrf
        <button class="btn btn-outline-primary mt-3"><i class="bi bi-printer"></i>Sekarang</button>
    </form>
    <button class="btn btn-outline-primary mt-3" wire:click="changeStatusPrint"><i class="bi bi-printer"></i> Set
        Tanggal Print</button>
    @if ($statusPrint)
        <div class="form-floating mb-3 mt-3">
            <input type="date" wire:model="tglPrint" class="form-control">
            <label>Tanggal Print</label>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" wire:model="tglAwal">
                    <label>Tanggal Awal</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" wire:model="tglAkhir">
                    <label>Tanggal Akhir</label>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" wire:click="print">Print</button>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Hari</th>
                <th scope="col">Detail</th>
                <th scope="col">Awal</th>
                <th scope="col">Akhir</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kerja as $item)
                <tr wire:key="item-{{ $item->id }}">
                    <th scope="row">
                        {{ $loop->iteration }}
                    </th>
                    <td>{{ date('d-m-Y', strtotime($item->hari)) }}</td>
                    <td>{{ $item->detail }}</td>
                    <td>{{ $item->awal }}</td>
                    <td>{{ $item->akhir }}</td>
                    <td>
                        <button wire:click="getContact({{ $item->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-pen"></i></button>
                        <button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"><i
                                class="bi bi-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $kerja->links() }}
    <script></script>
</div>
