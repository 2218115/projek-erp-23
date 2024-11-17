<div>
    <div class="d-flex justify-content-between">
        <input type="search" name="search" class="form-control w-50" placeholder="Cari Vendor" wire:model.live="search">

        <a href="{{ url('vendor/tambah') }}" class="btn btn-success">
            <i class="ti ti-plus-circle"></i> Buat Vendor
        </a>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"><i class="ti ti-hash"></i> No</th>
                    <th scope="col"><i class="ti ti-id"></i> Nama</th>
                    <th scope="col"><i class="ti ti-user"></i> Kontak Penghubung</th>
                    <th scope="col"><i class="ti ti-map-pin"></i> Alamat</th>
                    <th scope="col"><i class="ti ti-phone"></i> Nomor Telepon</th>
                    <th scope="col"><i class="ti ti-device-mobile"></i> Nomor Telepon Mobile</th>
                    <th scope="col"><i class="ti ti-mail"></i> Email</th>
                    <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendor_list as $index => $vendor)
                    <tr x-on:click="window.location.href = '{{ url('vendor/' . $vendor->id) }}';"
                        style="cursor: pointer;">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $vendor->nama }}</td>
                        <td>{{ $vendor->kontak_penghubung }}</td>
                        <td>{{ $vendor->r_provinsi->name }}, {{ $vendor->r_kota->name }}, {{ $vendor->jalan }}</td>
                        <td>{{ $vendor->nomor_telepon }}</td>
                        <td>{{ $vendor->nomor_telepon_mobile }}</td>
                        <td>{{ $vendor->email }}</td>
                        <td>

                            {{-- <td>
                            <a href="{{ url('vendor/' . $vendor->id . '/edit') }}" class="btn btn-warning btn-sm">
                                <i class="ti ti-edit"></i> Edit
                            </a>

                            <form id="delete-vendor-{{ $vendor->id }}" action="{{ url('vendor/' . $vendor->id) }}"
                                method="POST">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="ti ti-trash"></i> Hapus
                                </button>
                                @csrf
                                @method('DELETE')
                            </form>
                        </td> --}}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $vendor_list->links() }}
    </div>
</div>
