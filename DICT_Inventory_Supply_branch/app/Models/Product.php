<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'brand',
        'description',
        'price',
        'quantity',
        'image',
        'category',
        'description',
    ];
        

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function logTransactions()
{
    return $this->hasMany(LogTransaction::class);
}

    
}
