<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['sum', 'user_id'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d.m.Y h:m');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
