<div>
    <form wire:submit.prevent="save">
        @csrf
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                        id="nama_perusahaan" name="nama_perusahaan" wire:model.live="nama_perusahaan" />
                    @error('nama_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kontak_penghubung" class="form-label">Kontak Penghubung</label>
                    <input type="text" class="form-control @error('kontak_penghubung') is-invalid @enderror"
                        id="kontak_penghubung" name="kontak_penghubung" wire:model.live="kontak_penghubung" />
                    @error('kontak_penghubung')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" x-data="{ open: false }">
                    <label for="provinsi" class="form-label">Provinsi</label>

                    <div class="select-container mb-3">
                        <input type="search" class="form-select @error('provinsi') is-invalid @enderror"
                            id="provinsi_search" name="provinsi_search" x-on:click="open = true" x-ref="provinsi_search"
                            wire:model.live="provinsi_search" wire:keyup="load_provinsi" x-on:keydown="open = true" />
                        @error('provinsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="select-items-container card" x-show="open" x-transition
                            x-on:click.outside="open = false" style="display: none;">
                            <div>
                                <div class="select-item" wire:loading>
                                    Memuat...
                                </div>

                                <div wire:loading:remove>
                                    @if ($provinsi_list ? $provinsi_list->count() > 0 : false)
                                        @foreach ($provinsi_list as $provinsi)
                                            <div class="select-item"
                                                x-on:click="open = false;
                                                    $wire.provinsi_search = '{{ $provinsi->name }}';
                                                    $wire.provinsi = '{{ $provinsi->code }}';
                                                    $wire.load_kota();
                                                ">
                                                <div class="w-100">{{ $provinsi->name }}</div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="select-item">
                                            Tidak di temukan Provinsi yang anda Cari
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mb-3" x-data="{ open: false }">
                    <label for="kota" class="form-label">Kota</label>

                    <div class="select-container mb-3">
                        <input type="search" class="form-select @error('kota') is-invalid @enderror" id="kota_search"
                            name="kota_search" x-on:click="open = true" x-ref="kota_search"
                            wire:model.live="kota_search" wire:keyup="load_kota" x-on:keydown="open = true" />
                        @error('kota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="select-items-container card" x-show="open" x-transition
                            x-on:click.outside="open = false" style="display: none;">
                            <div>
                                <div class="select-item" wire:loading>
                                    Memuat...
                                </div>

                                <div wire:loading:remove>
                                    @if ($kota_list ? $kota_list->count() > 0 : false)
                                        @foreach ($kota_list as $kota)
                                            <div class="select-item"
                                                x-on:click="
                                                    open = false;
                                                    $wire.kota_search = '{{ $kota->name }}';
                                                    $wire.kota = '{{ $kota->code }}';
                                                ">
                                                <div class="w-100">{{ $kota->name }}</div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="select-item">
                                            Tidak di temukan Kota yang anda Cari
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jalan" class="form-label">Jalan</label>
                    <input type="text" class="form-control @error('jalan') is-invalid @enderror" id="jalan"
                        name="jalan" wire:model.live="jalan" />
                    @error('jalan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                        id="nomor_telepon" name="nomor_telepon" wire:model.live="nomor_telepon" />
                    @error('nomor_telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nomor_telepon_mobile" class="form-label">Nomor Telepon Mobile</label>
                    <input type="text" class="form-control @error('nomor_telepon_mobile') is-invalid @enderror"
                        id="nomor_telepon_mobile" name="nomor_telepon_mobile" wire:model.live="nomor_telepon_mobile" />
                    @error('nomor_telepon_mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" wire:model.live="email" />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary w-48">Simpan</button>
            <a href="@if ($vendor_id) {{ url('vendor/' . $vendor_id) }} @else {{ url('vendor') }} @endif"
                class="btn btn-secondary w-48">Batal</a>
        </div>
    </form>
</div>