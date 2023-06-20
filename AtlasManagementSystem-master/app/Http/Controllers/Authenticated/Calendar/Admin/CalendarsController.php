<?php

namespace App\Http\Controllers\Authenticated\Calendar\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\Admin\CalendarView;
use App\Calendars\Admin\CalendarSettingView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    // 2023.06.18 スクール予約確認 表示
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.admin.calendar', compact('calendar'));
    }

    // 2023.06.16
    //  ($user_id = 0, $date , $part )
    // →($user_id = 0, $date = 0, $part = 0)
    // = 0,を$dateと$partに格納(代入)することで起動している
    // reserveDetail=予約詳細
    public function reserveDetail($user_id = 0, $date = 0, $part = 0){
        $reservePersons = ReserveSettings::with('users')->where('setting_reserve', $date)->where('setting_part', $part)->get();
        return view('authenticated.calendar.admin.reserve_detail', compact('reservePersons', 'date', 'part'));
    }

    // 予約設定を表示するメソッド
    public function reserveSettings(){
        $calendar = new CalendarSettingView(time());
        return view('authenticated.calendar.admin.reserve_setting', compact('calendar'));
    }

    // 予約設定の更新メソッド
    public function updateSettings(Request $request){
        $reserveDays = $request->input('reserve_day');
        foreach($reserveDays as $day => $parts){
            foreach($parts as $part => $frame){
                ReserveSettings::updateOrCreate([
                    'setting_reserve' => $day,
                    'setting_part' => $part,
                ],[
                    'setting_reserve' => $day,
                    'setting_part' => $part,
                    'limit_users' => $frame,
                ]);
            }
        }
        return redirect()->route('calendar.admin.setting', ['user_id' => Auth::id()]);
    }
}