<div>
    <form wire:submit.prevent="save">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Bahan Baku</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" wire:model.live="nama" />
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategoriba"
                        wire:model.live="kategori">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori_list as $kategori)
                            <option value="{{ $kategori->id }}"> {{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <select class="form-select @error('ukuran') is-invalid @enderror" id="ukuran" name="ukuran"
                        wire:model.live="ukuran">
                        <option value="">Pilih Ukuran</option>
                        @foreach ($ukuran_list as $ukuran)
                            <option value="{{ $ukuran->id }}"> {{ $ukuran->nama }}</option>
                        @endforeach
                    </select>
                    @error('ukuran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" id="model"
                        name="model" wire:model.live="model" />
                    @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                    <label for="barcode" class="form-label">Barcode</label>
                    <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode"
                        name="barcode" wire:model.live="barcode" />
                    @error('barcode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="gambar" class="form-label">Masukan Gambar</label>
                    <div class="border rounded d-flex align-items-center justify-content-center mb-2 ratio ratio-1x1 overflow-hidden"
                        style="height: 11.4rem; width: 11.4rem;">
                        @if ($gambar)
                            <img id="gambar-preview"
                                src="{{ is_string($gambar) ? asset('/gambar_bahan_baku/' . $gambar) : $gambar->temporaryUrl() }}"
                                alt="Preview Gambar" class="img-fluid">
                        @endif
                        <span>
                            <i class="ti ti-picture"></i>
                        </span>
                    </div>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                        name="gambar" wire:model.live="gambar" accept="image/*" />
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4"
                        wire:model.live="deskripsi">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pajak" class="form-label">Pajak</label>
                    <input type="number" class="form-control @error('pajak') is-invalid @enderror" id="pajak"
                        name="pajak" step="0.01" wire:model.live="pajak" />
                    @error('pajak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input type="number" class="form-control @error('harga_beli') is-invalid @enderror"
                        id="harga_beli" name="harga_beli" step="0.01" wire:model.live="harga_beli" />
                    @error('harga_beli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary w-48">Simpan Bahan Baku</button>
            <a href="{{ $bahan_baku_id ? url('bahan-baku/' . $bahan_baku_id) : url('bahan-baku') }}"
                class="btn btn-secondary w-48">Batal</a>
        </div>
    </form>
</div>
