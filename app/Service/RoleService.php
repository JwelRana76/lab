<?php

namespace App\Service;

use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleService extends Service
{
  protected $model = Role::class;

  public function Index()
  {
    $role = $this->model::all();

    return DataTables::of($role)
      ->addColumn('action', fn ($item) => view('pages.role.action', compact('item'))->render())
      ->make(true);
  }
}
