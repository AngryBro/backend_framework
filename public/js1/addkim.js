function add() {
    async_post_form('/admin/addkim','form',isOk);
}

function isOk(response) {
    if(response.ok) {
        alert('Успешно');
    }
    else {
        alert('Ошибки: \n'+response.errors.join('\n'));
    }
    document.querySelectorAll('input').forEach(function(e){e.value=''});
}