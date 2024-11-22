<div>
    <div class="container mb-4">
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
                        <div class="step-circle">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Confirmed</p>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Check Availableity</p>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Produced</p>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="step-circle">
                            <i class="ti ti-check"></i>
                        </div>
                        <p>Done</p>
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
                    <label for="produk" class="form-label">Produk</label>

                    <div class="select-container mb-3">
                        <input type="text" class="form-select @error('produk') is-invalid @enderror"
                            id="produk_search" name="produk_search"
                            x-on:click="open = true; $wire.do_produk_load($event.target.value)" x-ref="produk_search"
                            x-on:keyup.debounce="$wire.do_produk_load($event.target.value)"
                            wire:model.live.debounce="produk_search" />
                        @error('produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="select-items-container card" style="display: none;" x-show="open" x-transition
                            x-on:click.outside="open = false; 
                            if ($refs.produk_search.value == '') { $wire.produk = '';}">
                            <div>
                                <div class="select-item" wire:loading>
                                    Memuat...
                                </div>

                                <div wire:loading:remove>
                                    @if ($produk_list->count() > 0)
                                        @foreach ($produk_list as $produk)
                                            <div class="select-item"
                                                x-on:click="open = false; $wire.produk_search = '{{ $produk->nama }}'; $wire.produk = '{{ $produk->id }}'">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="border rounded d-flex align-items-center justify-content-center mb-2 ratio ratio-1x1 overflow-hidden"
                                                            style="height: 3rem; width: 3rem;">
                                                            <img id="gambar-preview"
                                                                src="{{ asset('storage/gambar_produk/' . $produk->gambar) }}"
                                                                alt="Preview Gambar" class="img-fluid"
                                                                style="display: block;">
                                                        </div>
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="w-100">{{ $produk->nama }}</div>
                                                        <div class="w-100"><strong>Harga Jual:
                                                                {{ $produk->harga_jual }}</strong></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="select-item">
                                            Tidak di temukan Produk
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3" x-data="{ open: false }">
                    <label for="bom" class="form-label">BOM</label>
                    <div class="select-container mb-3">
                        <input type="text" class="form-select @error('bom') is-invalid @enderror" id="bom_search"
                            name="bom_search" x-on:click="open = true; $wire.do_bom_load($event.target.value)"
                            x-ref="bom_search" x-on:keyup.debounce="$wire.do_bom_load($event.target.value)"
                            wire:model.live.debounce="bom_search" />
                        @error('bom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="select-items-container card" style="display: none;" x-show="open" x-transition
                            x-on:click.outside="open = false; 
                            if ($refs.bom_search.value == '') { $wire.bom = '';}">
                            <div>
                                <div class="select-item" wire:loading>
                                    Memuat...
                                </div>

                                <div wire:loading:remove>
                                    @if ($bom_list->count() > 0)
                                        @foreach ($bom_list as $bom)
                                            <div class="select-item"
                                                x-on:click="open = false; $wire.bom_search = '{{ $bom->nama }}'; $wire.bom = '{{ $bom->id }}'; $wire.on_bom_change();">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="border rounded d-flex align-items-center justify-content-center mb-2 ratio ratio-1x1 overflow-hidden"
                                                            style="height: 3rem; width: 3rem;">
                                                            <img id="gambar-preview"
                                                                src="{{ asset('storage/gambar_bom/' . $bom->gambar) }}"
                                                                alt="Preview Gambar" class="img-fluid"
                                                                style="display: block;">
                                                        </div>
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="w-100">{{ $bom->nama }}</div>
                                                        <div class="w-100"><strong>Harga Jual:
                                                                {{ $bom->harga_jual }}</strong></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="select-item">
                                            Tidak di temukan bom
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tanggal_produksi" class="form-label">Tanggal Produksi</label>
                    <input type="date" class="form-control @error('tanggal_produksi') is-invalid @enderror"
                        id="tanggal_produksi" name="tanggal_produksi" wire:model.live="tanggal_produksi" />
                    @error('tanggal_produksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kuantitas_produksi" class="form-label">Kuantitas Produksi</label>
                    <input type="text" class="form-control @error('kuantitas_produksi') is-invalid @enderror"
                        id="kuantitas_produksi" name="kuantitas_produksi" wire:model.defer="kuantitas_produksi"
                        x-on:keyup.debounce="$wire.kuantitas_produksi = $event.target.value; $wire.on_quantity_change()" />
                    @error('kuantitas_produksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                    <th scope="col">No</th>
                    <th scope="col"><i class="ti ti-package"></i> Bahan Baku</th>
                    <th scope="col"><i class="ti ti-file-description"></i> To Consumed</th>
                    <th scope="col"><i class="ti ti-list-numbers"></i> Reserved</th>
                    <th scope="col"><i class="ti ti-check"></i> Tersedia</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($mo_list as $index => $mo_item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mo_item['nama_bahan_baku'] }}</td>
                        <td>{{ $mo_item['to_consumed'] }}</td>
                        <td>{{ $mo_item['reserved'] }}</td>
                        <td>{{ $mo_item['is_available'] ? 'Ya' : 'Tidak' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
