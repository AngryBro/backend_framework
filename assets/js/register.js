function register() {
    send_async_form('/admin/register','form',success);
    document.querySelectorAll('input').forEach(function(e) {e.value=""});
}

function success(response) {
    var errors = [];
    if(!response.ok) {
        if(response.errors.email) errors.push('Некорректный email');
        if(response.errors.password) errors.push('Короткий пароль');
        if(response.errors.kim) errors.push('Отсутствует КИМ');
        alert(errors.join('\n'));
    }
    alert('Успешно');
}