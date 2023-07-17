<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;

    public $table = 'login_history';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
