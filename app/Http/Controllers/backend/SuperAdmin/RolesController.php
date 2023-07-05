<?php

namespace App\Http\Controllers\backend\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $getRoles = Role::orderBy('id', 'desc')->withCount('users')->get();
        return view('backend.roles.index', compact('getRoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validUserData = $this->validate($request,[
            'name' => 'required|unique:roles,name|regex:/^[a-z\-]+$/',
        ]);

        $data = [
            'name' => $request->name,
            'eguard_namemail' => 'web',
        ];

        $user = Role::create($data);

        return redirect()->route('backend_roles')->with('success','Role created successfully!');
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
        $editRole = Role::findOrFail($id);
        return view('backend.roles.edit', compact('editRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $getRole = Role::where('id',$id)->firstOrFail();

        $validUserData = $this->validate($request,[
            'name' => 'required|regex:/^[a-z0-9\-]+$/|unique:roles,name,'.$id.',id',
        ]);

        $updateData = [
            'name' => $request->name,
        ];

        $getRole->update($updateData);

        return redirect()->route('backend_roles')->with('success','Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Role::where('id',$id)->delete();
        return redirect()->route('backend_roles')->with('success','Role deleted successfully!');
    }
}
