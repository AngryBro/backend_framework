var RESULTS_TO_DELETE = {count:0};
var API = '/api/results';
load();

function load() {
    async_get_json(API,build_table);
}

function delete_results() {
    var results = [];
    for(var i in RESULTS_TO_DELETE) {
        if(i=='count') continue;
        if(RESULTS_TO_DELETE[i]) {
            results.push(i);
        }
    }
    RESULTS_TO_DELETE = {count:0};
    async_post_json(API,results,load);
}

function build_table(results) {
    var table = document.getElementById('table');
    hide_button(document.getElementById('delete_button'));
    table.innerHTML = `
        <tr>
				<td>
					№
				</td>
				<td>
					Пользователь
				</td>	
				<td>
					КИМ
				</td>
				<td>
					Отметка на удаление
				</td>
		</tr>
        `;
    if(results.length==0) {
        table.innerHTML = 'Результаты отсутствуют';
    }
    for(var i in results) {
        var num = Number(i)+1;
        table.innerHTML += `
            <tr>
                <td><a href='/admin/results/`+num+`'>`+num+`</a></td>
                <td>`+results[i].email+`</td>
                <td>`+results[i].kim+`</td>
                <td><input type='checkbox' 
                value=`+results[i].id+
                ` onchange=check_to_delete(this)`
                +`></input></td>
            </tr>
        `;
    }
}
function check_to_delete(checkbox) {
    RESULTS_TO_DELETE[checkbox.value] = checkbox.checked;
    var delete_button = document.getElementById('delete_button');
    if(checkbox.checked) {
        RESULTS_TO_DELETE.count++;
    }
    else {
        RESULTS_TO_DELETE.count--;
    }
    hide_button(delete_button);
}

function hide_button(button) {
    button.hidden = !RESULTS_TO_DELETE.count;
}