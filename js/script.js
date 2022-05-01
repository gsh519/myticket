
// タブに対してクリックイベント
const tabs = document.getElementsByClassName('tab');
for (let i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener('click', tabSwitch, false);
};

// タブをクリックすると実行する関数
function tabSwitch() {
    // タブのclassの値を変更
    document.getElementsByClassName('is-active')[0].classList.remove('is-active');
    this.classList.add('is-active');

    // コンテンツのclassの値を変更
    document.getElementsByClassName('is-show')[0].classList.remove('is-show');
    const arrayTabs = Array.prototype.slice.call(tabs);
    const index = arrayTabs.indexOf(this);
    document.getElementsByClassName('ticket-area')[index].classList.add('is-show');
};

// クイズを追加ボタンを押したときの処理
const plusBtn = document.getElementById('js_plus');
const ticket_quiz = document.getElementById('js_ticket-quiz');
plusBtn.addEventListener('click', function (e) {
    // フォームのデフォルト機能削除
    e.preventDefault();

    let quiz_forms = document.getElementsByClassName('ticketid-form__area--question');
    let index = quiz_forms.length;

    let content = `<div class="ticketid-form__area ticketid-form__area--question">
                            <label for="subject">クイズ${index + 1}</label>
                            <input type="text" id="subject" name="questions[${index}][subject]" class="ticket_id ticket_question_form" placeholder="悠斗の誕生日は？">

                            <label for="answer_list1">答え選択肢</label>
                            <input type="text" name="questions[${index}][answer_list1]" class="ticket_id ticket_question_form" placeholder="3月11日">
                            <input type="text" name="questions[${index}][answer_list2]" class="ticket_id ticket_question_form" placeholder="5月19日">
                            <input type="text" name="questions[${index}][answer_list3]" class="ticket_id ticket_question_form" placeholder="8月20日">

                            <label for="answer">答え</label>
                            <input type="text" id="answer" name="questions[${index}][answer]" class="ticket_id ticket_question_form" placeholder="5月19日">
                        </div>`;

    ticket_quiz.insertAdjacentHTML('beforeend', content);

    // クイズの入力フォームが2つ以上あったら
    // 一番最後の入力フォームの後に要素削除ボタンを設置
    if (quiz_forms.length > 1 && 3 > quiz_forms.length) {
        console.log(quiz_forms.length);
        console.log(quiz_forms[index]);
        let last_quiz_forms = quiz_forms[index];
        const minus_btn = `<div class="btn-inner">
                            <button class="plus-btn" id="js_minus"><i class="fas fa-plus"></i>クイズを削除</button>
                            </div>`
        last_quiz_forms.insertAdjacentHTML('beforeend', minus_btn);
    } else if (quiz_forms.length > 2) {
        let current_minus_btn = document.getElementById('js_minus');
        console.log(current_minus_btn);
        current_minus_btn.remove();

        let last_quiz_forms = quiz_forms[index];
        const new_minus_btn = `<div class="btn-inner">
                            <button class="plus-btn" id="js_minus"><i class="fas fa-plus"></i>クイズを削除</button>
                            </div>`
        last_quiz_forms.insertAdjacentHTML('beforeend', new_minus_btn);
    }
})

// クイズ削除ボタンを押したとき
// let quiz_forms = document.getElementsByClassName('ticketid-form__area--question');
// console.log(quiz_forms);
// if (quiz_forms.length > 2) {
//     const minus_btn = document.getElementById('js_minus');
//     console.log(minus_btn);
// }

// minusBtn.addEventListener('click', function (e) {
//     e.preventDefault();
//     last_quiz_forms.remove();
// })

// プレビュー画像を表示
const preview_img = document.getElementById('preview_img');
const ticket_img = document.getElementById('ticket_img');
ticket_img.addEventListener('change', function (e) {
    let reader = new FileReader();
    reader.onload = function (e) {
        preview_img.setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
});
