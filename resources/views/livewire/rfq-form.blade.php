<div>
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
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
                </div>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="save">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3" x-data="{ open: false }">
                    <label for="vendor" class="form-label">Vendor</label>

                    <div class="select-container mb-3">
                        <input type="text" class="form-select @error('vendor') is-invalid @enderror"
                            id="vendor_search" name="vendor_search"
                            x-on:click="open = true; $wire.do_vendor_load($event.target.value)" x-ref="vendor_search"
                            x-on:keyup.debounce="$wire.do_vendor_load($event.target.value)"
                            wire:model.live.debounce="vendor_search" />
                        @error('vendor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="select-items-container card" style="display: none;" x-show="open" x-transition
                            x-on:click.outside="open = false; 
                            if ($refs.vendor_search.value == '') { $wire.vendor = '';}">
                            <div>
                                <div class="select-item" wire:loading>
                                    Memuat...
                                </div>

                                <div wire:loading:remove>
                                    @if ($vendor_list->count() > 0)
                                        @foreach ($vendor_list as $vendor)
                                            <div class="select-item"
                                                x-on:click="open = false; $wire.vendor_search = '{{ $vendor->nama }}'; $wire.vendor = '{{ $vendor->id }}'">
                                                <div class="col-9">
                                                    <div class="w-100">{{ $vendor->nama }}</div>
                                                    <div class="w-100">
                                                        {{ $vendor->r_provinsi->name . ', ' . $vendor->r_kota->name . ', ' . $vendor->jalan }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="select-item">
                                            Tidak di temukan Vendor
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="referensi_vendor" class="form-label">Referensi Vendor</label>
                        <input type="text" class="form-control" id="referensi_vendor" name="referensi_vendor"
                            wire:model.live="referensi_vendor" />
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
                        id="tanggal_pesan" name="tanggal_pesan" wire:model.live="tanggal_pesan" />
                    @error('tanggal_pesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-4">
            <button type="submit" class="btn btn-primary w-48">Buat RFQ</button>
        </div>
    </form>

    <!-- Tabel BOM -->
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"> No</th>
                    <th scope="col"><i class="ti ti-package"></i> Bahan Baku</th>
                    <th scope="col"><i class="ti ti-file-description"></i> Deskripsi</th>
                    <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                    <th scope="col"><i class="ti ti-currency-dollar"></i> Harga Satuan</th>
                    <th scope="col"><i class="ti ti-percentage"></i> Pajak</th>
                    <th scope="col"><i class="ti ti-calculator"></i> Subtotal</th>
                    <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($rfq_item_list as $index => $rfq_item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="select-container" x-data="{ open: false }">
                                <input type="text" class="form-select @error('bahan_baku') is-invalid @enderror"
                                    id="bahan_baku_search" name="bahan_baku_search"
                                    x-on:click="open = true; $wire.do_bahan_baku_load($event.target.value)"
                                    x-ref="bahan_baku_search"
                                    x-on:keyup.debounce="$wire.do_bahan_baku_load($event.target.value)"
                                    value="{{ $rfq_item_list[$index]['nama_bahan_baku'] ? $rfq_item_list[$index]['nama_bahan_baku'] : '' }}" />
                                @error('bahan_baku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="select-items-container card" x-show="open" x-transition
                                    x-on:click.outside="open = false;" style="display: none; min-width: 18rem;">
                                    <div>
                                        <div class="select-item" wire:loading>
                                            Memuat...
                                        </div>

                                        <div wire:loading:remove>
                                            @if ($bahan_baku_list ? $bahan_baku_list->count() > 0 : false)
                                                @foreach ($bahan_baku_list as $bahan_baku)
                                                    <div class="select-item"
                                                        x-on:click="open = false;
                                                        $wire.call('on_rfq_item_bahan_change', {{ $index }},  {{ $bahan_baku->id }}); 
                                                        $refs.bahan_baku_search.value = '{{ $bahan_baku->nama }}'">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <div class="border rounded d-flex align-items-center justify-content-center mb-2 ratio ratio-1x1 overflow-hidden"
                                                                    style="height: 3rem; width: 3rem;">
                                                                    <img id="gambar-preview"
                                                                        src="{{ asset('storage/gambar_bahan_baku/' . $bahan_baku->gambar) }}"
                                                                        alt="Preview Gambar" class="img-fluid"
                                                                        style="display: block;">
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="w-100">{{ $bahan_baku->nama }}</div>
                                                                <div class="w-100"><strong>Harga Beli:
                                                                        {{ $bahan_baku->harga_beli }}</strong></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="select-item">
                                                    Tidak di temukan Bahan Baku
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi_{{ $index }}" name="deskripsi_{{ $index }}"
                                x-ref="deskripsi_{{ $index }}" value="{{ $rfq_item['deskripsi'] }}"
                                x-on:keyup="$wire.on_rfq_item_deskripsi_change({{ $index }}, $event.target.value);" />
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control @error('kuantitas') is-invalid @enderror"
                                id="kuantitas_{{ $index }}" name="kuantitas_{{ $index }}"
                                x-ref="kuantitas_{{ $index }}" value="{{ $rfq_item['kuantitas'] }}"
                                x-on:keyup="$wire.on_rfq_item_kuantitas_change({{ $index }}, $event.target.value);" />
                            @error('kuantitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control @error('harga_satuan') is-invalid @enderror"
                                id="harga_satuan_{{ $index }}" name="harga_satuan_{{ $index }}"
                                x-ref="harga_satuan_{{ $index }}" value="{{ $rfq_item['harga_satuan'] }}"
                                x-on:keyup="$wire.on_rfq_item_harga_satuan_change({{ $index }}, $event.target.value);" />
                            @error('harga_satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control @error('pajak') is-invalid @enderror"
                                id="pajak_{{ $index }}" name="pajak_{{ $index }}"
                                x-ref="pajak_{{ $index }}" value="{{ $rfq_item['pajak'] }}"
                                x-on:keyup="$wire.on_rfq_item_pajak_change({{ $index }}, $event.target.value);" />
                            @error('pajak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            {{ format_rupiah($rfq_item['subtotal']) }}
                        </td>

                        <td>
                            <button class="btn btn-danger btn-sm" wire:click="hapus_rfq_item({{ $index }})"><i
                                    class="ti ti-trash"></i>
                                Hapus</button>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="5">
                        <button class="btn btn-secondary btn-sm" wire:click="tambah_rfq_item"><i
                                class="ti ti-plus"></i>
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
            </tbody>
        </table>
    </div>
</div>
