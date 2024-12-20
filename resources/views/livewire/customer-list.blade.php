<div>
    <div class="d-flex justify-content-between">
        <input type="search" name="search" class="form-control w-50" placeholder="Cari Customer" wire:model.live="search">

        <a href="{{ url('customer/tambah') }}" class="btn btn-success">
            <i class="ti ti-plus-circle"></i> Tambah Customer
        </a>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"><i class="ti ti-hash"></i> No</th>
                    <th scope="col"><i class="ti ti-id"></i> Nama</th>
                    <th scope="col"><i class="ti ti-building"></i> Nama Perusahaan</th>
                    <th scope="col"><i class="ti ti-file-text"></i> NPWP</th>
                    <th scope="col"><i class="ti ti-map-pin"></i> Alamat</th>
                    <th scope="col"><i class="ti ti-phone"></i> Nomor Telepon</th>
                    <th scope="col"><i class="ti ti-device-mobile"></i> Nomor Telepon Mobile</th>
                    <th scope="col"><i class="ti ti-mail"></i> Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer_list as $index => $customer)
                    <tr x-on:click="window.location.href = '{{ url('customer/' . $customer->id) }}';"
                        style="cursor: pointer;">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $customer->nama }}</td>
                        <td>{{ $customer->nama_perusahaan }}</td>
                        <td>{{ $customer->npwp ?? '-' }}</td>
                        <td>{{ $customer->r_provinsi->name }}, {{ $customer->r_kota->name }}, {{ $customer->jalan }}
                        </td>
                        <td>{{ $customer->nomor_telepon }}</td>
                        <td>{{ $customer->nomor_telepon_mobile }}</td>
                        <td>{{ $customer->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $customer_list->links() }}
    </div>
</div>
