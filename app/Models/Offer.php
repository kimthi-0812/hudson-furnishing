<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'image',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'discount_value' => 'decimal:2',
    ];

    public function products(): BelongsToMany
    {
        // Sử dụng belongsToMany và chỉ định tên bảng trung gian là 'offer_products'.
        // Khóa cục bộ sẽ là 'offer_id' và khóa xa là 'product_id'.
        return $this->belongsToMany(Product::class, 'offer_products', 'offer_id', 'product_id');
    }
}
