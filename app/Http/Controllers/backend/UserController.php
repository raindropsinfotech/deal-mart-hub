<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

class UserController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:super-admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with('roles')->whereHas("roles", function($q){ $q->where("id",'!=', 1); })->withTrashed()->orderBy('id', 'desc')->get();
        $getRoles = Role::where("id",'!=', 1)->orderBy('name', 'desc')->get();
        return view('backend.users.index', compact('users','getRoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $getRoles = Role::orderBy('name', 'desc')->get();
        return view('backend.users.create', compact('getRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validUserData = $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required_with:password|same:password|min:6',
            // 'profile_img' => 'required|mimes:jpg,jpeg,png,webp|max:1000000'
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $userRole = $request->role;

        $user = User::create($data);
        $user->assignRole([$userRole]);

        return redirect()->route('backend_all_users')->with('success','User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $getRoles = Role::orderBy('name', 'desc')->get();
        return view('backend.users.edit', compact('getRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
