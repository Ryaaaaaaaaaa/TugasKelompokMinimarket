<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name','price','stock','branch_id'];
    public function branches()
    {
        return $this->belongsTo(Branch::class);
    }
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'detail_transactions', 'product_id', 'transaction_id');
    }
}
