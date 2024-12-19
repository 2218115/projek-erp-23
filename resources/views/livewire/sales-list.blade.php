<div>
    <div class="d-flex justify-content-between">
        {{-- <div class="d-flex gap-2">
            <div class="col-12">
                <input type="search" name="search" class="form-control" placeholder="Cari Manufacturing Order"
                    wire:model.live="search" />
            </div>
            <div class="col-12">
                <select wire:model.change="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach ($status_list as $status)
                        <option value="{{ $status->id }}">{{ $status->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}

        <div class="">
            <a href="{{ url('sales/tambah') }}" class="btn btn-success">
                <i class="ti ti-plus-circle"></i> Form Sales
            </a>
        </div>

        <div class="">
            <a href="{{ url('sales/delivery') }}" class="btn btn-success">
                <i class="ti ti-plus-circle"></i> Form Delivery
            </a>
        </div>

        <div class="">
            <a href="{{ url('sales/delivery') }}" class="btn btn-success">
                <i class="ti ti-plus-circle"></i> Form Bill
            </a>
        </div>
    </div>

    <div class="table-responsive mt-4">
        {{-- <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"><i class="ti ti-hash"></i> No</th>
                    <th scope="col"><i class="ti ti-id"></i> Produk</th>
                    <th scope="col"><i class="ti ti-box"></i> BOM</th>
                    <th scope="col"><i class="ti ti-stack"></i> Kuantitas</th>
                    <th scope="col"><i class="ti ti-calendar"></i> Tanggal Produksi</th>
                    <th scope="col"><i class="ti ti-flag"></i> Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mo_list as $index => $mo)
                    <tr x-on:click="window.location.href = '{{ url('mo/' . $mo->id) }}';" style="cursor: pointer;">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mo->produk->nama ?? 'Tidak Ada Produk' }}</td>
                        <td>{{ $mo->bom->nama ?? 'Tidak Ada BOM' }}</td>
                        <td>{{ $mo->kuantitas }}</td>
                        <td>{{ $mo->tanggal_produksi }}</td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $mo->status->badge_classname }}">
                                {{ $mo->status->nama }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data Manufacturing Order.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $mo_list->links() }} --}}
    </div>
</div>
