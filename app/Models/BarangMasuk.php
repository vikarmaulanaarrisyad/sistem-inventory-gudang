<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BarangMasuk extends Model
{
    use HasFactory;

    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'barangmasuk';
    /**
     * Get the route key for the model.
     */

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    /**
     * Scope a query to only include active users.
     */
    public function scopePending(Builder $query): void
    {
        $query->where('status', 'pending');
    }
}
