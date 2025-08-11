<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;
    public function enquiryComments()
    {
        return $this->hasMany(EnquiryComment::class);
    }
}
