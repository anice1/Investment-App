<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Deposit extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'deposits';
    protected $fillable = [
        'coin',
        'amount',
        'deposit_address',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
