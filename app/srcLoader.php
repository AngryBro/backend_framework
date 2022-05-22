<?php
function script($name) {
    echo '<script>'.file_get_contents('../resources/js/'.$name.'.js').'</script>';
}
function style($name) {
    echo '<style>'.file_get_contents('../resources/css/'.$name.'.css').'</style>';
}