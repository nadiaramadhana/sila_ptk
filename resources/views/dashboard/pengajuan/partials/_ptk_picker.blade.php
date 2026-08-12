@php
    $selectedPtkId = old('ptk_id', $selectedPtkId ?? (data_get($editDetail ?? null, 'pengajuan.ptk_id') ?? data_get($pengajuan ?? null, 'ptk_id')));
    $selectedPtk = collect($dataPtks ?? [])->firstWhere('id', (int) $selectedPtkId);
    $nameValue = old('nama_lengkap', $selectedPtk?->nama_ptk ?? data_get($editDetail ?? null, 'nama_lengkap', ''));
    $widgetId = $widgetId ?? 'ptk';
@endphp

<div class="col-12" data-ptk-widget data-ptk-widget-id="{{ $widgetId }}">
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Cari PTK</label>
            <input type="text"
                   class="form-control"
                   data-ptk-search
                   placeholder="Ketik nama PTK untuk mencari">
        </div>
        <div class="col-md-4">
            <label class="form-label">Data PTK <span class="text-danger">*</span></label>
            <select name="ptk_id"
                    class="form-select @error('ptk_id') is-invalid @enderror"
                    data-ptk-select>
                <option value="">-- Pilih Data PTK --</option>
                @foreach (($dataPtks ?? []) as $ptk)
                    <option value="{{ $ptk->id }}"
                            data-nama="{{ $ptk->nama_ptk }}"
                            data-nip="{{ $ptk->nip ?? '' }}"
                            data-nik="{{ $ptk->nik ?? '' }}"
                            data-search="{{ strtolower(trim($ptk->nama_ptk . ' ' . ($ptk->jabatan?->nama_jabatan ?? '') . ' ' . ($ptk->pangkat_golongan?->nama_golongan ?? ''))) }}"
                            {{ (string) $selectedPtkId === (string) $ptk->id ? 'selected' : '' }}>
                        {{ $ptk->nama_ptk }}@if ($ptk->jabatan?->nama_jabatan) - {{ $ptk->jabatan->nama_jabatan }}@endif
                    </option>
                @endforeach
            </select>
            @error('ptk_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text"
                   name="nama_lengkap"
                   class="form-control @error('nama_lengkap') is-invalid @enderror"
                   value="{{ $nameValue }}"
                   data-ptk-name
                   readonly>
            @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const normalizeText = (value) => (value || '')
                    .toString()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .toLowerCase()
                    .trim();

                document.querySelectorAll('[data-ptk-widget]').forEach(function (widget) {
                    const searchInput = widget.querySelector('[data-ptk-search]');
                    const select = widget.querySelector('[data-ptk-select]');
                    const nameInput = widget.querySelector('[data-ptk-name]');

                    if (!searchInput || !select || !nameInput) {
                        return;
                    }

                    const getField = (name) => widget.querySelector(`[name="${name}"]`);

                    const baseOptions = Array.from(select.options).map(function (option) {
                        return {
                            value: option.value,
                            label: option.textContent.trim(),
                            nama: option.dataset.nama || '',
                            nip: option.dataset.nip || '',
                            nik: option.dataset.nik || '',
                            search: option.dataset.search || normalizeText(option.textContent),
                        };
                    });

                    const selectedValue = select.value;

                    function syncFields(selectedOption, force = false) {
                        if (!selectedOption || !selectedOption.value) {
                            if (force) {
                                ['nama_lengkap', 'nip', 'nip_nipppk', 'nik'].forEach(function (fieldName) {
                                    const input = getField(fieldName);
                                    if (input) {
                                        input.value = '';
                                    }
                                });
                            }
                            return;
                        }

                        const fieldValues = {
                            nama_lengkap: selectedOption.dataset.nama || selectedOption.textContent.split(' - ')[0].trim(),
                            nip: selectedOption.dataset.nip || '',
                            nip_nipppk: selectedOption.dataset.nip || '',
                            nik: selectedOption.dataset.nik || '',
                        };

                        Object.entries(fieldValues).forEach(function ([fieldName, value]) {
                            const input = getField(fieldName);
                            if (!input) {
                                return;
                            }

                            if (force || !input.value) {
                                input.value = value;
                            }
                        });
                    }

                    function renderOptions(term) {
                        const normalizedTerm = normalizeText(term);
                        const currentValue = select.value;

                        select.innerHTML = '';

                        baseOptions.forEach(function (item, index) {
                            if (index === 0) {
                                const placeholder = new Option(item.label, item.value, false, false);
                                select.add(placeholder);
                                return;
                            }

                            if (!normalizedTerm || item.search.includes(normalizedTerm)) {
                                const option = new Option(item.label, item.value, false, item.value === currentValue);
                                option.dataset.nama = item.nama;
                                option.dataset.nip = item.nip;
                                option.dataset.nik = item.nik;
                                option.dataset.search = item.search;
                                select.add(option);
                            }
                        });

                        if (currentValue && !Array.from(select.options).some(function (option) {
                            return option.value === currentValue;
                        })) {
                            select.value = '';
                        }

                        syncFields(select.selectedOptions[0], false);
                    }

                    searchInput.addEventListener('input', function () {
                        renderOptions(this.value);
                    });

                    select.addEventListener('change', function () {
                        syncFields(select.selectedOptions[0], true);
                    });

                    if (selectedValue) {
                        searchInput.value = select.selectedOptions[0]?.textContent || '';
                    }

                    renderOptions(searchInput.value);
                    select.value = selectedValue;
                    syncFields(select.selectedOptions[0], false);
                });
            });
        </script>
    @endpush
@endonce
