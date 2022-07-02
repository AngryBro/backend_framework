function register() {
    send_async_form('/admin/register','form',success);
    document.querySelectorAll('input').forEach(function(e) {e.value=""});
}

function success(response) {
    alert(response?'Успешно':'Ошибка');
}