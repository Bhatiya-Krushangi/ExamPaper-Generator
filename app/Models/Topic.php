<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $table = 'topic';
    protected $fillable = ['user_id','language','topic','status'];

    public function connect()
    {
        return $this->hasOne(Language::class,'id','language');
    }
    public function connect1()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
