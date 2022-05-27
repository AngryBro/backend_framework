var KIM = {
    files: getKim('json')['files']
};
var ANSWERS = {};
var CURRENT_TASK = 'i';
function getKim(json_id) {
    var json_div = document.getElementById('json');
    var json = json_div.innerHTML;
    json = JSON.parse(json);
    return json;
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
    ANSWERS[CURRENT_TASK] = ans;
}
function del(ans) {
    ans.value = '';
    document.getElementById('save').setAttribute('class','save');
}
function make_active(button) {
    button.setAttribute('class','active_page');
    CURRENT_TASK = button.id.split('button')[1];
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
        ANSWERS[i] = null;
    }
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