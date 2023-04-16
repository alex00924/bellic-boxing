<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country',
        'state',
        'rounds',
        'date',
        'passport',
        'visa',
        'promoter',
        'oponent',
        'notes',
        'created_by'
    ];


}
