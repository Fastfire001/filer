<?php
$title = 'Login';
ob_start();
?>
    <p class="content">ici c'est le login</p>
<?php
$content = ob_get_contents();
ob_end_clean();
require('layout.php');
?>