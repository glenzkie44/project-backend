<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'type',
        'price',
        'acquired_on',
    ];

    public function container() {
        return $this->belongsTo('App\Models\Tool', 'acquired_on', 'id');
    }
}
