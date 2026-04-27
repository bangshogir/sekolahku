<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'condition',
        'description',
        'photo',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    // === Constants ===
    const CONDITIONS = [
        'baik'         => 'Baik',
        'rusak_ringan' => 'Rusak Ringan',
        'rusak_berat'  => 'Rusak Berat',
    ];

    // === Accessors ===
    public function getConditionLabelAttribute(): string
    {
        return self::CONDITIONS[$this->condition] ?? $this->condition;
    }

    public function getConditionBadgeAttribute(): string
    {
        return match($this->condition) {
            'baik'         => 'badge-success',
            'rusak_ringan' => 'badge-warning',
            'rusak_berat'  => 'badge-danger',
            default        => 'badge-gray',
        };
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return asset('images/placeholder-infra.jpg');
    }
}
