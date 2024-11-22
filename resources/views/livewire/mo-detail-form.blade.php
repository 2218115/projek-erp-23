<div>
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
                    @if ($current_status == 'DRAFT')
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
                            <p>Check Availability</p>
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
                    @endif

                    @if ($current_status == 'CONFIRMED')
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
                            <p>Confirmed</p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Check Availability</p>
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
                    @endif

                    @if ($current_status == 'CA_AVAILABLE')
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
                            <p>Confirmed</p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Check Availability</p>
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
                    @endif

                    @if ($current_status == 'CA_NOT_AVAILABLE')
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
                            <p>Confirmed</p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active bg-danger border-danger">
                                <i class="ti ti-x"></i>
                            </div>
                            <p>Check Availability</p>
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
                    @endif

                    @if ($current_status == 'PRODUCE')
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
                            <p>Confirmed</p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Check Availability</p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
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
                    @endif

                    @if ($current_status == 'DONE')
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
                            <p>Confirmed</p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Check Availability</p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Produced</p>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="step-circle active">
                                <i class="ti ti-check"></i>
                            </div>
                            <p>Done</p>
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
                    <label for="produk" class="form-label">Produk</label>
                    <input type="text" class="form-select @error('produk') is-invalid @enderror" id="produk"
                        name="produk" wire:model.live="produk_search" disabled />
                    @error('produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" x-data="{ open: false }">
                    <label for="bom" class="form-label">bom</label>
                    <input type="text" class="form-select @error('bom') is-invalid @enderror" id="bom"
                        name="bom" wire:model.live="bom_search" disabled />
                    @error('bom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tanggal_produksi" class="form-label">Tanggal Produksi</label>
                    <input type="date" class="form-control @error('tanggal_produksi') is-invalid @enderror"
                        id="tanggal_produksi" name="tanggal_produksi" wire:model.live="tanggal_produksi" disabled />
                    @error('tanggal_produksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kuantitas_produksi" class="form-label">Kuantitas Produksi</label>
                    <input type="text" class="form-control @error('kuantitas_produksi') is-invalid @enderror"
                        id="kuantitas_produksi" name="kuantitas_produksi" wire:model.defer="kuantitas_produksi"
                        x-on:keyup.debounce="$wire.kuantitas_produksi = $event.target.value; $wire.on_quantity_change()"
                        disabled />
                    @error('kuantitas_produksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            @if ($current_status == 'DRAFT')
                <div class="d-flex gap-2 justify-content-end">
                    <div class="d-flex justify-content-end gap-4">
                        <button type="submit" class="btn btn-primary w-48">Mark As TODO</button>
                    </div>
                    <div class="d-flex justify-content-end gap-4">
                        <a href="{{ url('/mo/' . $mo_id . '/edit') }}" class="btn btn-secondary w-48">Edit</a>
                    </div>
                </div>
            @endif

            @if ($current_status == 'CONFIRMED')
                <div class="d-flex justify-content-end gap-4">
                    <button type="submit" class="btn btn-primary w-48">Check Availability</button>
                </div>
            @endif

            @if ($current_status == 'CA_AVAILABLE')
                <div class="d-flex justify-content-end gap-4">
                    <button type="submit" class="btn btn-primary w-48">Produce</button>
                </div>
            @endif

            @if ($current_status == 'CA_NOT_AVAILABLE')
                <div class="d-flex gap-2 justify-content-end">
                    <div class="d-flex justify-content-end gap-4">
                        <button type="submit" class="btn btn-primary w-48">Check Availability Again</button>
                    </div>
                    <div class="d-flex justify-content-end gap-4">
                        <button type="submit" class="btn btn-danger w-48" disabled>Produce</button>
                    </div>
                </div>
            @endif

            @if ($current_status == 'PRODUCE')
                <div class="d-flex justify-content-end gap-4">
                    <button type="submit" class="btn btn-primary w-48">Mark As Done</button>
                </div>
            @endif

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
                        <td>{{ $mo_item['to_consumed'] }} </td>
                        <td class="@if ($mo_item['is_available'] == 'F') bg-red-100 @endif">{{ $mo_item['reserved'] }}
                        </td>
                        <td>{{ $mo_item['is_available'] ? 'Ya' : 'Tidak' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
