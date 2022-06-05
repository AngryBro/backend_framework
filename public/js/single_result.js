result_id = window.location.toString().split('/').pop();
async_post_json('/admin/result',Number(result_id),build);

function trigger_correct_ans() {
    var button = document.getElementById('trigger');
    document.querySelectorAll('.correct_answer').forEach(function(e){e.hidden = !e.hidden});
    button.innerHTML = (correct_answers.hidden?'Показать':'Скрыть')+' верные ответы';
}
function unparser(str) {
    str = str.split('|').join('<br>');
    return str;
}
function build(result) { console.log(result);
    var header = document.getElementById('header');
    header.innerHTML = 'Результаты пользователя '+result.user+' по тесту '+result.kim;
    var table = document.getElementById('table');
    for(var i in result.answers) {
        table.innerHTML += `
            <tr>
                <th>`+i+`</th>
                <td class="`+(result.answers[i].correct?`correct`:`wrong`)+`">`+unparser(result.answers[i].actual)+`</td>
                <td class='correct_answer'>`+unparser(result.answers[i].right)+`</td>
            </tr>
        `;
    }    
}