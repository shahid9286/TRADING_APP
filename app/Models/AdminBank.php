<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminBank extends Model
{
        use SoftDeletes;

    protected $table = 'admin_banks';

    protected $fillable = ['bank_name', 'bank_account', 'order_no', 'status'];

}
