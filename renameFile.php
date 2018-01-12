<?php
require ('init.php');
$userID = $_SESSION['id'];
$newName = htmlentities($_POST['newName']);
$oldName = $_POST['oldFileName'];
$fileID = $_POST['fileID'];
$newPath = "./files/" . $userID . "/" . $newName;
$oldPath = "./files/" . $userID . "/" . $oldName;
if (file_exists($newPath)){
    header('Location: index.php?error=File already exist');
    exit();
}
mysqli_query($link,"UPDATE files SET name = '" . $newName . "' , path = '" . $newPath . "' WHERE file_id = " . $fileID);
rename($oldPath, $newPath);
header('Location: index.php');
exit();