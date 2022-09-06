<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatcherState extends Model
{
    protected $fillable = [
        'user_id',
        'state_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dispatcher_state';

        /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    use HasFactory;
}
