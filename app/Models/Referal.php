<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_code',
        'ref_by'
    ];

    protected $table = 'referal';

    public function user(){
        return $this->belongsTo(Referal::class);
    }

    public function referals(){
        return $this->belongsTo(User::class);
    }
}
