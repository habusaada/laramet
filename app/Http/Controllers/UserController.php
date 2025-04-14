<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('profile')->get();

        if (!$users) {
            abort(404);
        }

        $options = array(
            'page_title' => 'Users List',
            'menue_item' => 'Users List',
            'drop_menue_item' => 'Users Management',
            'leave_menue_item' => 'Users List',
            'card_header' => 'Users Lists',
        );

        $data = array(
            'options' => $options,
        );
        return view('pages.user.index', ["data" =>  $data]);
    }

    public function export_seasons()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $fileName = "Seasons_{$currentDate}.xlsx";
        return Excel::download(new UsersExport, $fileName);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

        $user = User::with('roles')->find($id);

        if (!$user) {
            abort(404);
        }

        $options = array(
            'page_title' => 'User - Show',
            'menue_item' => 'Users Managment',
            'drop_menue_item' => 'Users Managment',
            'leave_menue_item' => 'Show User',
            'card_header' => 'Show User',
            );


        $data = array(
            'options' => $options,
            'user'=> $user
        );

        return view('pages.user.show', ["data" =>  $data]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        if(Auth::check() && !Auth::user()->hasRole('superAdmin') && $id == 1)
        {
            Session::flash('flash', [
                'title' => 'Access Denied',
                'message' => 'Sorry, you do not have permission to access this page!',
                'type' => 'info' // optional: for alert styling
            ]);
            return redirect()->back();
        }

        if( $id == 1)
        {
            Session::flash('flash', [
                'title'   => 'Protected User',
                'message' => 'This user is protected and cannot be edit.',
                'type' => 'warning' // optional: for alert styling
            ]);
            return redirect()->back();
        }
        $user  = User::find($id);

        $options = array(
            'page_title' => 'Edit User',
            'menue_item' => 'Users Managment',
            'drop_menue_item' => 'Users List',
            'leave_menue_item' => 'Edit User',
            'card_header' => 'User Details',
            );


            $data = [
            'options' =>  $options,
            'user' => $user
            ];

            return view('pages.user.edit', ["data" =>  $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name'         => 'required|string|max:255',
            'bio'               => 'nullable|string',
            'phone_number'      => 'required|string|max:20',
            'company_name'      => 'required|string|max:255',
            'company_location'  => 'required|string|max:255',
            'job_title'         => 'required|string|max:255',
            'date_of_birth'     => 'required|date',
            'gender'            => 'required|in:male,female,other',
            'address'           => 'required|string|max:255',
        ];

        $request->validate($rules);

        $user = User::find($id);


        $user->name = $request->name;
        $user->profile->bio = $request->bio;
        $user->profile->phone_number = $request->phone_number;
        $user->profile->company_name = $request->company_name;
        $user->profile->company_location = $request->company_location;
        $user->profile->job_title = $request->job_title;
        $user->profile->date_of_birth = $request->date_of_birth;
        $user->profile->gender = $request->gender;
        $user->profile->address = $request->address;

        $user->save();

        Session::flash('flash', [
            'title' => 'Update Successful',
            'message' => 'User has been updated successfully.',
            'type' => 'success', // success, error, warning, info
        ]);
        return  redirect()->route('user.show',$user->id);
    }


    public function toggleStatus(Request $request, $id)
    {
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);
        $user->profile->is_active = $request->is_active;
        $user->profile->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting the main user (e.g. ID 1)
        if (Auth::check() && $user->id == 1) {
            Session::flash('flash', [
                'title' => 'Action Blocked',
                'message' => 'You are not allowed to delete this user.',
                'type' => 'danger',
            ]);
            return redirect()->back();
        }

        // Only allow superAdmin to delete
        if (Auth::check() && !Auth::user()->hasRole('superAdmin')) {
            Session::flash('flash', [
                'title' => 'Unauthorized',
                'message' => 'You are not authorized to delete users.',
                'type' => 'info',
            ]);
            return redirect()->back();
        }

        $user->delete();

        Session::flash('flash', [
            'title' => 'User Deleted',
            'message' => 'The user has been deleted successfully.',
            'type' => 'success',
        ]);

        return redirect()->route('user.index');
    }
}
