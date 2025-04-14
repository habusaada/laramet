<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

use Session;

class RoleController extends Controller
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

        $roles = Role::all();

        if (!$roles) {
            abort(404);
        }


        $options = array(
            'page_title' => 'System Role List',
            'menue_item' => 'Sytstem Permession',
            'drop_menue_item' => 'Role Managment',
            'leave_menue_item' => 'System Roles List',
            'card_header' => 'System Roles List',
            );


        $data = array(
            'options' => $options,
            'roles'=>$roles,
        );
        return view('pages.role.index', ["data" =>  $data]);
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
                'page_title' => 'Add New Role',
                'menue_item' => 'Sytstem Permession',
                'drop_menue_item' => 'Role Managment',
                'leave_menue_item' => 'Add New Role',
                'card_header' => 'Add New Role',
                );


            $data = [
            'options' =>  $options
            ];

            return view('pages.role.create', ["data" =>  $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|unique:roles|max:255',
        ];

        $request->validate($rules);

        $role = new Role;

        $role->name = $request->name;
        $role->guard_name = 'web';

        $role->save();

        Session::flash('flash', [
            'title'   => 'Role Created',
            'message' => 'The user role has been created successfully.',
            'type'    => 'success', // success, error, info, warning
        ]);

        return  redirect()->route('role.show',$role->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {



        if(Auth::check() && !Auth::user()->hasRole('superAdmin'))
        {
            Session::flash('nopermission','عذراً ليس لديك الصلاحية للوصول إلى هذه الصفحة');
            return redirect()->back();
        }

        $role = Role::find($id);

        if (!$role) {
            abort(404);
        }

        $options = array(
            'page_title' => 'لوحة التحكم | تفاصيل دور المستخدم ',
            'menue_item' => 'إعدادات النظام',
            'drop_menue_item' => 'إدارة أدوار المستخدمين ',
            'leave_menue_item' => 'تفاصيل دور المستخدم',
            'card_header' => 'تفاصيل دور المستخدم',
        );

        $options = array(
            'page_title' => 'New Role - Show',
            'menue_item' => 'Sytstem Permession',
            'drop_menue_item' => 'Role Managment',
            'leave_menue_item' => 'Show New Role',
            'card_header' => 'Show New Role',
            );

        $data = array(
            'options' => $options,
            'role'=> $role
        );

        return view('pages.role.show', ["data" =>  $data]);
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

        $role = Role::find($id);

        $options = array(
            'page_title' => 'Edit Role',
            'menue_item' => 'Sytstem Permession',
            'drop_menue_item' => 'Role Managment',
            'leave_menue_item' => 'Edit Role',
            'card_header' => 'Edit Role',
            );


            $data = [
            'options' =>  $options,
            'role' => $role
            ];

            return view('pages.role.edit', ["data" =>  $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $rules = [
            'role_name' => 'required|string|max:255',
        ];

        $request->validate($rules);

        $role = Role::find($id);


        $role->name = $request->role_name;
        $role->guard_name = 'web';

        $role->save();

        Session::flash('flash', [
            'title' => 'Update Successful',
            'message' => 'User role has been updated successfully.',
            'type' => 'success', // success, error, warning, info
        ]);
        return  redirect()->route('role.show',$role->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        $protectedRoles = ['superAdmin'];
        if (in_array($role->name, $protectedRoles)) {
            Session::flash('flash', [
                'title'   => 'Protected Role',
                'message' => 'This role is protected and cannot be deleted.',
                'type'    => 'warning',
            ]);
            return redirect()->back();
        }

        if ($role->users()->exists()) {
            Session::flash('flash', [
                'title'   => 'Role In Use',
                'message' => 'You cannot delete this role because it is assigned to one or more users.',
                'type'    => 'warning',
            ]);
            return redirect()->back();
        }

        $role->delete();

        Session::flash('flash', [
            'title'   => 'Role Deleted',
            'message' => 'The role has been deleted successfully.',
            'type'    => 'success',
        ]);

        return redirect()->route('role.index');
    }
}
