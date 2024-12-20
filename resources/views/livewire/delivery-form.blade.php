<div>
    <div class="container mb-4">
        <!-- Step Progress (untuk menandakan status) -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle active">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Draft</p>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle active">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Sales Order</p>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle active">
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
            </div>

            <div class="d-flex justify-content-end gap-4">
                <button type="submit" class="btn btn-primary w-48">Validasi</button>
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
                    <th scope="col"><i class="ti ti-list-numbers"></i> Reserved</th>
                    <th scope="col"><i class="ti ti-percentage"></i> Demand</th>
                    <th scope="col"><i class="ti ti-percentage"></i> Delivered</th>
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
                            <input type="text" class="form-control @error('reserved') is-invalid @enderror"
                                id="reserved_{{ $index }}" name="reserved_{{ $index }}"
                                x-ref="reserved_{{ $index }}" value="{{ $sales_item['reserved'] }}"
                                x-on:keyup="$wire.on_sales_item_reserved_change({{ $index }}, $event.target.value);" />
                            @error('reserved')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control @error('demand') is-invalid @enderror"
                                id="demand_{{ $index }}" name="demand_{{ $index }}"
                                x-ref="demand_{{ $index }}" value="{{ $sales_item['demand'] }}"
                                x-on:keyup="$wire.on_sales_item_demand_change({{ $index }}, $event.target.value);" />
                            @error('demand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input type="text" class="form-control @error('delivered') is-invalid @enderror"
                                id="delivered{{ $index }}" name="delivered{{ $index }}"
                                x-ref="delivered{{ $index }}" value="{{ $sales_item['delivered'] }}"
                                x-on:keyup="$wire.on_sales_item_deliveredchange({{ $index }}, $event.target.value);" />
                            @error('delivered')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>