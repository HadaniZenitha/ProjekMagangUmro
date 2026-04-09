<?php

namespace App\Imports;

use App\Models\Divisi;
use App\Models\Pic;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PicImport implements ToCollection, WithHeadingRow
{
    private int $createdCount = 0;
    private int $updatedCount = 0;
    private array $failedRows = [];

    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            $excelRow = $index + 2;

            $nid = strtoupper(trim((string) ($row['nid'] ?? '')));
            $namaLengkap = trim((string) ($row['nama_lengkap'] ?? ''));
            $bidang = trim((string) ($row['bidang'] ?? ''));
            $jabatanLengkap = trim((string) ($row['jabatan_lengkap'] ?? ''));

            if ($nid === '' && $namaLengkap === '' && $bidang === '' && $jabatanLengkap === '') {
                continue;
            }

            if ($nid === '' || $namaLengkap === '' || $bidang === '') {
                $this->failedRows[] = [
                    'row' => $excelRow,
                    'nid' => $nid !== '' ? $nid : '-',
                    'reason' => 'Kolom wajib tidak lengkap (NID, NAMA_LENGKAP, BIDANG)',
                ];
                continue;
            }

            if (strlen($nid) > 10) {
                $this->failedRows[] = [
                    'row' => $excelRow,
                    'nid' => $nid,
                    'reason' => 'NID melebihi 10 karakter',
                ];
                continue;
            }

            $divisi = Divisi::query()
                ->whereRaw('LOWER(nama_divisi) = ?', [strtolower($bidang)])
                ->first();

            if (!$divisi) {
                $this->failedRows[] = [
                    'row' => $excelRow,
                    'nid' => $nid,
                    'reason' => "BIDANG '{$bidang}' tidak ditemukan pada master divisi",
                ];
                continue;
            }

            $pic = Pic::where('nid_pic', $nid)->first();

            if ($pic) {
                $pic->update([
                    'divisi_id' => $divisi->id,
                    'nama_pic' => $namaLengkap,
                    'jabatan' => $bidang,
                    'jabatan_lengkap' => $jabatanLengkap !== '' ? $jabatanLengkap : null,
                ]);

                $this->updatedCount++;
                continue;
            }

            Pic::create([
                'divisi_id' => $divisi->id,
                'nama_pic' => $namaLengkap,
                'nid_pic' => $nid,
                'jabatan' => $bidang,
                'jabatan_lengkap' => $jabatanLengkap !== '' ? $jabatanLengkap : null,
                'is_active' => true,
            ]);

            $this->createdCount++;
        }
    }

    public function getCreatedCount(): int
    {
        return $this->createdCount;
    }

    public function getUpdatedCount(): int
    {
        return $this->updatedCount;
    }

    public function getFailedRows(): array
    {
        return $this->failedRows;
    }

    public function getFailedCount(): int
    {
        return count($this->failedRows);
    }
}
