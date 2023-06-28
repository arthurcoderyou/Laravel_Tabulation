<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    protected $table = 'contests';
    protected $fillable =[
        'contest_name',
        'announcement_date',
        'show_contest_result'
    ];
}
