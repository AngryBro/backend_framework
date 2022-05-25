var answers = {};
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
function create_button(img,text) {
    return `
    <tr>
        <td>
            <button class='page' onclick='img.src="/img/`+img+`"'>`+text+`
            </button>
        </td>
    </tr>
    `;
}
function build() {
    var json_div = document.getElementById('json');
    var json = json_div.innerHTML;
    json = JSON.parse(json);
    //json_div.remove();
    var buttons = document.getElementById('buttons');
    var files = json['files'];
    buttons.innerHTML += create_button(files['i'],'<i>i</i>');
    for(var i in files) {
        if(i!='i') {
            buttons.innerHTML += create_button(files[i],i);
        }
    }
}
build();