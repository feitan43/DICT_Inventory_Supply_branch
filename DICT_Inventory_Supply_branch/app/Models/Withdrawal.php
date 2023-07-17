<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'remarks', 'recipient_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }
}
