var JSON_RESULTS = document.getElementById('json').getAttribute('content');
var RESULTS = JSON.parse(JSON_RESULTS);
var RESULTS_TO_DELETE = {count:0};
document.getElementById('json').remove();
function make_list() {
    var table = document.getElementById('results');
    for(var i in RESULTS) {
        table.innerHTML += `
        <tr>
            <td><a href='/admin/results/`+String(Number(i)+1)+`'>
                `+String(Number(i)+1)+`</a>
            </td>
            <td>
                `+RESULTS[i].user+`
            </td>
            <td>
                `+RESULTS[i].kim+`
            </td>
            <td>
                <input value="`+i+`" onchange="check_to_delete(this)" type="checkbox"></input>
            </td>
        </tr>
        `;
    }
}
function check_to_delete(checkbox) {
    RESULTS_TO_DELETE[checkbox.value] = checkbox.checked;
    var delete_button = document.getElementById('delete_button');
    if(checkbox.checked) {
        delete_button.hidden = false;
        RESULTS_TO_DELETE.count++;
    }
    else {
        RESULTS_TO_DELETE.count--;
        if(RESULTS_TO_DELETE.count==0) {
            delete_button.hidden = true;
        }
    }
}
function delete_results() {
    var form = document.getElementById('form_to_delete');
    var delele_json = document.getElementById('delete_json');
    var results_to_delete = [];
    for(var i in RESULTS_TO_DELETE) {
        if(i=='count') continue;
        if(RESULTS_TO_DELETE[i]) {
            results_to_delete.push(i);
        }
    }
    delele_json.value = JSON.stringify(results_to_delete);
    form.submit();
}
make_list();