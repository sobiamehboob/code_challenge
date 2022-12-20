<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserConnection;
use App\Models\CommonConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * get all user data in $users, get send data in $sent_requests , get received data in $receive_requests AND get connection data in $connections.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $user_id = Auth::id();

        $users = User::where('id', '!=', $user_id)->doesntHave('user_connection1')->doesntHave('user_connection2')->paginate(10);

        $receive_requests = UserConnection::with('sender')->where('receiver_id', $user_id)->where('status', 1)->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->sender->name,
                'email' => $user->sender->email,
            ];
        });
        $sent_requests = UserConnection::with('receiver')->where('sender_id', $user_id)->where('status', 2)->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->receiver->name,
                'email' => $user->receiver->email,
            ];
        });
        $get_common_connection = [];

        $connections = UserConnection::with(['receiver', 'sender'])->Where('status', 3)->where('sender_id', $user_id)->orWhere('receiver_id', $user_id)->Where('status', 3)->get()->map(function ($user) {

            $common_connection = CommonConnection::with(['first_user', 'second_user', 'common_user'])->where('user1_id', Auth::id() || 'user2_id', Auth::id())->where('user1_id', $user->id || 'user2_id', $user->id)->first();
            if ($user->receiver->id == Auth::id()) {
                $user_id = $user->sender->id;
                $user_name = $user->sender->name;
                $email = $user->sender->email;
            }
            if ($user->sender->id == Auth::id()) {
                $user_id = $user->receiver->id;
                $user_name = $user->receiver->name;
                $email = $user->receiver->email;
            }
            $get_common_connection = [
                [
                    'id' => $common_connection->id,
                    'user_id' => $common_connection->common_user->id,
                    'name' => $common_connection->common_user->name,
                    'email' => $common_connection->common_user->email,
                ],
            ];
            return [
                'id' => $user->id,
                'user_id' => $user_id,
                'name' => $user_name,
                'email' => $email,
                'get_common_connection' => $get_common_connection,

            ];
        });
        return view('home', compact('users', 'sent_requests', 'receive_requests', 'connections'));
    }

}
