const check = document.getElementById('check-btn');
const answer = document.getElementById('answer-area');

check.addEventListener('click', function () {
    console.log('good');
    answer.classList.toggle('active');
});
