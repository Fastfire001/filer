<?php
$title = 'Home';
ob_start();
?>
<p class="content"></p>
<?php
$content = ob_get_contents();
ob_end_clean();
require('layout.php');
?>