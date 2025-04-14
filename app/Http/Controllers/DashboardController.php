<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;

class DashboardController extends Controller
{
    //

    public function index(){



        $options = array(
            'page_title' => 'Dashboard',
            'menue_item' => 'Dashboard',
            'card_header' => 'Dashboard',
            );


        $data = array(
            'options' => $options,
        );
        return view('akkimDashboard', ["data" =>  $data]);
    }


    public function uderConstruction(){

        $options = array(
            'page_title' => 'Dashboard',
            'menue_item' => 'Dashboard',
        );

        $data = array(
            'options' => $options,
        );
        return view('underConstruction', ["data" =>  $data]);

    }

    public function markNotificationAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'تم وضع علامة على الإشعار كمقروء.');
    }

}
