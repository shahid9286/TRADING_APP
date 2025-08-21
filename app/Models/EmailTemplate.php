<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'title',
        'subject',
        'body',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function attachments()
    {
        return $this->hasMany(EmailAttachment::class, 'template_id');
    }
    
}
