<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'competition_type',
        'level',
        'year',
        'certificate_photo',
        'description',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    // === Constants ===
    const LEVELS = [
        'sekolah'        => 'Tingkat Sekolah',
        'kecamatan'      => 'Tingkat Kecamatan',
        'kabupaten'      => 'Tingkat Kabupaten/Kota',
        'provinsi'       => 'Tingkat Provinsi',
        'nasional'       => 'Tingkat Nasional',
        'internasional'  => 'Tingkat Internasional',
    ];

    // === Accessors ===
    public function getLevelLabelAttribute(): string
    {
        return self::LEVELS[$this->level] ?? $this->level;
    }

    public function getLevelBadgeAttribute(): string
    {
        return match($this->level) {
            'sekolah'       => 'badge-gray',
            'kecamatan'     => 'badge-info',
            'kabupaten'     => 'badge-secondary',
            'provinsi'      => 'badge-primary',
            'nasional'      => 'badge-warning',
            'internasional' => 'badge-danger',
            default         => 'badge-gray',
        };
    }

    public function getCertificatePhotoUrlAttribute(): string
    {
        if ($this->certificate_photo) {
            return asset('storage/' . $this->certificate_photo);
        }
        return asset('images/placeholder-certificate.jpg');
    }
}
