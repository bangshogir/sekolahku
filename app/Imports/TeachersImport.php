<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class TeachersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row): ?Teacher
    {
        return new Teacher([
            'name'       => $row['nama'] ?? null,
            'nip'        => !empty($row['nip']) ? $row['nip'] : null,
            'position'   => $row['jabatan'] ?? null,
            'subject'    => $row['mata_pelajaran'] ?? null,
            'bio'        => $row['bio'] ?? null,
            'is_active'  => isset($row['status'])
                            ? strtolower(trim($row['status'])) === 'aktif'
                            : true,
            'sort_order' => 0,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'nama.required' => 'Kolom "nama" wajib diisi pada setiap baris.',
        ];
    }
}
