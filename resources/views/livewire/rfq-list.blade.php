<div>
    <div class="d-flex justify-content-between">
        <div class="d-flex gap-2">
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
        </div>

        <div class="">
            <a href="{{ url('rfq/tambah') }}" class="btn btn-success">
                <i class="ti ti-plus-circle"></i> Buat MO
            </a>
        </div>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"><i class="ti ti-hash"></i> No</th>
                    <th scope="col"><i class="ti ti-id"></i> Vendor</th>
                    <th scope="col"><i class="ti ti-box"></i> Tanggal Pesan</th>
                    <th scope="col"><i class="ti ti-stack"></i> Grand Total</th>
                    <th scope="col"><i class="ti ti-flag"></i> Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rfq_list as $index => $rfq)
                    <tr x-on:click="window.location.href = '{{ url('rfq/' . $rfq->id) }}';" style="cursor: pointer;">
                        <td>{{ $index + 1 }}</td>

                        <td>{{ $rfq->vendor->nama ?? 'Tidak Ada Produk' }}</td>
                        <td>{{ $rfq->tanggal_pesan ?? 'Tidak Ada BOM' }}</td>
                        <td>{{ format_rupiah($rfq->grand_total) }}</td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $rfq->status->badge_classname }}">
                                {{ $rfq->status->nama }}
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
        {{ $rfq_list->links() }}
    </div>
</div>
