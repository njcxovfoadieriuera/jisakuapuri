<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Http\RedirectResponse;
use Auth;



class ScheduleController extends Controller
{
    public function calendar_register(Request $request)
    {
        // dd($request);
        $user = Auth::user();

        // バリデーション
        $request->validate([
            'start' => 'required',
            'end' => 'required',
            'title' => 'required|max:32',
        ]);
        
        // dd($validated);
        // 登録処理
        $schedule = new Schedule;
        // dd($schedule);
        // 日付に変換。JavaScriptのタイムスタンプはミリ秒なので秒に変換
        $schedule->start_date = $request->input('start');
        // dd($schedule);
        $schedule->end_date = $request->input('end');
        $schedule->event_name = $request->input('title');
        $schedule->created_at = date("Y-m-d H:i:s");
        $schedule->user_id = $user['id'];
        $schedule->save();

        //PHP側はJavaScriptに渡したい値
        $schedule_json = json_encode($schedule);
        // return redirect('/calendar');
        return response()->json([
        
            'schedule_id' => $schedule->id,
            'title' => $schedule->event_name,
            'start' => $schedule->start_date,
            'end' => $schedule->end_date,
        ]);
    }
    


    public function scheduleGet(Request $request)
    {
        $user = Auth::user();
        // カレンダー表示期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);
        // 登録処理
        return Schedule::query()
            ->select(
                // FullCalendarの形式に合わせる
                'id as schedule_id',
                'start_date as start',
                'end_date as end',
                'event_name as title'
            )
            // FullCalendarの表示範囲のみ表示
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date)
            ->where('user_id', $user['id'])
            ->get();
    }

    public function schedule_dell($eventId)
    {
        Schedule::destroy($eventId);
    }
}
