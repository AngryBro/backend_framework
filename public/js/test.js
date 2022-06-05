var ANSWERS = {};
var CURRENT_TASK = 'i';
var INPUT = document.getElementById('answer');

async_get_json('/test/name',build_start);

function start() {
    async_get_json('/test/data',build_test);
}

function end() {
    build_end();
}

function send() {
    delete ANSWERS.i;
    async_post_json('/test',ANSWERS);
    view('sent');
}

function build_end() {
    var answers_table = document.getElementById('answers_table');
    for(var i in ANSWERS) {
        if(i=='i') continue;
        answers_table.innerHTML += `
            <tr>
                <th>`+i+`</th>
                <td>`+unparser(ANSWERS[i])+`</td>
            </tr>
        `;
    }
    view('end_exam');
}

function build_test(kimData) {
    for(var i in kimData.files) {
        ANSWERS[i] = '';
    }
    var buttons = document.getElementById('buttons');
    buttons.innerHTML += create_button(kimData.files['i'],'i');
    var infbutton = document.getElementById('buttoni');
    infbutton.innerHTML = '<i>'+infbutton.innerHTML+'</i>';
    infbutton.setAttribute('class','active_page');
    document.getElementById('img').setAttribute('src','/img/'+kimData.files['i']);
    for(var i in kimData.files) {
        if(i!='i') {
            buttons.innerHTML += create_button(kimData.files[i],i);
        }
    }
    view('test');
}

function build_start(name) {
    var start_exam = document.getElementById('start_exam');
    start_exam.innerHTML = `<h1>КИМ `+name+`</h1>`+start_exam.innerHTML;
    view('start_exam'); 
}

function view(id) {
    document.querySelectorAll('div').forEach(function(e){e.hidden=true});
    document.getElementById(id).hidden=false;
}

function back_to_test() {
    view('test');
}

function unparser(str) {
    str = str.split('|').join('<br>');
    return str;
}

function parser(str) {
    str = str.split(' ').join('');
    str = str.split('\n').join('|');
    return str;
}
function disable_button(button) {
    button.setAttribute('class','disabled');
}
function enable_button(button_id,class_) {
    document.getElementById(button_id).setAttribute('class',class_);
}
function save(ans) {
    document.getElementById('save').setAttribute('class','disabled');
    ANSWERS[CURRENT_TASK] = parser(ans);
}
function del(ans) {
    ans.value = '';
    document.getElementById('save').setAttribute('class','save');
}
function make_active(button) {
    document.querySelector('.active_page').setAttribute('class','page');
    button.setAttribute('class','active_page');
    CURRENT_TASK = button.id.split('button')[1];
    INPUT.value = ANSWERS[CURRENT_TASK];
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