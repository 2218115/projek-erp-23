<div>
    <div class="container mb-4">
        <!-- Step Progress (untuk menandakan status) -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Status Step Circles -->
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle active">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Draft</p>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle ">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Sales Order</p>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle ">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Delivery</p>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle ">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Invoice</p>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle ">
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
                <!-- Customer Select Input -->
                <div class="mb-3" x-data="{ open: false }">
                    <label for="customer" class="form-label">Pelanggan</label>
                    <div class="select-container">
                        <input type="text" class="form-select @error('customer') is-invalid @enderror"
                            id="customer_search" wire:model.live="customer_search"
                            x-on:keyup.debounce="$wire.do_customer_load($event.target.value)"
                            placeholder="Cari Pelanggan" />
                        @error('customer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="select-items-container card" x-show="open" x-transition
                            x-on:click.outside="open = false;">
                            <div wire:loading>
                                Memuat...
                            </div>
                            <div wire:loading.remove>
                                @if ($customers->count() > 0)
                                    @foreach ($customers as $customer)
                                        <div class="select-item"
                                            x-on:click="$wire.customer = '{{ $customer->id }}'; $wire.customer_search = '{{ $customer->name }}'; open = false;">
                                            {{ $customer->name }}
                                        </div>
                                    @endforeach
                                @else
                                    <div class="select-item">Tidak ditemukan pelanggan</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="perusahaan" class="form-label">Perusahaan</label>
                    <input type="text" id="perusahaan" name="perusahaan" class="form-control"
                        wire:model="perusahaan" />
                    @error('perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" wire:model="alamat" />
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="col-md-6">
                <!-- Order Date -->
                <div class="mb-3">
                    <label for="order_date" class="form-label">Tanggal Order</label>
                    <input type="date" id="order_date" name="order_date" class="form-control"
                        wire:model="order_date" />
                    @error('order_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Payment Term -->
                <div class="mb-3">
                    <label for="payment_term" class="form-label">Syarat Pembayaran</label>
                    <select id="payment_term" name="payment_term" class="form-select" wire:model="payment_term">
                        <option value="">Pilih Syarat Pembayaran</option>
                        <option value="cash">Tunai</option>
                        <option value="credit">Kredit</option>
                        <option value="installment">Cicilan</option>
                    </select>
                    @error('payment_term')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="d-flex justify-content-end gap-4">
                <button type="submit" class="btn btn-primary w-48">Buat Order</button>
            </div>
        </div>
    </form>

    <!-- Tabel BOM -->
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"> No</th>
                    <th scope="col"><i class="ti ti-package"></i> Produk</th>
                    <th scope="col"><i class="ti ti-file-description"></i> Deskripsi</th>
                    <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                    <th scope="col"><i class="ti ti-currency-dollar"></i> Harga Satuan</th>
                    <th scope="col"><i class="ti ti-percentage"></i> Pajak</th>
                    <th scope="col"><i class="ti ti-calculator"></i> Subtotal</th>
                    <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($sales_detail_list as $index => $sales_item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="select-container" x-data="{ open: false }">
                                <input type="text" class="form-select @error('produk') is-invalid @enderror"
                                    id="produk_search" name="produk_search"
                                    x-on:click="open = true; $wire.do_produk_load($event.target.value)"
                                    x-ref="produk_search"
                                    x-on:keyup.debounce="$wire.do_produk_load($event.target.value)"
                                    value="{{ $sales_detail_list[$index]['nama_produk'] ? $sales_detail_list[$index]['nama_produk'] : '' }}" />
                                @error('produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="select-items-container card" x-show="open" x-transition
                                    x-on:click.outside="open = false;" style="display: none; min-width: 18rem;">
                                    <div>
                                        <div class="select-item" wire:loading>
                                            Memuat...
                                        </div>

                                        <div wire:loading:remove>
                                            @if ($produk_list ? $produk_list->count() > 0 : false)
                                                @foreach ($produk_list as $produk)
                                                    <div class="select-item"
                                                        x-on:click="open = false;
                                                        $wire.call('on_sales_item_produk_change', {{ $index }},  {{ $produk->id }}); 
                                                        $refs.produk.value = '{{ $produk->nama }}'">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <div class="border rounded d-flex align-items-center justify-content-center mb-2 ratio ratio-1x1 overflow-hidden"
                                                                    style="height: 3rem; width: 3rem;">
                                                                    <img id="gambar-preview"
                                                                        src="{{ asset('storage/gambar_produk/' . $produk->gambar) }}"
                                                                        alt="Preview Gambar" class="img-fluid"
                                                                        style="display: block;">
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="w-100">{{ $produk->nama }}</div>
                                                                <div class="w-100"><strong>Harga Beli:
                                                                        {{ $produk->harga_beli }}</strong></div>
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
                                x-ref="deskripsi_{{ $index }}" value="{{ $sales_item['deskripsi'] }}"
                                x-on:keyup="$wire.on_sales_item_deskripsi_change({{ $index }}, $event.target.value);" />
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control @error('kuantitas') is-invalid @enderror"
                                id="kuantitas_{{ $index }}" name="kuantitas_{{ $index }}"
                                x-ref="kuantitas_{{ $index }}" value="{{ $sales_item['kuantitas'] }}"
                                x-on:keyup="$wire.on_sales_item_kuantitas_change({{ $index }}, $event.target.value);" />
                            @error('kuantitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control @error('harga_satuan') is-invalid @enderror"
                                id="harga_satuan_{{ $index }}" name="harga_satuan_{{ $index }}"
                                x-ref="harga_satuan_{{ $index }}" value="{{ $sales_item['harga_satuan'] }}"
                                x-on:keyup="$wire.on_sales_item_harga_satuan_change({{ $index }}, $event.target.value);" />
                            @error('harga_satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control @error('pajak') is-invalid @enderror"
                                id="pajak_{{ $index }}" name="pajak_{{ $index }}"
                                x-ref="pajak_{{ $index }}" value="{{ $sales_item['pajak'] }}"
                                x-on:keyup="$wire.on_sales_item_pajak_change({{ $index }}, $event.target.value);" />
                            @error('pajak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            {{ format_rupiah($sales_item['subtotal']) }}
                        </td>

                        <td>
                            <button class="btn btn-danger btn-sm"
                                wire:click="hapus_sales_item({{ $index }})"><i class="ti ti-trash"></i>
                                Hapus</button>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="5">
                        <button class="btn btn-secondary btn-sm" wire:click="tambah_sales_item"><i
                                class="ti ti-plus"></i>
                            Tambah Produk</button>
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
