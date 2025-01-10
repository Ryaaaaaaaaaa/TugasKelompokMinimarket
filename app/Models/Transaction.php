<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = ['branch_id','user_id','total_price','date'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'detail_transactions', 'transaction_id', 'product_id');
    }
    public function branches()
    {
        return $this->belongsTo(Branch::class);
    }
    public function transactionDetails()
    {
        return $this->hasMany(DetailTransaction::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
