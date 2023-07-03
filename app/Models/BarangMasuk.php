<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function scopePending()
    {
        $this->where('status', 'pending');
    }
}
