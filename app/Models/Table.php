<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    protected $table = 'tables';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'name',
        'capacity',
        'is_available',
    ];
}
