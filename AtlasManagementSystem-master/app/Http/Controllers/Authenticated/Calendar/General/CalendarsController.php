<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    // 2023.06.18 スクール予約  表示
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    // 2023.06.18.スクール予約ページの予約機能
    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;//$getPartが何部かを格納している
            $getDate = $request->getData;//$getDateが日付を格納している
            $reserveDays = array_filter(array_combine($getDate, $getPart));//予約日と予約部を紐づけしている 配列で格納してる
            foreach($reserveDays as $key => $value){

                $reserve_settings = ReserveSettings::where('setting_reserve', $key)//setting_reserveカラムが$key（予約日）と一致し、
                ->where('setting_part', $value)//setting_partカラムが$value（予約部）と一致する
                ->first();//最初のレコードを取得

                $reserve_settings->decrement('limit_users');//ReserveSettingsモデルと繋がってるテーブルのlimit_usersカラムをdecrementで減らしている つまり予約数を1減らし残り何人予約枠があいてるか調整してるところ
                $reserve_settings->users()->attach(Auth::id());//->users()は中間テーブル リレーション 予約に必要な情報はusersテーブルのidとreserve_settingsテーブルのid
            }//attachはざっくり言うと登録するby一色講師
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    // 2023.07.15 キャンセル機能
    public function delete(Request $request)
    {
        $cancel_reserve = $request->input('cancel_reserve');
        $cancel_part = $request->input('cancel_part');
        DB::beginTransaction();
        try {
            // 予約設定の予約可能数を増やす
            $reserve_cancel = ReserveSettings::where('setting_reserve', $cancel_reserve)
            ->where('setting_part', $cancel_part)
            ->first();
            $reserve_cancel->increment('limit_users');//ReserveSettingsモデルと繋がってるテーブルのlimit_usersカラムをincrementで増やしている つまり予約数を1増やし残り何人予約枠があいてるか調整してるとこ
            $reserve_cancel->users()->detach(Auth::id());// 関連するユーザーを予約から削除

            DB::commit();

            // キャンセル処理成功後のリダイレクトなどの適切な処理を追加する
            return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
        } catch (\Exception $e) {
            DB::rollback();

            // キャンセル処理が失敗した場合のエラーハンドリングや適切な処理を追加する
            return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
        }
    }

}