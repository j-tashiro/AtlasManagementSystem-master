// https://recooord.org/jquery-modal-window/
// 2023.07.09 予約をキャンセルをするための確認画面を追加
$(function(){
var open = $('.modal-open'),
    close = $('.modal-close'),
    btn = $('.modal-close-btn'),
    container = $('.modal-container');

    // 2023.07.15 モーダルを開く キャンセル時の値の受け渡し
    // jQueryメソッド→attr attr=属性 val text
    // textはviewに文字を表示させる valはhtmlのvalueと同じ意味 データ(情報)を送る
    // $(this)はopen.on('click', function()のopenを指している https://course.lull-inc.co.jp/curriculum/3230/
    // $(this)を$('.modal-open')でも表示はできるけど一番最初の変数しか表示されないので注意
    // 今回のカレンダーのような繰り返し似たようなものがでてくる時は$(this)を使う必要あり
    open.on('click', function(){
        container.addClass('active');
        var modal_reserve = $(this).attr('modal_reserve');
        var modal_part = $(this).attr('modal_part');
        var cancel_reserve = $(this).attr('cancel_reserve');
        var cancel_part = $(this).attr('cancel_part');
        //reserve=予約日 part=予約部
        $('.modal_layout_reserve span').text(modal_reserve);//日付が送れている
        $('.modal_layout_part span').text(modal_part);//リモ何部が送れている
        // $('.cancel_reserve').text(cancel_reserve);//nullになる
        $('.cancel_reserve').val(cancel_reserve);//2(数字が送れている)
        $('.cancel_part').val(cancel_part);//リモ何部が送れている
    });

    // 2023.07.09 モーダルを閉じる ×ボタンをクリックして閉じる
    close.on('click',function(){
        container.removeClass('active');
    });

    // 2023.07.09 モーダルを閉じる 閉じるボタンをクリックして閉じる
    btn.on('click',function(){
        container.removeClass('active');
    });

    // 2023.07.09 モーダルを閉じる モーダルの中身以外をクリックしたら閉じる チャットGPTの入れ知恵
    container.on('click', function(e) {
    if (!$(e.target).closest('.modal-body').length) {
        container.removeClass('active');
    }
    });

});



