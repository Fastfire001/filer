<?php
require ('init.php');
$fileName =  htmlentities($_POST['fileName']);
$file = $_FILES['file'];
$userID = $_SESSION['id'];
$path = "./files/" . $userID . "/" . $fileName;
$isNameValid = false;
if (!empty($fileName) && 0 !== strlen($fileName) && !empty($file)){
    $isNameValid = true;
} else {
    header('Location: index.php?error=Invalid name');
    exit();
}
if (strlen($file['size']) === 1){
    header('Location: index.php?error=Invalid file');
    exit();
}
if (true === $isNameValid){
    if (!file_exists('./files/' . $userID)) {
        mkdir('./files/' . $userID, 0777);
    }
    if (!file_exists('./files/' . $userID . '/' . $fileName) && $file["size"] < 20000000){
        $uploaddir = './files/' . $userID . '/';
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
        rename($uploadfile, $uploaddir . $fileName);
        $q = "INSERT INTO `files` (`file_id`, `user_id`, `name`, `path`) VALUES (NULL, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $q);
        $userID = intval($userID);
        mysqli_stmt_bind_param($stmt, 'iss', $userID, $fileName, $path);
        mysqli_stmt_execute($stmt);
    } else{
        header('Location: index.php?error=Failed file upload');
        exit();
    }
}
header('Location: index.php');
exit();