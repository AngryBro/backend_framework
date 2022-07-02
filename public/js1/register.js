function register() {
    send_async_form('/admin/register','form');
    document.querySelectorAll('input').forEach(function(e) {e.value=""});
    alert('Успешно');
}