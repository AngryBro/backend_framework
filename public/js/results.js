var JSON_RESULTS = document.getElementById('json').getAttribute('content');
var RESULTS = JSON.parse(JSON_RESULTS);
var RESULTS_TO_DELETE = {count:0};
document.getElementById('json').remove();
function make_list() {
    var table = document.getElementById('results');
    for(var i in RESULTS) {
        table.innerHTML += `
        <tr id="result`+i+`">
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
async function delete_results() {
    var res = [];
    delete RESULTS_TO_DELETE.count;
    for(var i in RESULTS_TO_DELETE) {
        if(RESULTS_TO_DELETE[i]) {
            res.push(i);
        }
    }
    var form = new FormData();
    form.set('json',JSON.stringify(res));
    var url = '/admin/results/delete';
    var promise = await fetch(url,{
        method: 'post',
        body: form
    });
    var response = await promise.text();
    if(response!='error') {
        for(var i in res) {
            RESULTS = response;
            make_list();
        }
    }
}
make_list();