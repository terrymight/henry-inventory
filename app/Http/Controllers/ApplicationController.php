<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Application::firstOrCreate([
            'company_name' => 'SKY HIGH DIGITAL LAB LTD',
            'orders' => 'BUSINESS NAME REGISTRATION NO. 3728995',
            'phone' => '2347010199700',
            'email' => 'info@gmail.com',
            'address' => 'ASEMANKSE STREET WUSE ZONE 2, ABUJA NIGERIA'
        ])->get();
        return view('application.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Application::where('id',$id)->firstOrFail();
        return view('application.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        info($id);
        $this->validate($request, [
            'company_name' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        Application::where('id',$id)
        ->update([
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'phone_sec' => $request->phone_sec,
            'orders' => $request->orders,
        ]);

        return redirect('application/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
