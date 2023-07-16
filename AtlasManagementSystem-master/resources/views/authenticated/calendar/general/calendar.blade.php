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
<form action="{{ route('deleteParts') }}" method="POST" >
<div class="modal-container">
	<div class="modal-body">
		<!-- 閉じるボタン -->
		<div class="modal-close">×</div>
		<!-- モーダル内のコンテンツ -->
		<div class="modal-content">
      <div class="modal_layout_reserve">
        <!-- 2023.07.13 -->
        <p>予約日：</p>
        <span name="modal_day"></span>
        <input class="cancel_day" type="hidden" name="cancel_reserve" >
      </div>
        <div class="modal_layout_part">
          <p>時間：</p>
          <span name="modal_time"></span>
          <input class="cancel_day" type="hidden" name="cancel_part" >
        </div>
      <p>上記の予約をキャンセルしてもよろしいでしょうか？</p>
      <div class="modal_btn">
        <!-- modal-close-btnでクリックしたタイミングでモーダルが閉じる -->
        <div class="btn btn-primary modal-close-btn">閉じる</div>
        <!-- 2023.07.15 キャンセル機能 -->
        <input type="submit" class="btn btn-danger" value="キャンセルする">
      </div>
		</div>
	</div>
</div>
{{ csrf_field() }}
</form>




@endsection