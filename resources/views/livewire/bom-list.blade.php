<div>
    <div class="d-flex justify-content-between">
        <input type="search" name="search" class="form-control w-50" placeholder="Cari BOM" wire:model.live="search">


        <a href="{{ url('bom/tambah') }}" class="btn btn-success">
            <i class="ti ti-plus-circle"></i> Buat BOM
        </a>
    </div>
    <div class="table-responsive mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Referensi</th>
                    <th>Kuantitas</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>Kursi Bagus</td>
                    <td>KB25</td>
                    <td>10.5</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Kursi Bagus</td>
                    <td>KB25</td>
                    <td>10.5</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Kursi Bagus</td>
                    <td>KB25</td>
                    <td>10.5</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Kursi Bagus</td>
                    <td>KB25</td>
                    <td>10.5</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
