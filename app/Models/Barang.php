<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code','category_id','satuan_id','stock','harga'];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'code';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class);
    }
}
