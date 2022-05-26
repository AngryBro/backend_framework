var answers = {};
var json_div = document.getElementById('json');
var json = json_div.innerHTML;
json = JSON.parse(json);
var files = json['files'];

function disable_button(button) {
    //button.setAttribute('disabled',true);
    button.setAttribute('class','disabled');
}
function enable_button(button_id,class_) {
    document.getElementById(button_id).setAttribute('class',class_);
}
function save(task,ans,button) {
    button.setAttribute('class','disabled');
    answers[task] = ans;
}
function del(ans) {
    ans.value = '';
}
function make_active(button) {
    for(var i in files) {
        if(this.id=='button'+i) {
            document.getElementById('button'+i).setAttribute('class','active_page');
        }
        else {
            document.getElementById('button'+i).setAttribute('class','page');
        }
    }
}
function create_button(img,text) {
    return `
    <tr>
        <td>
            <button class='page' id=button`+text+` onclick='make_active(this);img.src="/img/`+img+`"'>`+text+`
            </button>
        </td>
    </tr>
    `;
}
function build() {
    //json_div.remove();
    var buttons = document.getElementById('buttons');
    buttons.innerHTML += create_button(files['i'],'<i>i</i>');
    for(var i in files) {
        if(i!='i') {
            buttons.innerHTML += create_button(files[i],i);
        }
    }
}
build();