<?php

namespace App\Exports;

use App\Kelas;
use App\Raport;
use App\TahunAjaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RaportExport implements FromQuery, WithMapping, WithHeadings
{
    protected $raport;

    public function __construct(Kelas $kelas)
    {
        $this->tahunAjaran = TahunAjaran::getActive();
        $this->kelas = $kelas;
        $this->index = 1;
    }

    public function query()
    {
        return Raport::query()
            ->where('kelas_id', $this->kelas->id)
            ->with('siswa');
    }

    public function map($raport): array
    {
        return [
            $this->index++,
            $raport->siswa->nisn,
            $raport->nama_siswa,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'NISN',
            'Nama',
            'Sikap Spiritual',
            'Sikap Sosial',
            'Saran',
            'Tinggi Badan',
            'Berat Badan',
            'Kondisi Pendengaran',
            'Kondisi Penglihatan',
            'Kondisi Gigi',
            'Sakit',
            'Izin',
            'Tanpa Keterangan',
        ];
    }
}
