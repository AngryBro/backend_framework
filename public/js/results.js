var RESULTS_TO_DELETE = {count:0};
get_async_json('/admin/results/getresults',build_table);

function delete_results() {
    var results = [];
    for(var i in RESULTS_TO_DELETE) {
        if(i=='count') continue;
        if(RESULTS_TO_DELETE[i]) {
            results.push(i);
        }
    }
    RESULTS_TO_DELETE = {count:0};
    send_async_json('/admin/results/delete',results,build_table);
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
    for(var i in results) {
        if(results.length) {
        table.innerHTML += `
        <tr id="result`+i+`">
            <td><a href='/admin/results/`+String(Number(i)+1)+`'>
                `+String(Number(i)+1)+`</a>
            </td>
            <td>
                `+results[i].user+`
            </td>
            <td>
                `+results[i].kim+`
            </td>
            <td>
                <input value="`+i+`" onchange="check_to_delete(this)" type="checkbox"></input>
            </td>
        </tr>
        `;
        }
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