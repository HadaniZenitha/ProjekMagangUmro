<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisis = [
            'GENERAL MANAGER',
            'KEUANGAN & ADMIN',
            'SDM',
            'Manajemen Mutu, Risiko & Kinerja',
            'Keuangan',
            'Pengadaan',
            'SENIOR MANAJER JASA HAR-1',
            'TEKNIK-1',
            'Mesin-1A',
            'Mesin-1B',
            'Listrik-1A',
            'Kontrol & Instumen-1A',
            'Listrik-1B',
            'Kontrol & Instrumen-1B',
            'PERENCANAAN & PERFORMA-1',
            'Resource Planning-1',
            'Performa & QC-1',
            'K3-1',
            'Sarana-1',
            'Umum-1',
            'SENIOR MANAJER JASA HAR-2',
            'TEKNIK-2',
            'Mesin-2A',
            'Mesin-2B',
            'Listrik-2A',
            'Kontrol & Instumen-2A',
            'Listrik-2B',
            'Kontrol & Instrumen-2B',
            'PERENCANAAN & PERFORMA-2',
            'Resource Planning-2',
            'Performa & QC-2',
            'K3-2',
            'Sarana-2',
            'Umum-2',
            'SENIOR MANAJER JASA INSPEKSI, REPAIR & EXPERTISE',
            'INSPEKSI & PENGUJIAN PERALATAN',
            'Mechanical NDE',
            'Non Mechanical NDE',
            'REPAIR',
            'Mechanical Workshop',
            'Non Mechanical Workshop',
            'Sarana & K3',
            'MANAGER UNIT UPHK',
            'TEKNIK',
            'PERENCANAAN & PEMBINAAN TEKNIK',
            'KEUANGAN & UMUM',
            'PENGADAAN',
            'K3 & KEAMANAN',
        ];

        $usedCodes = [];

        foreach ($divisis as $namaDivisi) {
            $kodeDivisi = $this->generateKodeDivisi($namaDivisi, $usedCodes);

            Divisi::updateOrCreate(
                ['kode_divisi' => $kodeDivisi],
                [
                    'nama_divisi' => $namaDivisi,
                    'is_active' => true,
                ]
            );
        }
    }

    private function generateKodeDivisi(string $namaDivisi, array &$usedCodes): string
    {
        $cleaned = strtoupper(preg_replace('/[^A-Z0-9\s\-]/', ' ', $namaDivisi));
        $parts = preg_split('/[\s\-]+/', trim($cleaned), -1, PREG_SPLIT_NO_EMPTY);

        $abbr = '';

        foreach ($parts as $part) {
            if (is_numeric($part)) {
                $abbr .= $part;
                continue;
            }

            if (strlen($part) <= 2 || preg_match('/\d/', $part)) {
                $abbr .= $part;
                continue;
            }

            $abbr .= $part[0];
        }

        $baseCode = substr($abbr ?: 'DIVISI', 0, 10);
        $finalCode = $baseCode;
        $counter = 1;

        while (in_array($finalCode, $usedCodes, true)) {
            $suffix = (string) $counter;
            $finalCode = substr($baseCode, 0, 10 - strlen($suffix)).$suffix;
            $counter++;
        }

        $usedCodes[] = $finalCode;

        return $finalCode;
    }
}
