<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\DispatcherState;
use App\Models\state;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $datas = DB::table('users')
            ->join('permissions', 'users.id', '=', 'permissions.user_id')
            ->select('users.*', 'permissions.phone','permissions.active')
            ->where('permissions.permission_id', 2)
            ->get();
        return view('user.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Permission;
        return view('user.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        info($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_permission' => 2,
        ]);

        Permission::create([
            'user_id' => $user->id,
            'permission_id' => 2,
            'phone' => $request->phone,
            'active' => true,
        ]);

        event(new Registered($user));

        return redirect()->route('users.list');
    }

    public function assign($id) {

        $data = new DispatcherState;
        $states = state::all();
        return view('user.assign', compact(['data','id','states']));
    }

    public function storeState(Request $request) 
    {
        $request->validate([
            'state_id' => 'unique:dispatcher_state',
            
        ]);
        DispatcherState::create([
            'user_id' => $request->user_id,
            'state_id' => $request->state_id
        ]);
        
        return redirect()->route('users.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('users')
        ->join('permissions', 'users.id', '=', 'permissions.user_id')
        ->where('users.id', $id)
        ->select('users.*', 'permissions.phone', 'permissions.active')
        ->first();

        $covered = DB::table('dispatcher_state')
        ->join('states', 'states.id', '=', 'dispatcher_state.state_id')
        ->join('users', 'users.id', '=', 'dispatcher_state.user_id')
        ->where('users.id', $id)
        ->select('dispatcher_state.id as dispatcher_id', 'states.id', 'states.name as state_name')
        ->get();


        return view('user.show', ['data'=> $data, 'covereds' => $covered, 'id' =>$id ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('users')
        ->join('permissions', 'users.id', '=', 'permissions.user_id')
        ->where('users.id', $id)
        ->select('users.*', 'permissions.phone')
        ->first();
        return view('user.create', compact('data'));

        
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
        $data = DB::table('users')
        ->join('permissions', 'users.id', '=', 'permissions.user_id')
        ->where('users.id', $id)
        ->select('users.*', 'permissions.phone')
        ->first();

        User::where('id', $id)
            ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Permission::where('user_id', $id)
            ->update([
            'phone' => $request->phone,
        ]);

        return redirect('users/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::where('id', $request->delete_id)->delete();
        Permission::where('user_id', $request->delete_id)->delete();
        DispatcherState::where('user_id', $request->delete_id)->delete();
        return redirect('users/list');
    }

    public function removeDispatcher (Request $request)
    {
        DispatcherState::where('id', $request->delete_id)->delete();
        return redirect('users/list');
    }

}
