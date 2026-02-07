<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'FName',
        'lName',
        'age',
        'is_complete',
        'status',
    ];



}
