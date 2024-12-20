<div>

    <form wire:submit.prevent="save">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_bom" class="form-label">Nama BOM</label>
                    <input type="text" class="form-control @error('nama_bom') is-invalid @enderror" id="nama_bom"
                        name="nama_bom" wire:model.live="nama_bom" />
                    @error('nama_bom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" x-data="{ open: false }">
                    <label for="produk" class="form-label">Produk</label>

                    <div class="select-container mb-3">
                        <input type="text" class="form-select @error('produk') is-invalid @enderror"
                            id="produk_search" name="produk_search" x-on:click="open = true" x-ref="produk_search"
                            wire:model.live="produk_search" />
                        @error('produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="select-items-container card" x-show="open" x-transition
                            x-on:click.outside="open = false" style="z-index: 9999;">
                            <div>
                                <div class="select-item" wire:loading>
                                    Memuat...
                                </div>

                                <div wire:loading:remove>
                                    @if ($produk_list->count() > 0)
                                        @foreach ($produk_list as $produk)
                                            <div class="select-item" style="z-index: 999999"
                                                x-on:click="open = false; 
                                                $wire.dispatch('bom_item_change');
                                                @this.set('produk', '{{ $produk->id }}'); 
                                                @this.set('harga_jual', '{{ $produk->harga_jual }}');
                                                @this.set('biaya_produk', '{{ $produk->biaya_produk }}');
                                                @this.set('produk_search', '{{ $produk->nama }}');">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="border rounded d-flex align-items-center justify-content-center mb-2 ratio ratio-1x1 overflow-hidden"
                                                            style="height: 4rem; width: 4rem;">
                                                            <img id="gambar-preview"
                                                                src="{{ asset('storage/gambar_produk/' . $produk->gambar) }}"
                                                                alt="Preview Gambar" class="img-fluid"
                                                                style="display: block;">
                                                        </div>
                                                    </div>
                                                    <div class="col-9">
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

                    @error('produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual" disabled
                            wire:model.live="harga_jual" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="kuantitas" class="form-label">Kuantitas</label>
                    <input type="number" class="form-control" id="kuantitas" name="kuantitas"
                        wire:model.live="kuantitas" value="1" disabled />
                </div>
                <div class="mb-3">
                    <label for="referensi_internal" class="form-label">Referensi Internal</label>
                    <input type="text" class="form-control @error('referensi_internal') is-invalid @enderror"
                        id="referensi_internal" name="referensi_internal" wire:model.live="referensi_internal" />
                    @error('referensi_internal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="biaya_produk" class="form-label">Biaya Produk</label>
                    <input type="number" class="form-control" id="biaya_produk" name="biaya_produk" disabled
                        wire:model.live="biaya_produk" />
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-4">
            <button type="submit" class="btn btn-primary w-48">Simpan BOM</button>
        </div>
    </form>

    <!-- Tabel BOM -->
    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><i class="ti ti-hash"></i> No</th>
                    <th scope="col"><i class="ti ti-tag"></i> Nama Bahan</th>
                    <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                    <th scope="col"><i class="ti ti-box"></i> Harga Asli</th>
                    <th scope="col"><i class="ti ti-slash"></i> Harga BOM</th>
                    <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($bom_item_list as $index => $bom_item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="select-container" x-data="{ open: false }">
                                <input type="search" class="form-select @error('bahan_baku') is-invalid @enderror"
                                    id="bahan_baku" name="bahan_baku"
                                    x-on:click="open = true; $wire.bahan_baku_search($event.target.value);"
                                    x-ref="bahan_baku" x-on:keyup="$wire.bahan_baku_search($event.target.value)"
                                    value="{{ $bom_item_list[$index]['nama_bahan_baku'] ? $bom_item_list[$index]['nama_bahan_baku'] : '' }}" />
                                @error('bahan_baku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="select-items-container card" x-show="open" x-transition
                                    x-on:click.outside="open = false">
                                    <div>
                                        <div class="select-item" wire:loading>
                                            Memuat...
                                        </div>

                                        <div wire:loading:remove>
                                            @if ($bahan_baku_list ? $bahan_baku_list->count() > 0 : false)
                                                @foreach ($bahan_baku_list as $bahan_baku)
                                                    <div class="select-item"
                                                        x-on:click="open = false;
                                                        @this.call('on_bom_item_bahan_change', {{ $index }},  {{ $bahan_baku->id }}); 
                                                        $refs.bahan_baku.value = '{{ $bahan_baku->nama }}'">
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
                            <input type="number"
                                class="form-control @error('bom_item_list.{{ $index }}.kuantitas') is-invalid @enderror"
                                id="kuantitas_{{ $index }}" name="kuantitas_{{ $index }}"
                                wire:model.defer="bom_item_list.{{ $index }}.kuantitas"
                                x-on:keyup="$wire.call('on_bom_item_qty_change',{{ $index }}, $event.target.value);" />
                        </td>
                        <td>{{ $bom_item['harga_asli'] }}</td>
                        <td>{{ $bom_item['harga_bom'] }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                wire:click="on_bom_item_bahan_delete({{ $index }})"><i
                                    class="ti ti-trash"></i> Hapus</button>
                        </td>
                    </tr>
                @endforeach


                <tr>
                    <td colspan="3">
                        <button class="btn btn-secondary btn-sm" wire:click="tambah_bom_item"><i
                                class="ti ti-plus"></i> Tambah Bahan Baku</button>
                    </td>
                    <td>Total Biaya</td>
                    <td>
                        <b>{{ $total_biaya }}</b>
                    </td>
                    <td colspan="1"></td>
                </tr>

                <tr>
                    <td colspan="3"></td>
                    <td>Interval Biaya</td>
                    <td>
                        <b>{{ $interval_biaya }}</b>
                    </td>
                    <td colspan="1"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
