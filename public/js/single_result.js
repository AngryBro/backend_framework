var RAW_JSON = JSON.parse(document.getElementById('json').getAttribute('content'));
var USER = RAW_JSON.user;
var KIM = RAW_JSON.kim;
var RESULT = RAW_JSON.result;

function build() {
    var numbers = document.getElementById('numbers');
    var actual_answers = document.getElementById('actual_answers');
    var correct_answers = document.getElementById('correct_answers');
    for(var i in RESULT) {
        numbers.innerHTML += `
            <th>
                `+i+`
            </th>
        `;
        actual_answers.innerHTML += `
            <td class=`+(RESULT.correct?`"correct"`:`"wrong"`)+`>
                `+RESULT[i].actual+`
            </td>
        `;
        correct_answers.innerHTML += `
            <td>
                `+RESULT[i].right+`
            </td>
        `;
    }    
}
build();