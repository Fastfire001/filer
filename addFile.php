<?php
require ('init.php');
$fileName =  $_POST['fileName'];
$file = $_FILES['file'];
$userID = $_SESSION['id'];
$path = "./files/" . $userID . "/" . $fileName;
$isFileValid = false;
if (!empty($fileName) && 0 !== strlen($fileName) && !empty($file)){
    $isFileValid = true;
}
if (true === $isFileValid){
    if (!file_exists('./files/' . $userID)) {
        mkdir('./files/' . $userID, 0777);
    }
    if (!file_exists('./files/' . $userID . '/' . $file['name'])){

        $uploaddir = './files/' . $userID . '/';
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
        $tmp_file = $file['tmp_name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);


        $q = "INSERT INTO `files` (`file_id`, `user_id`, `name`, `path`) VALUES (NULL, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $q);
        $userID = intval($userID);
        mysqli_stmt_bind_param($stmt, 'iss', $userID, $fileName, $path);
        mysqli_stmt_execute($stmt);
    }

}
header('Location: index.php');
exit();