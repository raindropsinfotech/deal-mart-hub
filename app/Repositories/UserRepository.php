<?php

namespace App\Repositories;

use App\Repositories\Interfaces\Backend\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Preferences;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Get all Users from Database
     *
     * @return array: of Users and Roles
     */
    public function all()
    {
        $users = User::with('roles')->whereHas("roles", function($q){ $q->where("id",'!=', 1); })->withTrashed()->orderBy('id', 'desc')->get();
        $getRoles = Role::where("id",'!=', 1)->orderBy('name', 'desc')->get();

        $results = [
            'users' => $users,
            'getRoles' => $getRoles,
        ];

        return $results;
    }

    /**
     * Create new User
     *
     * @return void
     */
    public function store(array $data)
    {
        $userArr = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ];

        $userRole = $data['role'];
        $user = User::create($data);
        $user->assignRole([$userRole]);

        return $user;
    }

    /**
     * Find User
     *
     * @return void
     */
    public function first(int $id)
    {
        $editUser = User::with(['roles', 'preferences'])->where('id',$id)->withTrashed()->firstOrFail();

        if( auth()->user()->roles[0]->id == 1 ) {
            $getRoles = Role::orderBy('name', 'desc')->get();
        } else {
            $getRoles = Role::where("id",'!=', 1)->orderBy('name', 'desc')->get();
        }

        $results = [
            'editUser' => $editUser,
            'getRoles' => $getRoles
        ];

        return $results;
    }

    /**
     * Update the User
     *
     * @return void
     */
    public function update(int $id, array $data)
    {


    }

    /**
     * Update the Account of User
     *
     * @return void
     */
    public function updateAccount(int $id, array $data)
    {
        $updateAccount = User::where('id',$id)->withTrashed()->firstOrFail();

        $role = $data['role'];
        $updateAccount->name = $data['name'];
        $updateAccount->email = $data['email'];

        $updateAccount->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $updateAccount->assignRole($role);

        return $updateAccount;
    }

    /**
     * Update the Security of User
     *
     * @return void
     */
    public function updateSecurity(int $id, array $data)
    {
        $updateSecurity = User::where('id',$id)->withTrashed()->firstOrFail();

        $password = $data['password'];

        if( !empty($password) ) {
            $updateSecurity->password =  Hash::make($password);
            $updateSecurity->save();
        }

        return $updateSecurity;
    }

    /**
     * Update the Preference of User
     *
     * @return void
     */
    public function updatePrafrence(int $id, array $data)
    {
        $getPrafrence = User::with('preferences')->where('id',$id)->withTrashed()->firstOrFail();

        if( !empty($getPrafrence->preferences) ) {

            $getPrafrence->preferences->birthday = $data['birthday'];
            $getPrafrence->preferences->age_group = $data['age_group'];
            $getPrafrence->preferences->gender_identity = $data['gender_identity'];

            $response = $getPrafrence->preferences->save();

        } else {

            $preferenceArr = [
                'birthday' => $data['birthday'],
                'age_group' => $data['age_group'],
                'gender_identity' => $data['gender_identity'],
                'user_id' => $id,
            ];

            $response = Preferences::create($preferenceArr);

        }

        return $response;
    }

    /**
     * Suspend User
     *
     * @return void
     */
    public function suspendUser(int $id)
    {
        $suspendUsr = User::where('id',$id)->delete();

        return $suspendUsr;
    }

    /**
     * Suspend User
     *
     * @return void
     */
    public function riseUser(int $id)
    {
        $riseUsr = User::where('id', $id)->withTrashed()->restore();

        return $riseUsr;
    }

    /**
     * Destroy/Delete Main Category by Id
     *
     * @return void
     */
    public function delete(int $id)
    {
        $deleteUser = User::where('id', $id)->forceDelete();

        return $deleteUser;
    }
}