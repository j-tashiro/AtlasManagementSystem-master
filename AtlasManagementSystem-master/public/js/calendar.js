$(function(){

});






// 2023.06.25 予約をキャンセルをするための確認画面を追加
//要素を取得 let=変数 const=定数
const modal = document.querySelector('.js-modal'),
    open = document.querySelector('.js-modal-open'),
    close = document.querySelector('.js-modal-close');

//「開くボタン」をクリックしてモーダルを開く
function modalOpen() {
    modal.classList.add('is-active');
}
open.addEventListener('click', modalOpen);

//「閉じるボタン」をクリックしてモーダルを閉じる
function modalClose() {
    modal.classList.remove('is-active');
}
close.addEventListener('click', modalClose);

//「モーダルの外側」をクリックしてモーダルを閉じる
function modalOut(e) {
    if (e.target == modal) {
    modal.classList.remove('is-active');
    }
}
addEventListener('click', modalOut);








