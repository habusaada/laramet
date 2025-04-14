<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

use Session;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // if(Auth::check() && !Auth::user()->hasRole('superAdmin'))
        // {
        //     Session::flash('nopermission', 'Sorry, you do not have permission to access this page.');
        //     return redirect()->back();
        // }

        $users = User::with('roles')->get();
        // dd($users);

        if (!$users) {
            abort(404);
        }

        $options = array(
            'page_title' => 'User Role List',
            'menue_item' => 'Sytstem Permession',
            'drop_menue_item' => 'User Role Managment',
            'leave_menue_item' => 'User Role List',
            'card_header' => 'User Role List',
            );


        $data = array(
            'options' => $options,
            'users'=> $users
        );

        return view('pages.userrole.index', ["data" =>  $data]);
    }



    public function export_userroles()
    {
        // $currentDate = Carbon::now()->format('Y-m-d');
        // $fileName = "Products_{$currentDate}.xlsx";
        // return Excel::download(new ProductExport, $fileName);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // if(Auth::check() && !Auth::user()->hasRole('superAdmin'))
        // {
        //     Session::flash('nopermission', 'Sorry, you do not have permission to access this page.');
        //     return redirect()->back();
        // }

        $roles = Role::all();


        $users = User::all();

        $options = array(
            'page_title' => 'Assign User Role',
            'menue_item' => 'Sytstem Permession',
            'drop_menue_item' => 'User Role Managment',
            'leave_menue_item' => 'Assign User Role',
            'card_header' => 'Assign User Role',
            );

            $data = [
                'options' =>  $options,
                'roles' =>  $roles,
                'users' =>  $users,
            ];

            return view('pages.userrole.create', ["data" =>  $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = User::find($request->user);
        $roles = Role::whereIn('id',$request->role)->get()->pluck('name');

        // $role->syncPermissions($permissions);
        $user->syncRoles($roles);

        Session::flash('flash', [
                    'title' => 'Role Assignment Completed',
                    'message' => 'The role has been assigned successfully!',
                    'type' => 'success' // optional: for alert styling
                ]);
        return  redirect()->route('userrole.show',$user->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


        if(Auth::check() && !Auth::user()->hasRole('superAdmin'))
        {
            Session::flash('nopermission', 'Sorry, you do not have permission to access this page.');
            return redirect()->back();
        }

        $user = User::with('roles')->find($id);
        // dd($user);

        if (!$user) {
            abort(404);
        }

        $options = array(
            'page_title' => 'Assign User Role - Show',
            'menue_item' => 'Sytstem Permession',
            'drop_menue_item' => 'User Role Managment',
            'leave_menue_item' => 'Show User Role',
            'card_header' => 'Show User Role',
            );


        $data = array(
            'options' => $options,
            'user'=> $user
        );

        return view('pages.userrole.show', ["data" =>  $data]);
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
        $user = User::with('roles')->find($id);
        $roles = Role::all();

            $options = array(
                'page_title' => 'Assign User Role - Edit',
                'menue_item' => 'Sytstem Permession',
                'drop_menue_item' => 'User Role Managment',
                'leave_menue_item' => 'Edit User Role',
                'card_header' => 'Edit User Role',
                );

            $data = [
                'options' =>  $options,
                'user' =>  $user,
                'roles' =>  $roles,
            ];

            return view('pages.userrole.edit', ["data" =>  $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'role' => 'nullable|array',
                'role.*' => 'exists:roles,id',
            ]);

            // Find the user
            $user = User::findOrFail($request->user_id);

            // Get role names, or an empty array if none selected
            $roles = $request->filled('role')
                ? Role::whereIn('id', $request->role)->pluck('name')->toArray()
                : [];

            // Sync roles (detaches all if empty)
            $user->syncRoles($roles);

            Session::flash('flash', [
                'title' => 'Update Successful',
                'message' => 'User role has been updated successfully.',
                'type' => 'success', // success, error, warning, info
            ]);
        return  redirect()->route('userrole.show',$user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = User::findOrFail($id);

        // Optional: Prevent deletion of certain users (e.g., super admins or self)
        if (auth()->user()->id === $user->id || $user->hasRole('superAdmin')) {
            Session::flash('flash', [
                'title'   => 'Action Not Allowed',
                'message' => 'You cannot remove roles from this user.',
                'type'    => 'warning',
            ]);
            return redirect()->back();
        }

        // Detach all roles
        $user->syncRoles([]);

        Session::flash('flash', [
            'title'   => 'Roles Removed',
            'message' => 'All roles have been successfully removed from the user.',
            'type'    => 'success',
        ]);

        return redirect()->back();
    }
}
