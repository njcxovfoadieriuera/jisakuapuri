<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Articles;
use App\Models\Chapters;
use App\Models\Notices;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Folder;
use App\Models\User;
use Doctrine\DBAL\Schema\Schema;



use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Redirect;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function top() {//コース名一覧機能
        $user = Auth::user();
        $all = Articles::all();
        $genres = Genre::orderBy('id', 'asc')->get();
    
        return view('top',['role' => $user['role'],'all'=>$all,'genres'=>$genres]);
    }

    public function Course_Name(Articles $A,Request $request) {//コース名登録機能
        $input =$request->all();
        $rule = [
            'Course_Name' => 'required | max:20',
        ];

        $messages = [ 
            "required" => "必須入力です",  
            "max" => "20文字以内入力です",  
            // "digits_between" => "10桁または11桁で入力してください",  
            // "email" => "メールアドレスを正しく入力してください", 
            // "unique" =>"登録済みのメールアドレスです" ,
            // "string" => "文字を入力してください",  
            // "numeric" => "数字を入力してください",  
            // "strip_tags" => "入力できない文字が含まれています",  
        ];
        $validator = Validator::make($input, $rule,$messages);

        if ($validator->fails()) {
            return redirect('top')
                ->withErrors($validator)
                ->withInput();
        }

        $inputs =[
            '_token' =>$request->input('_token'),
            'title' =>$request->input('Course_Name'),
            'created_at' =>date("Y-m-d H:i:s")
        ];
        session()->put('vali', $input);
        $A->fill($inputs)->save();     
        return redirect()->route('top');
    }

    public function genre(Genre $G,Request $request) {//ジャンル追加機能
        $input =$request->all();
        // dd($input);
        $rule = [
            'genre' => 'required | max:20',
        ];

        $messages = [ 
            "required" => "必須入力です",  
            "max" => "20文字以内入力です",  
            // "digits_between" => "10桁または11桁で入力してください",  
            // "email" => "メールアドレスを正しく入力してください", 
            // "unique" =>"登録済みのメールアドレスです" ,
            // "string" => "文字を入力してください",  
            // "numeric" => "数字を入力してください",  
            // "strip_tags" => "入力できない文字が含まれています",  
        ];
        $validator = Validator::make($input, $rule,$messages);

        if ($validator->fails()) {
            return redirect('top')
                ->withErrors($validator)
                ->withInput();
        }

        $record_id = Genre::where('name', $input['genre'])->first();

        if (is_null($record_id)){
            $inputs =[
                '_token' =>$request->input('_token'),
                'name' =>$request->input('genre'),
                'created_at' =>date("Y-m-d H:i:s")
            ];
            session()->put('vali', $input);
            $G->fill($inputs)->save();  
        }   

        return redirect()->route('top');
    }

    public function genre_sort($id, Request $request) {//コース名一覧機能(ソート後)
        $input =$request->all();
        $user = Auth::user();
        $genres = Genre::orderByRaw("id = $id DESC")->get(['id', 'name']);

        if($id == 1){
        $all = Articles::all();
        }else{
        $all = Articles::where('genre_id', $id)->get();
        }
        return view('top',['role' => $user['role'],'all'=>$all,'genres'=>$genres]);
    }

    public function top_create($id){//コース名押下後の画面遷移分岐
        $user = Auth::user();//管理者判断
        $record = Articles::find($id);//特定のidのレコード取得
        $genres = Genre::orderBy('id', 'asc')->get();

        if($user['role'] == 1){
            //コース概要製作ページに遷移
            return view('top_create', ['record' => $record,'genres' => $genres]);//特定のidのレコードをビューに送る
        }elseif($user['role'] == 0){
            //選択したコースの概要を表示させる
            return view('overview', ['record' => $record]);
        }
    }

    public function top_cre(Request $request) {//コースの概要作成機能
        $input =$request->all();
        $rule = [
            'body' => 'required | max:5000',
            'genre_id' => 'regex:/^(?!1$).*/',
        ];

        $messages = [ 
            "required" => "必須入力です",  
            "regex" => "ジャンルを選択してください",
            "max" => "5000文字以内入力です",  
        ];
        $reco = Articles::find($input['record_id']);  // レコードを取得//いらない？
        $validator = Validator::make($input, $rule,$messages);

        if ($validator->fails()) {
            return redirect()->route('top_create',['id'=>$input['record_id']])
            ->withErrors($validator)
            ->withInput();           
        }

        $record = Articles::findOrFail($input['record_id']);  
        // 更新したいカラムの値を上書き
        $record->body = $input['body'];
        $record->genre_id = $input['genre_id'];
        $record->updated_at = date("Y-m-d H:i:s");
        $record->save();  // レコードを保存
        return redirect()->route('top');
    }

    public function top_change(Request $request) {//コース名変更機能
        $input =$request->all();
        $rule = [
            'change' => 'between:1,20',
            'radio' => 'required',
        ];

        $messages = [ 
            "required" => "変更するコースを選択してください",   
            "between" => "20文字以内で入力してください", 
        ];
        $validator = Validator::make($input, $rule,$messages);
        if ($validator->fails()) {
            return redirect()->route('top')
                ->withErrors($validator)
                ->withInput();           
        }
        $record = Articles::findOrFail($input['radio']);  // レコードを取得
         // 更新したいカラムの値を上書き
        $record->title = $input['change'];
        $record->save();  // レコードを保存

        return redirect()->route('top');
    }

    public function top_delete($id) {//コース削除機能
        $user = Auth::user();//管理者判断

        $chapters_records = Chapters::where('articles_id', $id)->get();//チャプターレコード取得
        foreach ($chapters_records as $chapters_record){//
            $chapters_ids[] = $chapters_record['id'];//チャプターid取得
        }

        // dd($chapters_ids);

        if (isset($chapters_ids)){
            foreach ($chapters_ids as $count1 => $chapters_id){//
                $favorites_records[] = Favorite::where('chapter_id', $chapters_id)->get();//お気に入りレコード取得
                if (isset($favorites_records[$count1][0]['id'])){
                    $favorites_ids[] = $favorites_records[$count1][0]['id'];//お気に入りのid取得
                    $favorites_folders = Favorite::where('chapter_id', $chapters_id)
                                            ->where('folder', 1)
                                            ->get();

                    if (!$favorites_folders->isEmpty()) {
                    $favorites_folder_ids[] = $favorites_folders[0]['id'];
                    }
                }
            }
        }
  
        if (isset($favorites_folder_ids)){
            foreach ($favorites_folder_ids as $count2 => $favorites_folder_id){//
                $folders_records[] = Folder::where('favorite_id', $favorites_folder_id)->get();//folderレコード取得
                $folders_ids[] = $folders_records[$count2][0]['id'];//お気に入りのid取得
            }
        }

        // dd($id);//記事id(主キー)
        // dd($chapters_ids);記事idを持っているチャプターid(主キー)
        // dd($favorites_ids);//チャプターidを持っているお気に入りid(主キー)
        // dd($folders_ids);//お気に入りidを持っているフォルダーid(主キー)

        Articles::destroy($id);//特定のidのレコード削除

        if (isset($chapters_ids)){
            foreach ($chapters_ids as $chapters_ids_dele){
                Chapters::destroy($chapters_ids_dele);
            }
        }
        
        if (isset($favorites_ids)){
            foreach ($favorites_ids as $favorites_ids_dele){//
                Favorite::destroy($favorites_ids_dele);
            }
        }
        
        if (isset($folders_ids)){
            foreach ($folders_ids as $folders_ids_dele){//
                Folder::destroy($folders_ids_dele);
            }
        }
        
        return redirect()->route('top');
    }

    public function select_chapter($id) {//select_chapterに移動(記事idが必要)
        $record = Articles::find($id);
        $title = $record->title;
        $all = Chapters::where('articles_id', $id)->get();
        $user = Auth::user();
        return view('select_chapter',['id' => $id,'title'=> $title,'role' => $user['role'],'all'=>$all]);//idは使わない？
    }

    public function chapter_Name(Chapters $C,Request $request,$id) {//チャプター名登録機能
        $input =$request->all();
        $input['articles_id'] = $id;
            
        $rule = [
            'chapter_Name' => 'required | max:20',
        ];

        $messages = [ 
            "required" => "必須入力です",   
            "max" => "20文字以内入力です",
        ];
        $validator = Validator::make($input, $rule,$messages);

        if ($validator->fails()) {
            return redirect()->route('select_chapter',['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $inputs =[
            '_token' =>$request->input('_token'),
            'title' =>$request->input('chapter_Name'),
            'articles_id' =>$input['articles_id'],
            'created_at' =>date("Y-m-d H:i:s")
        ];
        session()->put('vali', $input);
        $C->fill($inputs)->save();      
        return redirect()->route('select_chapter',['id' => $id]);
    }

    public function Chapter_production($id) {//チャプター名押下後の画面遷移分岐
        $user = Auth::user();//管理者判断
        $record = Chapters::find($id);
        if($user['role'] == 1){//管理者なら
            //チャプター選択からチャプター製作へ
            $title = $record->title;
            $articles_id = $record->articles_id;
            $body = $record->body;       
            return view('Chapter_production',['id' => $id,'title'=> $title,'articles_id'=> $articles_id,'body' => $body]);
        }elseif($user['role'] == 0){
            //チャプター中身表示
            $all = Articles::where('id', $record['articles_id'])->get();
            $title = $all->first()->title;
            //お気に入りにされているか調べる
            $record_id = Favorite::where('user_id', $user['id'])//where句でuser_idとchapter_idがかつで結ばれている
                                ->where('chapter_id', $record['id'])
                                ->first();

            return view('Chapter_details', ['record' => $record,'title' => $title,'favorite'=>$record_id] );
        }
    }
    
    public function chap_pro(Request $request) {//チャプターの概要作成機能
        $input =$request->all();
        $rule = [
            'body' => 'required | max:5000',
        ];

        $messages = [ 
            "required" => "必須入力です", 
            "max" => "500文字以内入力です", 
        ];
        $reco = Chapters::find($input['chapter_id']);  // レコードを取得
        $validator = Validator::make($input, $rule,$messages);
        
        if ($validator->fails()) {
            return redirect()->route('Chapter_production',['id' => $reco['id']])
                ->withErrors($validator)
                ->withInput();           
        }
        
        $record = Chapters::findOrFail($input['chapter_id']);  
        // 更新したいカラムの値を上書き
        $record->body = $input['body'];
        $record->updated_at = date("Y-m-d H:i:s");

        $record->save();  // レコードを保存
        return redirect()->route('select_chapter',['id'=>$record['articles_id']]);
    }

    
    public function sele_chap_delete($id) {//チャプター削除機能
        
        $record = Chapters::find($id);
        $art_id = $record->articles_id;
        // dd($art_id);

        $favorites_records[] = Favorite::where('chapter_id', $id)->get();//お気に入りレコード取得
        $favorites_ids[] = $favorites_records[0];
        foreach($favorites_ids[0] as $favorites_id){
            $favorite_ids[] = $favorites_id['id'];//お気に入りのid取得
        }
        $favorites_folders[] = Favorite::where('chapter_id', $id)
                                       ->where('folder', 1)
                                       ->get();

        foreach($favorites_folders[0] as $favorites_id){
            $favorites_folder_ids[] =  $favorites_id['id'];
        }
        
        if (isset($favorites_folder_ids)){
            foreach ($favorites_folder_ids as $count2 => $favorites_folder_id){//
                $folders_records[] = Folder::where('favorite_id', $favorites_folder_id)->get();//folderレコード取得
                $folders_ids[] = $folders_records[$count2][0]['id'];//お気に入りのid取得
            }

        }

        // dd($id);記事idを持っているチャプターid(主キー)
        // dd($favorite_ids);//チャプターidを持っているお気に入りid(主キー)
        // dd($folders_ids);//お気に入りidを持っているフォルダーid(主キー)

        Chapters::destroy($id);
        
        if (isset($favorite_ids)){
            foreach ($favorite_ids as $favorites_ids_dele){//
                Favorite::destroy($favorites_ids_dele);
            }
        }
        
        if (isset($folders_ids)){
            foreach ($folders_ids as $folders_ids_dele){//
                Folder::destroy($folders_ids_dele);
            }
        }
        
        return redirect()->route('select_chapter',['id'=>$art_id]);
    }

    public function sele_change(Request $request,$id) {//チャプター名変更機能
        $input =$request->all();
        $rule = [
            'change' => 'between:1,20',
            'radio' => 'required',
        ];

        $messages = [ 
            "required" => "変更するコースを選択してください",   
            "between" => "20文字以内で入力してください", 
        ];      
        $validator = Validator::make($input, $rule,$messages);
        if ($validator->fails()) {
            return redirect()->route('select_chapter',['id'=>$id,])
                ->withErrors($validator)
                ->withInput();
        }
        $record = Chapters::findOrFail($input['radio']);  // レコードを取得
         // 更新したいカラムの値を上書き
        $record->title = $input['change'];
        $record->save();  // レコードを保存
        return redirect()->route('select_chapter',['id'=>$id]);
    }
    
    public function notice(){//お知らせに遷移する
        $user = Auth::user();//管理者判断
        $all = Notices::all();
        return view('notice', ['all'=>$all,'role' => $user['role']]);
    }

    public function news_Name(Notices $N,Request $request) {//お知らせ名登録機能
        $input =$request->all();      
        $rule = [
            'news_Name' => 'required | max:20',
        ];

        $messages = [ 
            "required" => "必須入力です",  
            "max" => "20文字以内入力です",   
        ];
        $validator = Validator::make($input, $rule,$messages);
        if ($validator->fails()) {
            return redirect()->route('notice')
                ->withErrors($validator)
                ->withInput();
        }

        $inputs =[
            '_token' =>$request->input('_token'),
            'title' =>$request->input('news_Name'),
            'created_at' =>date("Y-m-d H:i:s")
        ];
        session()->put('vali', $input);
        $N->fill($inputs)->save();
        return redirect()->route('notice');
    }


    public function not_create($id){//お知らせ名押下後の遷移先分岐
        $user = Auth::user();//管理者判断
        $record = Notices::find($id);//特定のidのレコード取得
        if($user['role'] == 1){
            //お知らせ内容製作ページに遷移
            return view('notice_Deep', ['record' => $record]);//特定のidのレコードをビューに送る
        }elseif($user['role'] == 0){
            //選択したお知らせを表示させる
            return view('notice_detail', ['record' => $record]);
        }
    }

    public function not_delete($id) {//お知らせ削除機能
        Notices::destroy($id);//特定のidのレコード削除
        return redirect()->route('notice');
    }

    public function not_change(Request $request) {//お知らせ名変更機能
        $input =$request->all();
        $rule = [
            'change' => 'between:1,20',
            'radio' => 'required',
        ];

        $messages = [ 
            "required" => "変更するコースを選択してください",   
            "between" => "20文字以内で入力してください", 
        ];
        $validator = Validator::make($input, $rule,$messages);
        if ($validator->fails()) {
            return redirect()->route('notice')
                ->withErrors($validator)
                ->withInput();           
        }
        
        $record = Notices::findOrFail($input['radio']);  // レコードを取得
         // 更新したいカラムの値を上書き
        $record->title = $input['change'];
        $record->save();  // レコードを保存
        return redirect()->route('notice');
    }

    public function not_deep(Request $request) {//チャプターの概要作成機能
        $input =$request->all();
        // dd($input);
        $rule = [
            'body' => 'required | max:500',
        ];

        $messages = [ 
            "required" => "必須入力です", 
            "max" => "500文字以内入力です", 
        ];
        $reco = Notices::find($input['record_id']);  // レコードを取得
        $validator = Validator::make($input, $rule,$messages);
        
        if ($validator->fails()) {
            return redirect()->route('not_create',['id' => $reco['id']])
                ->withErrors($validator)
                ->withInput();           
        }
        
        $record = Notices::findOrFail($input['record_id']);  
        // 更新したいカラムの値を上書き
        $record->body = $input['body'];
        $record->updated_at = date("Y-m-d H:i:s");

        $record->save();  // レコードを保存
        return redirect()->route('notice');
    }

    public function user_list() {//ユーザー一覧機能
        $user = Auth::user();
        $users = User::all();

        // dd($users[0]['created_at']);

    

        // dd($users);
        return view('user_list',['role' => $user['role'],'users'=>$users]);
    }

    public function user_dele($id){//ユーザー削除機能
        // dd($id);
        User::destroy($id);
        return redirect()->route('user_list');

    }

    public function csv(Request $request) {//csv出力 
        $request->validate([
            'csv_name' => 'required|string|max:30',
        ]);

        $users = User::all();
        // テーブル名を取得
        $tableName = with(new User)->getTable();
        // テーブルのカラム名を取得
        $columns = \DB::getSchemaBuilder()->getColumnListing($tableName);
        // ファイルを開く
        $file = fopen('C:\xampp\htdocs\7-1\storage\\'.$request["csv_name"].'.csv', 'w');
        // 1行ずつ配列の内容をファイルに書き込む

        // $userData = [
        //     $columns[0],
        //     $columns[1],
        //     $columns[2],
        //     $columns[6],
        //     $columns[8],
        // ];
        $userData = [
            "ID",
            "名前",
            "Eメール",
            "登録日",
            "権限",
        ];
        fputcsv($file, $userData);

        foreach ($users as $user) {
            $createdAt = Carbon::parse($user['created_at']); // Carbonオブジェクトに変換
            $dateOnly = $createdAt->format('Y/m/d'); // 日付部分のみを取得
            $roleLabel = ($user['role'] == 0) ? 'ユーザー' : '管理者'; // ロールに応じて表示する文字列を決定

            $userData = [
                $user['id'],
                $user['name'],
                $user['email'], 
                $dateOnly, 
                $roleLabel,
            ];
            fputcsv($file, $userData);
        }
        // ファイルを閉じる
        fclose($file);
        return redirect()->route('user_list');
    }
}

