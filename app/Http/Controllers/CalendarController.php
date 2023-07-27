<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function calendar() {//コース名一覧機能
        return view('calendar');
    }
}
