<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Izinkan mass assignment
    protected $fillable = [
        'title',  // Pastikan sesuai dengan nama kolom di database
        'status',
    ];
}
