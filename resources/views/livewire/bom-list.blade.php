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
                    <th scope="col"><i class="ti ti-hash"></i> No</th>
                    <th scope="col"><i class="ti ti-tag"></i> Nama BOM</th>
                    <th scope="col"><i class="ti ti-box"></i> Produk</th>
                    <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                    <th scope="col"><i class="ti ti-slash"></i> Referensi Internal</th>
                    <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                </tr>
            </thead>
            <tbody x-data="{ open: false }">
                @foreach ($bom_list as $index => $bom)
                    <tr x-on:click="open = !open">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $bom->nama }}</td>
                        <td>{{ $bom->produk->nama }}</td>
                        <td>{{ $bom->kuantitas }}</td>
                        <td>{{ $bom->referensi_internal }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"><i class="ti ti-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i> Hapus</button>
                        </td>
                    </tr>
                    <tr x-show="open">
                        <th></th>
                        <th scope="col"><i class="ti ti-hash"></i> No</th>
                        <th scope="col"><i class="ti ti-box"></i> Bahan Baku</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                        <th scope="col"><i class="ti ti-slash"></i>Harga Asli</th>
                        <th scope="col"><i class="ti ti-settings"></i> Harga Bom</th>
                    </tr>
                    @foreach ($bom->bom_detail as $index_bahan_baku => $bom_detail)
                        <tr x-show="open">
                            <td></td>
                            <td>{{ $index_bahan_baku + 1 }}</td>
                            <td>{{ $bom_detail->bahan_baku->nama }}</td>
                            <td>{{ $bom_detail->kuantitas }}</td>
                            <td>{{ $bom_detail->harga_asli }}</td>
                            <td>{{ $bom_detail->harga_bom }}</td>
                        </tr>
                    @endforeach
                    <tr x-show="open">
                        <td colspan="4">
                        </td>
                        <td>Total Biaya</td>
                        <td>
                            <b>{{ $bom->grand_total }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
