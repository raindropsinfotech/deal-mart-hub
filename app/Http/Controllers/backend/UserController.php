<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Repositories\Interfaces\Backend\UserRepositoryInterface;
use App\Http\Requests\Backend\UserRequest;
use DB;

class UserController extends Controller
{
    private $userRepo;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->middleware('role:super-admin|admin');
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getResults = $this->userRepo->all();

        $users = $getResults['users'];
        $getRoles = $getResults['getRoles'];

        return view('backend.users.index', compact('users','getRoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $getRoles = Role::orderBy('name', 'desc')->get();
        $getRoles = Role::where("id",'!=', 1)->orderBy('name', 'desc')->get();
        return view('backend.users.create', compact('getRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ];

        $storeUser = $this->userRepo->store($data);

        if( $storeUser ) {
            return redirect()->route('backend_all_users')->with('success','User created successfully!');
        } else {
            return redirect()->route('backend_all_users')->with('error',"Oops! Couldn't create user!");
        }
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
        // Render page based on tabs
        if( request()->routeIs('backend_edit_user_account') ) {
            $page = 'account';
        } elseif ( request()->routeIs('backend_edit_user_security') ) {
            $page = 'security';
        } elseif ( request()->routeIs('backend_edit_user_billings_plans') ) {
            $page = 'billings-palns';
        } elseif ( request()->routeIs('backend_edit_user_preferances') ) {
            $page = 'preferences';
        }

        $getResults = $this->userRepo->first($id);
        $editUser = $getResults['editUser'];
        $getRoles = $getResults['getRoles'];
        return view('backend.users.pages.'.$page, compact('editUser', 'getRoles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        //
        // Render page based on tabs
        if( request()->routeIs('backend_update_user_account') ) {
            $updateUserAccount = $this->userRepo->updateAccount($id, $request->all());
            if( $updateUserAccount ) {
                $status = "success";
                $msg = "User Account Updated successfully.";
            } else {
                $status = "error";
                $msg = "Oops! User Account not update.";
            }
        } elseif ( request()->routeIs('backend_update_user_security') ) {
            $updateUserSecurity = $this->userRepo->updateSecurity($id, $request->all());
            if( $updateUserSecurity ) {
                $status = "success";
                $msg = "User Security Updated successfully.";
            } else {
                $status = "error";
                $msg = "Oops! User Security not update.";
            }
        } elseif ( request()->routeIs('backend_update_user_billings_plans') ) {
            $page = 'billings-palns';
        } elseif ( request()->routeIs('backend_update_user_preferences') ) {
            $updateUserPreferance = $this->userRepo->updatePrafrence($id, $request->all());
            if( $updateUserPreferance ) {
                $status = "success";
                $msg = "User Preference Updated successfully.";
            } else{
                $status = "error";
                $msg = "Oops! User Preference not update.";
            }
        }

        return redirect()->back()->with($status, $msg);
    }

    /**
     * Suspend the specified resource from storage.
     */
    public function userSuspendRise(string $id)
    {
        //
        if( request()->routeIs('backend_suspend_user') )
        {
            $usrSuspendRise = $this->userRepo->suspendUser($id);
            $status = "success";
            $msg = "User Suspended successfully.";
        } elseif( request()->routeIs('backend_rise_user') ) {
            $usrSuspendRise = $this->userRepo->riseUser($id);
            $status = "success";
            $msg = "User Rise successfully.";
        }

        return redirect()->back()->with($status, $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $getResults = $this->userRepo->delete($id);

        if( $getResults ) {
            $status = "success";
            $msg = "User deleted successfully.";
        } else {
            $status = "error";
            $msg = "Oops! User not delete.";
        }

        return redirect()->route('backend_all_users')->with($status, $msg);
    }
}
