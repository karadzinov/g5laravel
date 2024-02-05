<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MyEvent;
use Pusher\Pusher;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public  function welcome()
    {
        return view('welcome');
    }

    public function error()
    {
        return view('error');
    }

    public function message(Request $request)
    {
        $user = auth()->user();
        $message = $request->get('message');
        /*
         *
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            array('cluster' => env('PUSHER_APP_CLUSTER'))
        );

        $pusher->trigger('my-channel', 'my-event', array('message' => $message));
        */
        event(new MyEvent($message, $user));
    }
}
