<?php
$title = 'Home';
ob_start();
?>
<div class="content"></div>
<?php
$content = ob_get_contents();
ob_end_clean();
require('layout.php');
?>
