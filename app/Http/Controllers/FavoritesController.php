<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Chapters;
use App\Models\Articles;
use App\Models\Folder;


use Auth;



class FavoritesController extends Controller
{
    public function favorite(Favorite $F,$id) {//良いね機能（お気に入り）
        //$idにはチャプターの番号が入ってるよ
        $user = Auth::user();
        $record = Chapters::find($id);

        $record_id = Favorite::where('user_id', $user['id'])//where句でuser_idとchapter_idがかつで結ばれている
                                ->where('chapter_id', $record['id'])
                                ->first();

        if (is_null($record_id)){
            //登録処理
            $inputs =[
                'user_id' =>$user['id'],
                'chapter_id' =>$record['id'],
                'created_at' =>date("Y-m-d H:i:s")
            ];
            $F->fill($inputs)->save(); 
            return json_encode('登録されました');
        }else{
            //消去処理
            Favorite::destroy($record_id['id']);//特定のidのレコード削除
            return  json_encode('削除されました');
        }
    }

    public function favorite_like() {//お気に入りの表示　一覧
        
        $article_titles = [];
        $chapter_titles = [];
        $chapter_bodys = [];
        $favorite_ids = [];
        $resultArray = [];
        $Folder_title2 = [];
        $user = Auth::user();//ログイン情報からユーザーidを取り出す処理
        //上が共通
        $Folders = Folder::where('user_id', $user['id'])->get();//ユーザーidからFolderの一覧取得
        // $Folders_title = Folder::where('user_id', $user['id'])->distinct()->select('title')->get();//ユーザーid指定してからの重複無でフォルダー名を取得
        $Folders_titles2 = Folder::where('user_id', $user['id'])->groupBy('title')->get('title');//ユーザーid指定してからのフォルダーtitleをグループ化してグループ化した全てのフォルダー名を取得
        foreach ($Folders_titles2 as $Folders_title2){//フォルダー名を配列に
            $Folder_title2[] = $Folders_title2['title'];
        }

        foreach ($Folder_title2 as $key => $record_Folder_title2){
            $karis[$key] = Folder::where('user_id', $user['id'])//where句でuser_idとchapter_idがかつで結ばれている
                                 ->where('title', $record_Folder_title2)
                                 ->get('favorite_id');
        }
        // dd($karis);//ログインしているユーザーの全てのお気に入りレコードがある
        // dd($karis[0]);//一つ目のお気に入りのレコードが全てある（変化するのはここ）
        // dd($karis[0][0]);//一つ目のお気に入りの一つ目のレコードがある（変化するのはここ）
        // dd($karis[0][0]['favorite_id']);//一つ目のお気に入りの一つ目のお気に入りidがある
        //最終的には一つのお気に入りのお気に入りidを取得後、お気に入りタイトルを取得する
        //viewに送るのはお気に入りタイトル（一個）とチャプタータイトル（複数）
        //上をお気に入りの数だけやりたい
        // dd($karis);//タイトル
        

        if (isset($karis)){//お気に入りフォルダがあれば
            foreach ($karis as $a => $kari1){
                // $kari6[] = $karis[$a];
                foreach ($karis[$a] as $b => $kari2){
                    $chap = Favorite::where('id', $karis[$a][$b]['favorite_id'])->first('chapter_id');//
                    $chap_id[] = $chap['chapter_id'];
                    $kari5[$a][] = $karis[$a][$b]['favorite_id'];
                    $kari8[] = $karis[$a][$b]['favorite_id'];
                }
            }

            foreach ($chap_id as $c => $kari7){
                $chap_record = Chapters::where('id', $chap_id[$c])->first('title');//
                $chap_titles[] = $chap_record['title'];//チャプタータイトル
            }

            $folder_array = array_combine($Folder_title2, $kari5);//←二つをまとめる

            $value = array_combine($kari8, $chap_titles);//←二つをまとめる
            
            foreach ($folder_array as &$values) {//$valueを$folder_arrayに代入
                foreach ($values as $index => $val) {
                    if (isset($value[$val])) {
                        $values[$index] = $value[$val];
                    }
                }
            }
        }

        //ここから上がお気に入りフォルダ関係

        //ここから下がお気に入り（単数）関係
        $records = Favorite::where('user_id', $user['id'])
                           ->where('folder', '0')
                           ->get();//ユーザーidからお気に入りidを取り出す処理

        foreach ($records as $count => $record){//お気に入りidからチャプターidを取り出す処理
            $favorite_ids[] = $record['id'];//id（フォルダ化された以外のfavorite_idを取得）
            $kari14[] =$record['chapter_id'];//chapter_id所持
            $chapters = Chapters::whereIn('id', $kari14)->get();//チャプターのレコード取得
            $kari13[]=$chapters[$count]['articles_id'];//articles_id所持   
        }
        foreach ($chapters as $count2 => $chapter){//チャプターレコードから記事idを取り出す処理
            $chapter_titles[] = $chapter['title'];//チャプターのタイトル取得
            $chapter_bodys[] = $chapter['body'];//チャプターのbody取得
            $articles = Articles::where('id', $kari13[$count2])->get();
            $kari12[]=$articles;
            foreach ($articles as $article){//記事idから記事タイトルを取り出す処理
                $article_titles[] = $article['title'];
            }
        }
        
        // dd($chapter_titles);


        foreach ($favorite_ids as $key => $favorite_id){//配列をまとめる処理と配列の値にキーをつける処理
            $resultArray[] = ['favorite_id' => $favorite_id,'article_title' => $article_titles[$key],'chapter_title' => $chapter_titles[$key],'chapter_body' => $chapter_bodys[$key],];        
        }

        $favorite_records = array_combine($favorite_ids, $resultArray);//配列にキーをつける処理
        // dd($resultArray);
        if (isset($karis)){//お気に入りフォルダがあれば
            return view('favorite_like', ['favorite_records' => $favorite_records,'folder_array' => $folder_array]);
        }
        return view('favorite_like', ['favorite_records' => $favorite_records]);

    }

    public function favorite_depths(Request $request) {//お気に入りの表示　深部
        $input =$request->all();
        $user = Auth::user();//ログイン情報からユーザーidを取り出す処理

        // dd($input);


        

        $records_folders = Folder::where('user_id', $user['id'])//フォルダタイトルとユーザーidでお気に入りid取得
                           ->where('title', $input['folder_title'])
                           ->get();//ユーザーidからお気に入りidを取り出す処理
                           
        foreach ($records_folders as $records_folder){//お気に入りidからチャプターidを取り出す処理
        $folder_ids[] = $records_folder['favorite_id'];
        $favorites[] = Favorite::where('id', $records_folder['favorite_id'])->get();
            foreach ($favorites as $kari11 => $record){//お気に入りidからチャプターidを取り出す処理
                $favorite_ids[] = $favorites[$kari11][0]['chapter_id'];//なんか要素一つ増えてるけど保留で

                $chapters = Chapters::where('id', $favorites[$kari11][0]['chapter_id'])->get();
                foreach ($chapters as $chapter){//チャプターidから記事idを取り出す処理
                    $chapter_titles[] = $chapter['title'];
                    $chapter_bodys[] = $chapter['body'];
                    $articles = Articles::where('id', $chapter['articles_id'])->get();
                    foreach ($articles as $article){//記事idから記事タイトルを取り出す処理
                        $article_titles[] = $article['title'];
                    }
                }
            }
        }

        // dd($records_folders);
        if (isset($favorite_ids[1])) {
            // キー1の要素が存在する場合の処理
            unset($favorite_ids[0]);//キーの0番消します
            unset($chapter_titles[0]);//キーの0番消します
            unset($chapter_bodys[0]);//キーの0番消します
            unset($article_titles[0]);//キーの0番消します
        } 
        
        $response_favorite_ids = array_merge( $favorite_ids ) ;//インデックス番号振り直し
        $response_chapter_titles = array_merge( $chapter_titles ) ;//インデックス番号振り直し
        $response_chapter_bodys = array_merge( $chapter_bodys ) ;//インデックス番号振り直し
        $response_article_titles = array_merge( $article_titles ) ;//インデックス番号振り直し

        foreach ($response_favorite_ids as $key => $favorite_id){//配列をまとめる処理と配列の値にキーをつける処理
            $resultArray[] = ['favorite_id' => $favorite_id,'article_title' => $response_article_titles[$key],'chapter_title' => $response_chapter_titles[$key],'chapter_body' => $response_chapter_bodys[$key],'folder_title' => $records_folders[0]['title']];        
        }
        
        // dd($resultArray);
        return view('favorite_depths', ['resultArray' => $resultArray]);
    }

    
}
