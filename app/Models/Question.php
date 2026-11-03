<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';
    protected $fillable = ['user_id','language','topic','question','marks','status'];

     public function connect()
    {
        return $this->hasOne(Language::class,'id','language');
    }
    public function connect1()
    {
        return $this->hasOne(Topic::class,'id','topic');
    }
    public function connect2()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
