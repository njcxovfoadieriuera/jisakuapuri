<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsertestController extends Controller
{
    public function User_test() {//コース名一覧機能
        // $user = Auth::user();
        // $all = Articles::all();
        // $genres = Genre::orderBy('id', 'asc')->get();

        
    
        return view('User_test');
    }

    public function test_end(Request $request) {//コース名一覧機能
        $kari_answers =["answer1" ,"answer2"];
        $inputs =$request->all();
        // dd($inputs);
        foreach($inputs as $input){

            $answer[] = $input;
        }
        // dd($answer);
        $count=0;
        foreach($kari_answers as $c => $kari_answer){
            if(isset($answer[$c+1]) && $kari_answer === $answer[$c+1]){
                ++$count;
            }
        }
        $kari_answers_count = count($kari_answers);
        // dd($kari_answers_count);//2が入ってる
        // dd($count);//2が入ってる
        $point = $count/$kari_answers_count*100;
        // dd($point);//点数が入ってる

        
        $user = Auth::user();
        return view('test_end',['point' => $point,'role' => $user['role']]);
    }

    public function Grades() {//コース名一覧機能
        // $user = Auth::user();
        // $all = Articles::all();
        // $genres = Genre::orderBy('id', 'asc')->get();

        
    
        return view('Grades');
    }


    
}
