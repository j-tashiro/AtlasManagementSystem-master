// https://recooord.org/jquery-modal-window/
// 2023.07.09 予約をキャンセルをするための確認画面を追加
$(function(){
var open = $('.modal-open'),
    close = $('.modal-close'),
    btn = $('.modal-close-btn'),
    container = $('.modal-container');

    // 2023.07.09 モーダルを開く
    open.on('click', function(){
        container.addClass('active');
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

    // 2023.07.10
    //キャンセル時の値の受け渡し
    var modal_day = $(this).attr('modal_day');
    var modal_time = $(this).attr('modal_time');
    var modal_id = $(this).attr('modal_id');
    $('.modal_layout span').val(modal_day);
    $('.modal_layout span').text(modal_time);
    $('.edit-modal-hidden').val(modal_id);
    return false;
});


