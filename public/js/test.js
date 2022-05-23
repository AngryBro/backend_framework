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