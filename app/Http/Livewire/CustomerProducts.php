<?php

namespace App\Http\Livewire;

use App\Models\customer;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerProducts extends Component
{
    public $allProducts = [];
    public $customerProducts = [
        
    ];

    public $data, $states = [];

      

    public function mount()
    {
        
        $this->allProducts = Product::all()->sortBy('id');
        $this->data = new customer;
        $this->states = DB::table('states')
        ->join('dispatcher_state', 'dispatcher_state.state_id', '=', 'states.id')
        ->select('states.name as state_name', 'dispatcher_state.user_id as state_id')
        ->get();
        $this->customerProducts = [
            ['pro' => '', 'qty' => 1, 'px' => 0]
        ];
    }

    public function addProduct() 
    {
        $this->customerProducts[] =   ['pro' => '', 'qty' => 1, 'px' => 0];
       
    }

    public function removeProduct($index) 
    {
        unset($this->customerProducts[$index]);
        array_values($this->customerProducts);
    }

    public function render()
    {
        return view('livewire.customer-products');
    }

   
}
