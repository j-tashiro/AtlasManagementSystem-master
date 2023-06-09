@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

    <!-- Calendar.View.phpのgetTitleメソッドと連動している -->
      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        <!-- Calendar.View.phpのrenderメソッドと連動している -->
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>


<!-- 予約をキャンセルをするための確認画面を追加 -->
<!-- モーダル本体 -->
<div class="modal-container">
	<div class="modal-body">
		<!-- 閉じるボタン -->
		<div class="modal-close">×</div>
		<!-- モーダル内のコンテンツ -->
		<div class="modal-content">
      <div class="modal_layout">
        <!-- 2023.07.10 -->
        <p>予約日：</p>
        <span name="modal_day">jsが上手くいってれば表示されるはず</span>
      </div>
        <div class="modal_layout">
          <p>時間：</p>
          <span name="modal_time">jsが上手くいってれば表示されるはず</span>
        </div>
      <p>上記の予約をキャンセルしてもよろしいでしょうか？</p>
      <div class="modal_btn">
        <button  class="btn btn-primary modal-close-btn">閉じる</button>
        <button  class="btn btn-danger">キャンセルする</button>
      </div>
		</div>
	</div>
</div>




@endsection