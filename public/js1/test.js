var ANSWERS = {};
var CURRENT_TASK = 'i';
var INPUT = document.getElementById('answer');
var FILES_LINKS = {};

start();

function start() {
    async_get_json('/test/saved',function(response){
        ANSWERS = response;
    });
    async_get_json('/test/data',build_test);
}

function end() {
    build_end();
}

function send() {
    delete ANSWERS.i;
    for(var i in ANSWERS) {
        ANSWERS[i] = parser(ANSWERS[i]);
    }
    async_post_json('/test',ANSWERS);
    view('sent');
    setTimeout(logout,3000);
}

function logout() {
    location.href = '/logout';
}

function build_end() {
    var answers_table = document.getElementById('answers_table');
    answers_table.innerHTML = `
        <tr>
            <th class='answer'>№</th>
            <td class='answer'>Ваш ответ</td>
        </tr>
    `;
    for(var i in ANSWERS) {
        if(i=='i') continue;
        answers_table.innerHTML += `
            <tr>
                <th class='answer'>`+i+`</th>
                <td class='answer'>`+unparser(ANSWERS[i])+`</td>
            </tr>
        `;
    }
    view('end_exam');
}

function build_test(kimData) {
    FILES_LINKS = kimData.additional_files;
    for(var i in FILES_LINKS) {
        for(var j in FILES_LINKS[i]) {
            FILES_LINKS[i][j] = FILES_LINKS[i][j].split('.').join('-');
        }
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

function view(id) {
    document.querySelectorAll('div').forEach(function(e){e.hidden=true});
    document.getElementById(id).hidden=false;
}

function back_to_test() {
    view('test');
}

function unparser(str) {
    str = str.split('\n').join('<br>');
    return str;
}

function parser(str) {
    str = str.replace(/ *|\t*/g,'');
    str = str.replace(/\n+/g,'|');
    if(str[str.length-1]=='|') {
        str = str.split('|');
        str.pop();
        str = str.join('|');
    }
    if(str[0]=='|') {
        str = str.replace('|','');
    }
    return str;
}

function test_reg(str) {
    str = str.replace(/\n+/g,'|');
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
    ANSWERS[CURRENT_TASK] = ans;
    async_post_json('/test/save',ANSWERS);
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
    var links = document.getElementById('additional_files');
    if(CURRENT_TASK in FILES_LINKS) {
        links.innerHTML = `
                Прилагаемые файлы:
            `;
        for(var i in FILES_LINKS[CURRENT_TASK]) {
            links.innerHTML += `
                <li><a target='blank' href='/test/download/`+
                FILES_LINKS[CURRENT_TASK][i]+
                `'>`+FILES_LINKS[CURRENT_TASK][i].split('-').join('.')+`</a></li>
            `;
        }
    }
    else {
        links.innerHTML = '';
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