{{-- Fallback show partial: menampilkan semua field detail secara dinamis --}}
{{-- Dipakai bila show_<slug>.blade.php spesifik belum tersedia --}}

@php
    $hidden = ['id', 'pengajuan_id', 'created_at', 'updated_at'];
    $fields = collect($detail->getAttributes())->except($hidden);
@endphp

<div class="row g-3">
    @forelse ($fields as $key => $value)
        @php
            $label    = \Illuminate\Support\Str::of($key)->replace('_', ' ')->title();
            $isFile   = \Illuminate\Support\Str::startsWith($key, 'scan_') || \Illuminate\Support\Str::contains($key, 'dokumen');
            $cast     = $detail->getCasts()[$key] ?? null;
        @endphp

        @if (blank($value))
            @continue
        @endif

        @if ($isFile)
            <div class="col-md-6">
                <p class="text-muted small mb-1">{{ $label }}</p>
                <a href="{{ Storage::url($value) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="ti ti-file-download me-1"></i>Lihat Dokumen
                </a>
            </div>
        @else
            <div class="col-md-4">
                <p class="text-muted small mb-1">{{ $label }}</p>
                <p class="fw-semibold mb-0">
                    @if ($cast === 'date' && $detail->{$key})
                        {{ $detail->{$key}->format('d M Y') }}
                    @else
                        {{ \Illuminate\Support\Str::of((string) $value)->replace('_', ' ') }}
                    @endif
                </p>
            </div>
        @endif
    @empty
        <div class="col-12">
            <p class="text-muted mb-0">Tidak ada detail untuk ditampilkan.</p>
        </div>
    @endforelse
</div>
