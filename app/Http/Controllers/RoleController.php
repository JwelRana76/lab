<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Role;
use App\Service\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->baseService = new RoleService;
    }
    public function index(){
        if (!userHasPermission('role-index')) {
            return view('not_permitted');
        }
        $role = $this->baseService->Index();
        $columns = Role::$columns;
        if (request()->ajax()) {
            return $role;
        }
        return view('pages.role.index', compact('columns'));
    }
    function permission($id)
    {
        $groups = PermissionGroup::all();
        $role = Role::findOrFail($id);
        return view('pages.role.role_permission', compact('groups', 'role'));
    }
    function permission_store(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $this->baseService->setPermission($request->all(), $id);
        return redirect()->route('role.permission', $id);
    }
}
