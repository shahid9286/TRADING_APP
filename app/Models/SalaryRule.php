<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalaryRule extends Model
{
    protected $fillable = [
        'direct_investment',
        'salary',
    ];
}
