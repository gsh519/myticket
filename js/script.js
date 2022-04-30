
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
    e.preventDefault();

    ticket_quiz.innerHTML += `<div class="ticketid-form__area ticketid-form__area--question">
                            <label for="subject">クイズ１</label>
                            <input type="text" id="subject" name="questions[0][subject]" class="ticket_id ticket_question_form" placeholder="悠斗の誕生日は？">

                            <label for="answer_list1">答え選択肢</label>
                            <input type="text" name="questions[0][answer_list1]" class="ticket_id ticket_question_form" placeholder="3月11日">
                            <input type="text" name="questions[0][answer_list2]" class="ticket_id ticket_question_form" placeholder="5月19日">
                            <input type="text" name="questions[0][answer_list3]" class="ticket_id ticket_question_form" placeholder="8月20日">

                            <label for="answer">答え</label>
                            <input type="text" id="answer" name="questions[0][answer]" class="ticket_id ticket_question_form" placeholder="5月19日">
                        </div>`;
})
