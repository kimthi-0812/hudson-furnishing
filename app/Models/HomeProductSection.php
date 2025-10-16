<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeProductSection extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'limit',
        'is_active',
        'order'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'home_product_section_product', 'home_product_section_id', 'product_id');
    }
}

