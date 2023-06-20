<?php
namespace App\Calendars\Admin;

use Carbon\Carbon;
use App\Models\Calendars\ReserveSettings;

class CalendarWeekDay{
  protected $carbon;


  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  // strtolower() 関数による文字列の小文字化
  function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));
  }

  // <p>タグで囲ってHTML化してる
  function render(){
    return '<p class="day">' . $this->carbon->format("j") . '日</p>';
  }

  // 年（4桁）-月（2桁）-日（2桁）の形式の文字列に変化させる
  function everyDay(){
    return $this->carbon->format("Y-m-d");
  }

  // 指定された日付に対して1部、2部、3部の予約設定があるかどうかを確認し、部のラベルを含んだHTML文字列を返す。
  function dayPartCounts($ymd){
    $html = [];
    $one_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();
    $two_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();
    $three_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();

    $html[] = '<div class="text-left">';
    if($one_part){
      $html[] = '<p class="day_part m-0 pt-1">1部</p>';
    }
    if($two_part){
      $html[] = '<p class="day_part m-0 pt-1">2部</p>';
    }
    if($three_part){
      $html[] = '<p class="day_part m-0 pt-1">3部</p>';
    }
    $html[] = '</div>';

    return implode("", $html);
  }

  // 指定された日付の1部の予約可能な枠数を取得し、もしあればその数値を、なければデフォルトの数値 "20" を返す
  function onePartFrame($day){
    $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first();
    if($one_part_frame){
      $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first()->limit_users;
    }else{
      $one_part_frame = "20";
    }
    return $one_part_frame;
  }
  // 指定された日付の2部の予約可能な枠数を取得し、もしあればその数値を、なければデフォルトの数値 "20" を返す
  function twoPartFrame($day){
    $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first();
    if($two_part_frame){
      $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first()->limit_users;
    }else{
      $two_part_frame = "20";
    }
    return $two_part_frame;
  }
  // 指定された日付の3部の予約可能な枠数を取得し、もしあればその数値を、なければデフォルトの数値 "20" を返す
  function threePartFrame($day){
    $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first();
    if($three_part_frame){
      $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first()->limit_users;
    }else{
      $three_part_frame = "20";
    }
    return $three_part_frame;
  }

  // 日付の調整項目を含むHTMLコードを生成する
  function dayNumberAdjustment(){
    $html = [];
    $html[] = '<div class="adjust-area">';
    $html[] = '<p class="d-flex m-0 p-0">1部<input class="w-25" style="height:20px;" name="1" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">2部<input class="w-25" style="height:20px;" name="2" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">3部<input class="w-25" style="height:20px;" name="3" type="text" form="reserveSetting"></p>';
    $html[] = '</div>';
    return implode('', $html);
  }
}