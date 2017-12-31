<?php
require ('init.php');
$fileName =  $_POST['fileName'];
$file = $_POST['file'];
$userID = intval($_SESSION['id']);
$isFileValid = false;
if (!empty($fileName) && 0 !== strlen($fileName) && !empty($file)){
    $isFileValid = true;
}
if (true === $isFileValid){
    $path = "./" . $userID . "/" . $fileName;
    $q = "INSERT INTO `files` (`file_id`, `user_id`, `name`, `path`) VALUES (NULL, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $q);
    mysqli_stmt_bind_param($stmt, 'iss', $userID, $fileName, $path);
    mysqli_stmt_execute($stmt);
}
header('Location: index.php');
exit();