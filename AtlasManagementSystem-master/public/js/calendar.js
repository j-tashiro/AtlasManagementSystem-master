// https://recooord.org/jquery-modal-window/
// 2023.07.09 予約をキャンセルをするための確認画面を追加
$(function(){
var open = $('.modal-open'),
    close = $('.modal-close'),
    btn = $('.modal-close-btn'),
    container = $('.modal-container');

    open.on('click', function(){
        container.addClass('active');
    });

    close.on('click',function(){
        container.removeClass('active');
    });

    btn.on('click',function(){
        container.removeClass('active');
    });

    container.on('click', function(e) {
    if (!$(e.target).closest('.modal-body').length) {
        container.removeClass('active');
    }
    });
});





