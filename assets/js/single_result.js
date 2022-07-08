result_num = window.location.toString().split('/').pop();
API = '/api/result/'+result_num;

load();

function load() {
    async_get_json(API,build);
}

function trigger_correct_ans() {
    var button = document.getElementById('trigger');
    document.querySelectorAll('.correct_answer').forEach(function(e){e.hidden = !e.hidden});
    button.innerHTML = (correct_answers.hidden?'Показать':'Скрыть')+' верные ответы';
}
function unparser(str) {
    if(str==null) {
        return '';
    }
    str = str.split('|').join('<br>');
    return str;
}
function build(result) {
    if(!result.ok) {
        document.body.innerHTML = '';
        return;
    }
    result = result.data;
    var header = document.getElementById('header');
    header.innerHTML = 'Результаты пользователя '+result.email+' по тесту '+result.kim;
    var table = document.getElementById('table');
    result = JSON.parse(result.result);
    for(var i in result) {
        table.innerHTML += `
            <tr>
                <th>`+i+`</th>
                <td class="`+(result[i].correct?`correct`:`wrong`)+`">`+unparser(result[i].actual)+`</td>
                <td class='correct_answer'>`+unparser(result[i].right)+`</td>
            </tr>
        `;
    }    
}