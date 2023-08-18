<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

use Auth;

class ChatController extends Controller
{
    public function chats() {//チャットに遷移一般
        $user = Auth::user();
        $history= Chat::where('user_id', $user->id)->get();
        $users['id']=1;
        // dd($history);
        return view('chat',['talks' => $history,'user'=>$users]);
    }

    public function chats_admin($id) {//チャットに遷移管理者
        // dd($id);
        $users = User::find($id);
        $history= Chat::where('partner',$id)
                        ->orWhere('user_id', $id)
                        ->orderBy('created_at', 'asc')
                        ->get();
        return view('chat',['talks' => $history,'user' => $users]);
    }

    public function chat(Request $request,Chat $chat,$id) {//チャット機能
        $user = Auth::user();
        $input =$request->all();
        $request->validate([
            'talk' => 'required | max:100',
        ]);

        $chat->user_id = $user->id;
        $chat->body = $request->input('talk');
        $chat->created_at = date("Y-m-d H:i:s");

        if($user['role']==0){
            $chat->partner = 1;
        }else{
            $chat->partner = $id;
        }
        $chat->save();

        if($user['role']==0){
            return redirect()->route('chats');
        }else{
            return redirect()->route('chats_admin',['id'=>$id]);
        }
    }


    public function chats_admin_fetch($id) {//チャット管理者
        $users = User::find($id);
        $history= Chat::where('partner',$id)
                        ->orWhere('user_id', $id)
                        ->orderBy('created_at', 'asc')
                        ->get();
        // return view('chat',['talks' => $history,'user' => $users]);
        // return json_encode('登録されました');
        return response()->json(['talks' => $history,'user' => $users]);
        // echo json_encode($history);
    }

}
