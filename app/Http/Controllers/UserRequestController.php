<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\UserConnection;

class UserRequestController extends Controller
{
     /**
     * user send request.
     *
     */

    public function send_request(Request $request)
    {
        try {
            $user_id = Auth::id();
            $user = UserConnection::create([
                'receiver_id' => $request->id,
                'sender_id' => $user_id,
                'status' => 2,
            ]);
            session()->flash('message', "request send Successfully");
        } catch (QueryException $ex) {
            session()->flash('error', $ex->getMessage());
        }

        return redirect('/home');
    }

    /**
     * user cancle send request, user cancle received request, accept receive request and remove connection.
     *
     */

    public function cancle_request_connection_or_accept_request(Request $request)
    {
        try {
            $user_id = Auth::id();
            // if user delete send request
            if ($request->value == 'delete_sent_request') {
                UserConnection::where('sender_id', $user_id)->where('receiver_id', $request->id)->where('status', 2)->delete();
                session()->flash('message', "send request Successfully deleted");
            }
            // if user delete recieve request
            if ($request->value == 'delete_receive_request') {
                UserConnection::where('receiver_id', $user_id)->where('sender_id', $request->id)->where('status', 1)->delete();
                session()->flash('message', "received request Successfully deleted");
            }
            // if user accept recieve request
            if ($request->value == 'accept_receive_request') {
                $user = UserConnection::where('id', $request->id)->update([
                    'status' => 3
                ]);
                session()->flash('message', "Successfully accepted request");
            }
            // if user remove connection
            else {

                UserConnection::where('id', $request->id)->where('status', 3)->delete();
                session()->flash('message', "connection removed Successfully");
            }
        } catch (QueryException $ex) {
            session()->flash('error', $ex->getMessage());
        }
        return redirect('/home');
    }
}
