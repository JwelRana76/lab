<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Service\UserService;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->baseService = new UserService;
    }
    public function index()
    {
        $user = $this->baseService->index();
        $columns = User::$columns;
        if (request()->ajax()) {
            return $user;
        }
        $roles = Role::get();
        return view('pages.user.index', compact('columns','roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'password' => 'required|min:6',
            'conform_password' => 'required|same:password',
            'role_id' => 'required',
        ]);
        DB::beginTransaction();
        try {
            if($request->user_id){
                $user_data['name'] = $request->name;
                $user_data['username'] = $request->username;
                if($request->password){
                    $user_data['password'] = Hash::make($request->password);
                }
                $user = User::findOrFail($request->user_id)->update($user_data);

                $user->role->update([
                    'role_id' => $request->role_id
                ]);
            }else{
                $user = User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                ]);
                $user->role()->create([
                    'role_id' => $request->role_id,
                ]);
            }
            DB::commit();
            return redirect()->route('user.index')->with('success', 'User Added Successfully');
        } catch (Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
    function edit($id)
    {
        $data = User::findOrFail($id);
        $columns = User::$columns;
        $roles = Role::get();
        return view('pages.user.index', compact('columns','roles'));
    }
    public function update(Request $request, $id)
    {
        User::findOrFail($request->update_id)->fill([
            'name' => $request->name,
            'role_id' => $request->role_id,
        ])->save();
        return redirect()->route('user.index')->with('success', 'User Updated Successfully');
    }
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
    }

    public function assign_role($id){
        
    }
}
