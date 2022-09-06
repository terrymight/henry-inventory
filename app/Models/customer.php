<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
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
        'customer_email'
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

    public function getProductsAttribute($value)

    {

        return $this->attributes['products'] = json_decode($value);

    }
    use HasFactory;
}
