<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DataLayanan implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize,
    WithTitle
{
    protected $status;
    protected $kategoriId;
    protected $tanggalMulai;
    protected $tanggalAkhir;

    /**
     * @param string|null $status       Filter status: draft, diajukan, diproses, selesai, ditolak
     * @param int|null    $kategoriId   Filter kategori_pengajuan_id
     * @param string|null $tanggalMulai Filter tanggal mulai (Y-m-d)
     * @param string|null $tanggalAkhir Filter tanggal akhir (Y-m-d)
     */
    public function __construct(
        $status = null,
        $kategoriId = null,
        $tanggalMulai = null,
        $tanggalAkhir = null
    ) {
        $this->status = $status;
        $this->kategoriId = $kategoriId;
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalAkhir = $tanggalAkhir;
    }

    public function collection()
    {
        $query = Pengajuan::with(['kategori', 'user'])
            ->orderBy('created_at', 'desc');

        if (!empty($this->status)) {
            $query->where('status', $this->status);
        }

        if (!empty($this->kategoriId)) {
            $query->where('kategori_pengajuan_id', $this->kategoriId);
        }

        if (!empty($this->tanggalMulai) && !empty($this->tanggalAkhir)) {
            $query->whereBetween('created_at', [
                $this->tanggalMulai . ' 00:00:00',
                $this->tanggalAkhir . ' 23:59:59',
            ]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Pengajuan',
            'Kategori Layanan',
            'Diajukan Oleh',
            'Status',
            'Tanggal Pengajuan',
            'Diproses Pada',
            'Selesai Pada',
            'Catatan Penolakan',
        ];
    }

    public function map($row): array
    {
        static $no = 0;
        $no++;

        $statusLabel = Pengajuan::$statusLabels[$row->status]['label'] ?? $row->status;

        return [
            $no,
            $row->nomor_pengajuan,
            $row->kategori->nama ?? '-',
            $row->user->name ?? '-',
            $statusLabel,
            optional($row->created_at)->format('d-m-Y H:i'),
            $row->tanggal_proses ? $row->tanggal_proses->format('d-m-Y H:i') : '-',
            $row->tanggal_selesai ? $row->tanggal_selesai->format('d-m-Y H:i') : '-',
            $row->catatan_penolakan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0F1F3D'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Data Layanan';
    }
}
