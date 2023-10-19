<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Service\RoleService;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->baseService = new RoleService;
    }
    public function index(){
        $role = $this->baseService->Index();
        $columns = Role::$columns;
        if (request()->ajax()) {
            return $role;
        }
        return view('pages.role.index', compact('columns'));

    }
}
