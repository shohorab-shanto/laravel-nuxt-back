<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Module;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $roles = Role::withCount('users')->get();
        $roles = Role::latest();

        $roles = $roles->paginate($request->get('rows', 10));

        return response()->json(['data'=>$roles]);
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
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        try {
            $role = Role::create(['name' => $request->input('name')]);
        } catch (\Throwable $th) {
            return message($th->getMessage(), 400);
        }

        return message('Role created successfully', 200, $role);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role->load('permissions');

        return RoleResource::make($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->name == 'Admin')
            return message("You can't delete Admin role", 400);

        if ($role->delete())
            return message('Role archived successfully');

        return message('Something went wrong', 400);
    }


    public function getPermission()
    {
        $modules = Module::with('permissions')->get();

        return response()->json($modules);
    }


    public function updatePermission(Request $request, Role $role)
    {

        // $role->givePermissionTo($request->permission_id);
        // return message('Permission Assigned Successfully');
        $role->revokePermissionTo($request->permission_id);
        return message('Permission Revoked Successfully');

        // if ($request->attach) {
        //     $role->givePermissionTo($request->permission_id);
        // } else {
        //     $role->revokePermissionTo($request->permission_id);
        //     return message('Permission Revoked Successfully');
        // }

        // return message('something wrong',403);




    }
}
