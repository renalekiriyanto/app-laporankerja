<div>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <form wire:submit.prevent="store">
        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <input wire:model="hari" type="date" class="form-control" id="hari">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" wire:model="cuti">
            <label class="form-check-label" for="flexCheckDefault">
                Cuti
            </label>
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Detail</label>
            <input wire:model="detail" type="text" class="form-control" id="detail">
        </div>
        <div class="mb-3">
            <label for="awal" class="form-label">Awal</label>
            <input wire:model="awal" type="time" class="form-control" id="awal">
        </div>
        <div class="mb-3">
            <label for="akhir" class="form-label">Akhir</label>
            <input wire:model="akhir" type="time" class="form-control" id="akhir">
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i></button>
    </form>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</div>
