function redirect(auth_data) {
    if(auth_data['authed']) {
        location.href = auth_data['role']=='admin'?'/admin':'/test';
    }
    else {
        alert('Неверные данные');
    }
}
function login() {
    send_async_form('/login/authentificate','form',redirect);
}