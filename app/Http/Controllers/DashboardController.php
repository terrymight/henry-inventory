<?php

namespace App\Http\Controllers;

use App\Models\customer;

class DashboardController extends Controller
{

    public function index()
    {
        $data = [];

        $data['unprocessed'] = customer::where('products_status', 'not processed')->get();
        $data['delivered'] = customer::where('products_status', 'delivered')->get();
        $data['processed'] = customer::where('products_status', 'processed')->get();
        $data['rescheduled'] = customer::where('products_status', 'rescheduled')->get();
        $data['canceled'] = customer::where('products_status', 'canceled')->get();
        // dd($data);
        return view('dashboard', compact('data'));
    }
}