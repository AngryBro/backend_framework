function redirect(auth_data) {
    if(!auth_data.ok) {
        return alert('Данные отсутствуют');
    }
    if(auth_data.authed) {
        location.href = auth_data['role']=='admin'?'/admin':'/startexam';
    }
    else {
        alert('Неверные данные');
    }
}
function login() {
    send_async_form('/login','form',redirect);
}