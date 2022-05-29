var JSON_RESULTS = document.getElementById('json').getAttribute('content');
var RESULTS = JSON.parse(JSON_RESULTS);
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
        </tr>
        `;
    }
}
make_list();