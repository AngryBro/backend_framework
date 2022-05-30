var RAW_JSON = JSON.parse(document.getElementById('json').getAttribute('content'));
var USER = RAW_JSON.user;
var KIM = RAW_JSON.kim;
var RESULT = RAW_JSON.result;
document.getElementById('json').remove();

function trigger_correct_ans() {
    var button = document.getElementById('trigger');
    var correct_answers;
    for(var i in RESULT) {
        correct_answers = document.getElementById('correct_answer'+i);
        correct_answers.hidden = !correct_answers.hidden;
    }
    correct_answers = document.getElementById('correct_answers');
    correct_answers.hidden = !correct_answers.hidden;
    button.innerHTML = (correct_answers.hidden?'Показать':'Скрыть')+' верные ответы';
}
function unparser(str) {
    str = str.split('|').join('<br>');
    return str;
}
function build() {
    var header = document.getElementById('header');
    header.innerHTML = 'Результаты пользователя '+USER+' по тесту '+KIM;
    var table = document.getElementById('table');
    for(var i in RESULT) {
        table.innerHTML += `
            <tr>
                <th>`+i+`</th>
                <td class="`+(RESULT[i].correct?`correct`:`wrong`)+`">`+unparser(RESULT[i].actual)+`</td>
                <td id="`+`correct_answer`+i+`">`+unparser(RESULT[i].right)+`</td>
            </tr>
        `;
    }    
}
build();