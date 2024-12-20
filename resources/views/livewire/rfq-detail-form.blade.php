<div>
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
                    @if ($current_status == 'RFQ')
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>RFQ</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Purchase Order</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Validated</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Waiting Bill</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Paid</p>
                        </div>
                    @elseif ($current_status == 'PO')
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>RFQ</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Purchase Order</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Validated</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Waiting Bill</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Paid</p>
                        </div>
                    @elseif ($current_status == 'VALIDATED')
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>RFQ</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Purchase Order</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Validated</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Waiting Bill</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Paid</p>
                        </div>
                    @elseif ($current_status == 'WAITING_BILL')
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>RFQ</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Purchase Order</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Validated</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Waiting Bill</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Paid</p>
                        </div>
                    @elseif ($current_status == 'PAID')
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>RFQ</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Purchase Order</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Validated</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Waiting Bill</p>
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Paid</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="change_to_next_status">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3" x-data="{ open: false }">
                    <label for="vendor" class="form-label">Vendor</label>

                    <div class="select-container mb-3">
                        <input type="text" class="form-select @error('vendor') is-invalid @enderror"
                            id="vendor_search" name="vendor_search" disabled
                            x-on:click="open = true; $wire.do_vendor_load($event.target.value)" x-ref="vendor_search"
                            x-on:keyup.debounce="$wire.do_vendor_load($event.target.value)"
                            wire:model.live.debounce="vendor_search" />
                        @error('vendor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="select-items-container card" style="display: none;" x-show="open" x-transition
                            x-on:click.outside="open = false; 
                        if ($refs.vendor_search.value == '') { $wire.vendor = '';}">
                            <!-- Konten lainnya -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="referensi_vendor" class="form-label">Referensi Vendor</label>
                        <input type="number" class="form-control" id="referensi_vendor" name="referensi_vendor"
                            wire:model.live="referensi_vendor" disabled />
                        @error('referensi_vendor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tanggal_pesan" class="form-label">Tanggal Pesan</label>
                    <input type="date" class="form-control @error('tanggal_pesan') is-invalid @enderror"
                        id="tanggal_pesan" name="tanggal_pesan" wire:model.live="tanggal_pesan" disabled />
                    @error('tanggal_pesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-4">
            @if ($current_status == 'RFQ')
                <button type="submit" class="btn btn-primary w-48">Confirm Order</button>
            @endif

            @if ($current_status == 'PO')
                <button type="submit" class="btn btn-primary w-48">Validate</button>
            @endif

            @if ($current_status == 'VALIDATED')
                <button type="submit" class="btn btn-primary w-48">Create
                    Bill</button>
            @endif

            @if ($current_status == 'WAITING_BILL')
                <button type="submit" class="btn btn-primary w-48">Paid</button>
            @endif
        </div>
    </form>
    <a href="{{ url('/rfq/report/' . $rfq_id) }}" class="btn btn-secondary w-48">Cetak RFQ</a>

    <!-- Tabel BOM -->
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    @if ($current_status == 'RFQ')
                        <th scope="col">No</th>
                        <th scope="col"><i class="ti ti-package"></i> Bahan Baku</th>
                        <th scope="col"><i class="ti ti-file-description"></i> Deskripsi</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                        <th scope="col"><i class="ti ti-currency-dollar"></i> Harga Satuan</th>
                        <th scope="col"><i class="ti ti-percentage"></i> Pajak</th>
                        <th scope="col"><i class="ti ti-calculator"></i> Subtotal</th>
                        <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                    @elseif($current_status == 'PO')
                        <th scope="col">No</th>
                        <th scope="col"><i class="ti ti-package"></i> Bahan Baku</th>
                        <th scope="col"><i class="ti ti-file-description"></i> Deskripsi</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Diterima</th>
                        <th scope="col"><i class="ti ti-currency-dollar"></i> Harga Satuan</th>
                        <th scope="col"><i class="ti ti-percentage"></i> Pajak</th>
                        <th scope="col"><i class="ti ti-calculator"></i> Subtotal</th>
                        <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                    @elseif($current_status == 'VALIDATED')
                        <th scope="col">No</th>
                        <th scope="col"><i class="ti ti-package"></i> Bahan Baku</th>
                        <th scope="col"><i class="ti ti-file-description"></i> Deskripsi</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Diterima</th>
                        <th scope="col"><i class="ti ti-currency-dollar"></i> Harga Satuan</th>
                        <th scope="col"><i class="ti ti-percentage"></i> Pajak</th>
                        <th scope="col"><i class="ti ti-calculator"></i> Subtotal</th>
                        <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                    @elseif($current_status == 'WAITING_BILL')
                        <th scope="col">No</th>
                        <th scope="col"><i class="ti ti-package"></i> Bahan Baku</th>
                        <th scope="col"><i class="ti ti-file-description"></i> Deskripsi</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Diterima</th>
                        <th scope="col"><i class="ti ti-currency-dollar"></i> Harga Satuan</th>
                        <th scope="col"><i class="ti ti-percentage"></i> Pajak</th>
                        <th scope="col"><i class="ti ti-calculator"></i> Subtotal</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Dibayar</th>
                        <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                    @elseif($current_status == 'PAID')
                        <th scope="col">No</th>
                        <th scope="col"><i class="ti ti-package"></i> Bahan Baku</th>
                        <th scope="col"><i class="ti ti-file-description"></i> Deskripsi</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Diterima</th>
                        <th scope="col"><i class="ti ti-currency-dollar"></i> Harga Satuan</th>
                        <th scope="col"><i class="ti ti-percentage"></i> Pajak</th>
                        <th scope="col"><i class="ti ti-calculator"></i> Subtotal</th>
                        <th scope="col"><i class="ti ti-list-numbers"></i> Dibayar</th>
                        <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                    @else
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($current_status == 'RFQ')
                    @foreach ($rfq_item_list as $index => $rfq_item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" class="form-select @error('bahan_baku') is-invalid @enderror"
                                    value="{{ $rfq_item_list[$index]['nama_bahan_baku'] ?? '' }}" disabled />
                                @error('bahan_baku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                    value="{{ $rfq_item['deskripsi'] }}" disabled />
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('kuantitas') is-invalid @enderror"
                                    value="{{ $rfq_item['kuantitas'] }}" disabled />
                                @error('kuantitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('harga_satuan') is-invalid @enderror"
                                    value="{{ $rfq_item['harga_satuan'] }}" disabled />
                                @error('harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('pajak') is-invalid @enderror"
                                    value="{{ $rfq_item['pajak'] }}" disabled />
                                @error('pajak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                {{ format_rupiah($rfq_item['subtotal']) }}
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" disabled><i class="ti ti-trash"></i>
                                    Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @elseif ($current_status == 'PO')
                    @foreach ($rfq_item_list as $index => $rfq_item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" class="form-select @error('bahan_baku') is-invalid @enderror"
                                    value="{{ $rfq_item_list[$index]['nama_bahan_baku'] ?? '' }}" disabled />
                                @error('bahan_baku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                    value="{{ $rfq_item['deskripsi'] }}" disabled />
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('kuantitas') is-invalid @enderror"
                                    value="{{ $rfq_item['kuantitas'] }}" disabled />
                                @error('kuantitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('diterima') is-invalid @enderror"
                                    value="{{ $rfq_item['diterima'] }}" disabled />
                                @error('diterima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text"
                                    class="form-control @error('harga_satuan') is-invalid @enderror"
                                    value="{{ $rfq_item['harga_satuan'] }}" disabled />
                                @error('harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('pajak') is-invalid @enderror"
                                    value="{{ $rfq_item['pajak'] }}" disabled />
                                @error('pajak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                {{ format_rupiah($rfq_item['subtotal']) }}
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" disabled><i class="ti ti-trash"></i>
                                    Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @elseif ($current_status == 'VALIDATED')
                    @foreach ($rfq_item_list as $index => $rfq_item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" class="form-select @error('bahan_baku') is-invalid @enderror"
                                    value="{{ $rfq_item_list[$index]['nama_bahan_baku'] ?? '' }}" disabled />
                                @error('bahan_baku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                    value="{{ $rfq_item['deskripsi'] }}" disabled />
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('kuantitas') is-invalid @enderror"
                                    value="{{ $rfq_item['kuantitas'] }}" disabled />
                                @error('kuantitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('diterima') is-invalid @enderror"
                                    value="{{ $rfq_item['diterima'] }}" disabled />
                                @error('diterima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text"
                                    class="form-control @error('harga_satuan') is-invalid @enderror"
                                    value="{{ $rfq_item['harga_satuan'] }}" disabled />
                                @error('harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('pajak') is-invalid @enderror"
                                    value="{{ $rfq_item['pajak'] }}" disabled />
                                @error('pajak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                {{ format_rupiah($rfq_item['subtotal']) }}
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" disabled><i class="ti ti-trash"></i>
                                    Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @elseif ($current_status == 'WAITING_BILL')
                    @foreach ($rfq_item_list as $index => $rfq_item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" class="form-select @error('bahan_baku') is-invalid @enderror"
                                    value="{{ $rfq_item_list[$index]['nama_bahan_baku'] ?? '' }}" disabled />
                                @error('bahan_baku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                    value="{{ $rfq_item['deskripsi'] }}" disabled />
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('kuantitas') is-invalid @enderror"
                                    value="{{ $rfq_item['kuantitas'] }}" disabled />
                                @error('kuantitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('diterima') is-invalid @enderror"
                                    value="{{ $rfq_item['diterima'] }}" disabled />
                                @error('diterima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text"
                                    class="form-control @error('harga_satuan') is-invalid @enderror"
                                    value="{{ $rfq_item['harga_satuan'] }}" disabled />
                                @error('harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('pajak') is-invalid @enderror"
                                    value="{{ $rfq_item['pajak'] }}" disabled />
                                @error('pajak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                {{ format_rupiah($rfq_item['subtotal']) }}
                            </td>
                            <td>
                                {{ format_rupiah($rfq_item['dibayar']) }}
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" disabled><i class="ti ti-trash"></i>
                                    Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @elseif ($current_status == 'PAID')
                    @foreach ($rfq_item_list as $index => $rfq_item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" class="form-select @error('bahan_baku') is-invalid @enderror"
                                    value="{{ $rfq_item_list[$index]['nama_bahan_baku'] ?? '' }}" disabled />
                                @error('bahan_baku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                    value="{{ $rfq_item['deskripsi'] }}" disabled />
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('kuantitas') is-invalid @enderror"
                                    value="{{ $rfq_item['kuantitas'] }}" disabled />
                                @error('kuantitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('diterima') is-invalid @enderror"
                                    value="{{ $rfq_item['diterima'] }}" disabled />
                                @error('diterima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text"
                                    class="form-control @error('harga_satuan') is-invalid @enderror"
                                    value="{{ $rfq_item['harga_satuan'] }}" disabled />
                                @error('harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control @error('pajak') is-invalid @enderror"
                                    value="{{ $rfq_item['pajak'] }}" disabled />
                                @error('pajak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                {{ format_rupiah($rfq_item['subtotal']) }}
                            </td>
                            <td>
                                {{ format_rupiah($rfq_item['dibayar']) }}
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" disabled><i class="ti ti-trash"></i>
                                    Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif


                @if ($current_status == 'RFQ')
                    <tr>
                        <td colspan="5">
                            <button class="btn btn-secondary btn-sm" disabled><i class="ti ti-plus"></i>
                                Tambah Bahan Baku</button>
                        </td>
                        <td>Total tanpa Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_tanpa_pajak) }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>

                    <tr>
                        <td colspan="5"></td>
                        <td>Total Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_pajak) }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>

                    <tr>
                        <td colspan="5"></td>
                        <td><b>Grand Total<b></td>
                        <td>
                            <b>{{ format_rupiah($grand_total) }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>
                @endif

                @if ($current_status == 'PO')
                    <tr>
                        <td colspan="6">
                            <button class="btn btn-secondary btn-sm" disabled><i class="ti ti-plus"></i>
                                Tambah Bahan Baku</button>
                        </td>
                        <td>Total tanpa Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_tanpa_pajak) }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>

                    <tr>
                        <td colspan="6"></td>
                        <td>Total Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_pajak) }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>

                    <tr>
                        <td colspan="6"></td>
                        <td><b>Grand Total<b></td>
                        <td>
                            <b>{{ format_rupiah($grand_total) }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>
                @endif

                @if ($current_status == 'VALIDATED')
                    <tr>
                        <td colspan="6">
                            <button class="btn btn-secondary btn-sm" disabled><i class="ti ti-plus"></i>
                                Tambah Bahan Baku</button>
                        </td>
                        <td>Total tanpa Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_tanpa_pajak) }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>

                    <tr>
                        <td colspan="6"></td>
                        <td>Total Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_pajak) }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>

                    <tr>
                        <td colspan="6"></td>
                        <td><b>Grand Total<b></td>
                        <td>
                            <b>{{ format_rupiah($grand_total) }}</b>
                        </td>
                        <td colspan="1"></td>
                    </tr>
                @endif

                @if ($current_status == 'WAITING_BILL')
                    <tr>
                        <td colspan="6">
                            <button class="btn btn-secondary btn-sm" disabled><i class="ti ti-plus"></i>
                                Tambah Bahan Baku</button>
                        </td>
                        <td>Total tanpa Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_tanpa_pajak) }}</b>
                        </td>
                        <td colspan="2"></td>
                    </tr>

                    <tr>
                        <td colspan="6"></td>
                        <td>Total Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_pajak) }}</b>
                        </td>
                        <td colspan="2"></td>
                    </tr>

                    <tr>
                        <td colspan="6"></td>
                        <td><b>Grand Total<b></td>
                        <td>
                            <b>{{ format_rupiah($grand_total) }}</b>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                @endif

                @if ($current_status == 'PAID')
                    <tr>
                        <td colspan="6">
                            <button class="btn btn-secondary btn-sm" disabled><i class="ti ti-plus"></i>
                                Tambah Bahan Baku</button>
                        </td>
                        <td>Total tanpa Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_tanpa_pajak) }}</b>
                        </td>
                        <td colspan="2"></td>
                    </tr>

                    <tr>
                        <td colspan="6"></td>
                        <td>Total Pajak</td>
                        <td>
                            <b>{{ format_rupiah($total_pajak) }}</b>
                        </td>
                        <td colspan="2"></td>
                    </tr>

                    <tr>
                        <td colspan="6"></td>
                        <td><b>Grand Total<b></td>
                        <td>
                            <b>{{ format_rupiah($grand_total) }}</b>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>

</div>
