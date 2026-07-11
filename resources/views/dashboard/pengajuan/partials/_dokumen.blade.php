{{-- Partial reusable: render daftar dokumen scan sebagai tombol unduh --}}
{{-- Param: $detail (model), $files (array 'kolom' => 'Label') --}}
@php $shown = collect($files)->filter(fn ($l, $k) => filled($detail->{$k})); @endphp

@if ($shown->isNotEmpty())
    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Dokumen Pendukung</p></div>
    @foreach ($shown as $key => $label)
        <div class="col-md-4">
            <p class="text-muted small mb-1">{{ $label }}</p>
            <a href="{{ Storage::url($detail->{$key}) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="ti ti-file-download me-1"></i>Lihat Dokumen
            </a>
        </div>
    @endforeach
@endif
