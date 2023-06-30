<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Chapters;
use App\Models\Articles;
use App\Models\Folder;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;




use Auth;



class FoldersController extends Controller{
  public function folder_register(Folder $F, Request $request) {//グループ化
    $user = Auth::user();
    $input =$request->all();
    // dd($input);
 
    $rule = [
      'folder_name' => 'required | max:100',
    ];

    $messages = [ 
        "required" => "必須入力です",  
        "max" => "100文字以内入力です",  
    ];
    $validator = Validator::make($input, $rule,$messages);

    if ($validator->fails()) {
        return redirect()->route('favorite_like')
        ->withErrors($validator)
        ->withInput();           
    }

    foreach ($input['chkbx'] as $favorite_id){
      $folder = new Folder();//saveするたびに毎回インスタンス化しなければいけない
      $folder->user_id = $user['id'];
      $folder->title = $request->input('folder_name');
      $folder->favorite_id = $favorite_id;
      $folder->created_at = date("Y-m-d H:i:s");
      $folder->save();


      $record_Favorite = Favorite::findOrFail($favorite_id);  // レコードを取得
         // 更新したいカラムの値を上書き
      $record_Favorite->folder = '1';
      $record_Favorite->save();  // レコードを保存



    }  
    return redirect()->route('favorite_like');
  }






  public function folder_lift(Request $request) {//グループ化の解除
    $user = Auth::user();
    $input =$request->all();
    // dd($input);

    if (isset($input['chkbx_folder'])){
      // dd($input['chkbx_folder']);
      foreach ($input['chkbx_folder'] as $dele_folder){//お気に入りフォルダの消去
      $folder = new Folder();
      Folder::where('title',$dele_folder)
            ->where('user_id', $user['id'])
            ->delete();//特定のidのレコード削除
      }

      $records = Folder::where('user_id', $user['id'])->get();//ユーザーidからフォルダidを取り出す処理
      //ここの下がおかしい
      $kari12 = Favorite::where('user_id', $user['id'])->get('id');
      foreach ($kari12 as $kari13){//お気に入りフォルダの消去
        // $Favorite_reset = new Folder();
        $record_Favorite_reset = Favorite::findOrFail($kari13['id']);//一旦自分のお気に入りを全て0表示にする
        $record_Favorite_reset->folder = '0';
        $record_Favorite_reset->save();
      }

      foreach ($records as $record){//フォルダidからお気に入りidを取得して表示を1にする
        $record_Favorite = Favorite::findOrFail($record['favorite_id']);  // レコードを取得
          // 更新したいカラムの値を上書き
        $record_Favorite->folder = '1';
        $record_Favorite->save();
      }
    }
    return redirect()->route('favorite_like');
  }

  public function folder_delete(Request $request) {//お気に入りの削除
    $user = Auth::user();
    $input =$request->all();
    // dd($input);

    if (isset($input['chkbx_folder'])){
      // dd($input['chkbx_folder']);
      foreach ($input['chkbx_folder'] as $dele_folder){//お気に入りフォルダの消去
      $folder = new Folder();
      $kari15[] = Folder::where('title',$dele_folder)
            ->where('user_id', $user['id'])
            ->get();//特定のidの取得
      Folder::where('title',$dele_folder)
            ->where('user_id', $user['id'])
            ->delete();//特定のidのレコード削除
      }
      foreach ($kari15[0] as $kari16){//以下お気に入りフォルダの中のお気に入り単数削除
        $karis16[]= $kari16['favorite_id'];
      }
      foreach ($karis16 as $kari17){
        Favorite::where('id',$kari17)
            ->where('user_id', $user['id'])
            ->delete();//特定のidのレコード削除
      }
      // dd($karis16);
    }

    if (isset($input['chkbx'])){
      // dd($input['chkbx']);
      foreach ($input['chkbx'] as $dele_favorite){//お気に入りの消去
      $favorite = new Favorite();
      Favorite::where('id',$dele_favorite)
            ->where('user_id', $user['id'])
            ->delete();//特定のidのレコード削除
      }
    }
    // dd($input);

    return redirect()->route('favorite_like');
  }

  public function folder_delete_dep(Request $request) {//お気に入りの削除 深部
    $user = Auth::user();
    $input =$request->all();
    dd($input);

    // if (isset($input['chkbx_folder'])){
    //   // dd($input['chkbx_folder']);
    //   foreach ($input['chkbx_folder'] as $dele_folder){//お気に入りフォルダの消去
    //   $folder = new Folder();
    //   Folder::where('title',$dele_folder)
    //         ->where('user_id', $user['id'])
    //         ->delete();//特定のidのレコード削除
    //   }
    // }

    if (isset($input['chkbx'])){
      // dd($input['chkbx']);
      
      foreach ($input['chkbx'] as $kari14 => $dele_favorites){//お気に入りの消去
      $favo = new Favorite();
      $folder [] = Favorite::where('chapter_id',$dele_favorites)
              ->where('user_id', $user['id'])
              ->get();
              $folder_ids [] = $folder[$kari14][0]['id']; 
      }

      foreach ($input['chkbx'] as $dele_favorite){//お気に入りの消去
        $favorite = new Favorite();
        Favorite::where('chapter_id',$dele_favorite)
              ->where('user_id', $user['id'])
              ->delete();//特定のidのレコード削除
      }

      foreach ($folder_ids as $folder_id){//お気に入りの消去
      $fol =new Folder();
      Folder::where('favorite_id',$folder_id)
            ->where('user_id', $user['id'])
            ->delete();//特定のidのレコード削除
      }
    }

    return redirect()->route('favorite_like');//,['folder_title' => $input['folder_title']]
  }

  public function folder_lift_dep(Request $request) {//グループ化の解除
    // if (isset($input['chkbx'])){
    $user = Auth::user();
    $inputs =$request->all();
      // dd($inputs);
      if (isset($inputs['chkbx'])){
        // dd($inputs);
        foreach ($inputs['chkbx'] as $C => $input){//フォルダーからお気に入りに戻す
        $records [] =Favorite::where('chapter_id',$input)
                ->where('user_id', $user['id'])
                ->get();
            $record = Favorite::findOrFail($records[$C][0]['id']);
            $record->folder = '0';
            $record->save();

            $record_folder = Folder::where('favorite_id',$records[$C][0]['id'])
                                    ->where('user_id', $user['id'])
                                    ->delete();

            
        }
      }
    return redirect()->route('favorite_like');
  
  }

}
