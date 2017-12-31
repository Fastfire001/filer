<?php
require ('init.php');
$title = 'Home';
ob_start();

?>
<div class="content">
    <div class="addfile">
        <form method="post" action="./addFile.php">
            <input type="file" name="file"><br>
            <label for="fileName">Choose the name of your file (don't forget the extension):</label><br>
            <input id="fileName" name="fileName" type="text"><br>
            <input type="submit" value="Send">
        </form>
    </div>
</div>
<?php
if (empty($_SESSION['id'])){
    $content = '<div class="needConnexion">Connect to find your files</div>';
} else {
$content = ob_get_contents();
}
ob_end_clean();
require('layout.php');
?>
