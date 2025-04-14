<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth::check() && !Auth::user()->hasRole('superAdmin'))
        {
            Session::flash('flash', [
                'title' => 'Access Denied',
                'message' => 'Sorry, you do not have permission to access this page!',
                'type' => 'info' // optional: for alert styling
            ]);
            return redirect()->back();
        }

        $permissions = Permission::all();
        // dd($mentors);
        if (!$permissions) {
            abort(404);
        }


        // dd($mediaItems);

        $options = array(
            'page_title' => 'Role Pesmessions List',
            'menue_item' => 'Sytstem Permessions',
            'drop_menue_item' => 'Permessions Setup',
            'leave_menue_item' => 'Role Pesmessions List',
            'card_header' => 'Role Pesmessions List',
            );

        $data = array(
            'options' => $options,
            'permissions'=>$permissions,
        );
        return view('pages.permission.index', ["data" =>  $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if(Auth::check() && !Auth::user()->hasRole('superAdmin'))
        {
            Session::flash('flash', [
                'title' => 'Access Denied',
                'message' => 'Sorry, you do not have permission to access this page!',
                'type' => 'info' // optional: for alert styling
            ]);
            return redirect()->back();
        }


            $options = array(
                'page_title' => 'Assign Permission Role',
                'menue_item' => 'Sytstem Permession',
                'drop_menue_item' => 'Pemissions Setup',
                'leave_menue_item' => 'Assign Permission Role',
                'card_header' => 'Assign Permission Role',
                );
            $data = [
            'options' =>  $options
            ];

            return view('pages.permission.create', ["data" =>  $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->permission_name);

        $rules = [
            'name' => 'required|string|unique:permissions|max:255',
        ];

        $request->validate($rules);

        $permission = new Permission;

        $permission->name = $request->name;
        $permission->guard_name = 'web';

        $permission->save();

        Session::flash('flash', [
            'title' => 'Permission Assignment Completed',
            'message' => 'The permission has been assigned successfully!',
            'type' => 'success' // optional: for alert styling
        ]);

        return  redirect()->route('permission.show',$permission->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        if(Auth::check() && !Auth::user()->hasRole('superAdmin'))
        {
            Session::flash('flash', [
                'title' => 'Access Denied',
                'message' => 'Sorry, you do not have permission to access this page!',
                'type' => 'info' // optional: for alert styling
            ]);
            return redirect()->back();
        }

        $permission = Permission::find($id);

        if (!$permission) {
            abort(404);
        }

        $options = array(
            'page_title' => 'لوحة التحكم | تفاصيل صلاحيات دور المستخدم ',
            'menue_item' => 'إعدادات النظام',
            'drop_menue_item' => 'إدارة صلاحيات أدوار المستخدمين',
            'leave_menue_item' => 'تفاصيل صلاحية دور مستخدم',
            'card_header' => 'تفاصيل صلاحية دور مستخدم',
        );

            $options = array(
                'page_title' => 'Assign Permission Role - Show',
                'menue_item' => 'Sytstem Permession',
                'drop_menue_item' => 'Permession Setup',
                'leave_menue_item' => 'Show Permission Role',
                'card_header' => 'Show Permission Role',
                );

        $data = array(
            'options' => $options,
            'permission'=> $permission
        );

        return view('pages.permission.show', ["data" =>  $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Auth::check() && !Auth::user()->hasRole('superAdmin'))
        {
            Session::flash('flash', [
                'title' => 'Access Denied',
                'message' => 'Sorry, you do not have permission to access this page!',
                'type' => 'info' // optional: for alert styling
            ]);
            return redirect()->back();
        }

        $permission = Permission::find($id);

            $options = array(
                'page_title' => 'Assign User Role - Edit',
                'menue_item' => 'Sytstem Permession',
                'drop_menue_item' => 'User Role Managment',
                'leave_menue_item' => 'Edit User Role',
                'card_header' => 'Edit User Role',
                );

            $data = [
                'options' =>  $options,
                'permission' =>  $permission,
            ];

            return view('pages.permission.edit', ["data" =>  $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $rules = [
            'name' => 'required|string|max:255',
        ];

        $request->validate($rules);

        $permission = Permission::find($id);


        $permission->name = $request->name;
        $permission->guard_name = 'web';

        $permission->save();

        Session::flash('flash', [
            'title' => 'Update Successful',
            'message' => 'Permission role has been updated successfully.',
            'type' => 'success', // success, error, warning, info
        ]);
        return  redirect()->route('permission.show',$permission->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        // Ensure user is authenticated and has proper role
        if (!Auth::check() || !Auth::user()->hasRole('superAdmin')) {
            Session::flash('flash', [
                'title' => 'Access Denied',
                'message' => 'Sorry, you do not have permission to access this page!',
                'type' => 'info' // optional: for alert styling
            ]);
            return redirect()->back();
        }

        $permission = Permission::find($id);

        if (!$permission) {
            Session::flash('error', 'Permission not found.');

            Session::flash('flash', [
                'title' => 'Error',
                'message' => 'Permission not found.',
                'type' => 'error'
            ]);
            return redirect()->route('permission.index');
        }

            $protectedPermissions = [
                'show dashobard',
                'view userDash',
                'create user',
                'edit user',
                'show user',
                'index user',
                'delete user',
            ];

            if (in_array($permission->name, $protectedPermissions)) {
                Session::flash('flash', [
                    'title' => 'Action Blocked',
                    'message' => 'This permission is protected and cannot be deleted.',
                    'type' => 'warning'
                ]);
                return redirect()->route('permission.index');
            }

        $permission->delete();

        Session::flash('flash', [
            'title' => 'Permission Deleted',
            'message' => 'Permission deleted successfully.',
            'type' => 'success'
        ]);

        return redirect()->route('permission.index');
    }
}
