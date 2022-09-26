<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comments extends Model
{
    use Notifiable;

    protected $fillable = [
        'comments_name',
        'invoice_id'
    ];
}