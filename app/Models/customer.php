<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class customer extends Model
{
    use Notifiable;

    protected $casts = [
        'products' => 'array'
    ];

    protected $fillable = [
        'fullname',
        'phone_number',
        'whatsapp_number',
        'customer_state',
        'dispatcher_id',
        'products',
        'date_of_delivery',
        'total_cost_of_products',
        'customer_address',
        'dispatcher_note',
        'customer_email',
        'invoice_number'
    ];



        /**

     * Set the Products

     *

     */

    public function setProductsAttribute($value)

    {

        $this->attributes['products'] = json_encode($value);

    }
        /**

     * Get the Products

     *

     */


    use HasFactory;

    
}
