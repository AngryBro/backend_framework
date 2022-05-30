var KIM = {
    files: getKim('json')['files'],
    name: getKim('json')['name']
};
var ANSWERS = {};
var JSON_ANSWERS = document.getElementById('saved_answers');
var CURRENT_TASK = 'i';
var INPUT = document.getElementById('answer');

function back_to_test() {
    document.getElementById('end_exam').hidden = true;
    document.getElementById('app').hidden = false;
}
function send() {
    var form = document.getElementById('send_form');
    delete ANSWERS['i'];
    document.getElementById('saved_answers').value=JSON.stringify({
        'answers':ANSWERS,
        'kim':KIM.name
        });
    form.submit();
}
function unparser(str) {
    str = str.split('|').join('<br>');
    return str;
}
function end_exam() {
    var app = document.getElementById('app');
    app.hidden = true;
    document.getElementById('end_exam').hidden = false;
    var answers_table = document.getElementById('answers_table');
    for(var i in ANSWERS) {
        if(i=='i') continue;
        answers_table.innerHTML += `
            <tr>
                <td>`+i+`</td>
                <td>`+unparser(ANSWERS[i])+`</td>
            </tr>
        `;
    }
}
function getKim(json_id) {
    var json_div = document.getElementById('json');
    var json = json_div.innerHTML;
    json = JSON.parse(json);
    return json;
}
function parser(str) {
    str = str.split(' ').join('');
    str = str.split('\n').join('|');
    return str;
}
function disable_button(button) {
    //button.setAttribute('disabled',true);
    button.setAttribute('class','disabled');
}
function enable_button(button_id,class_) {
    document.getElementById(button_id).setAttribute('class',class_);
}
function save(ans) {
    document.getElementById('save').setAttribute('class','disabled');
    ANSWERS[CURRENT_TASK] = parser(ans);
    var json = {
        answers: ANSWERS,
        kim: KIM.name
    };
    JSON_ANSWERS.value = JSON.stringify(json);
}
function del(ans) {
    ans.value = '';
    document.getElementById('save').setAttribute('class','save');
}
function make_active(button) {
    button.setAttribute('class','active_page');
    CURRENT_TASK = button.id.split('button')[1];
    INPUT.value = ANSWERS[CURRENT_TASK];
    for(var i in KIM.files) {
        if(button.id!='button'+i) {
            document.getElementById('button'+i).setAttribute('class','page');
        }
    }
}
function create_button(img,text) {
    return `
    <tr>
        <td>
            <button class='page' id=button`+text+` onclick="make_active(this);img.src=\'/img/`+img+`\'">`+text+`
            </button>
        </td>
    </tr>
    `;
}
function build() {
    for(var i in KIM.files) {
        ANSWERS[i] = '';
    }
    JSON_ANSWERS.value = JSON.stringify({kim:KIM.name,answers:ANSWERS});
    var buttons = document.getElementById('buttons');
    buttons.innerHTML += create_button(KIM.files['i'],'i');
    var infbutton = document.getElementById('buttoni');
    infbutton.innerHTML = '<i>'+infbutton.innerHTML+'</i>';
    infbutton.setAttribute('class','active_page');
    document.getElementById('img').setAttribute('src','/img/'+KIM.files['i']);
    for(var i in KIM.files) {
        if(i!='i') {
            buttons.innerHTML += create_button(KIM.files[i],i);
        }
    }
}
build();