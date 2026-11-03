<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = 'language';
    protected $fillable = ['user_id','language'];

    public function connect()
    {
        return $this->hasOne(User::class,'id','user_id','status');
    }
}
