<?php
require ('init.php');
if (empty($_GET['id']) || empty($_GET['name']) || empty($_SESSION['id'])){
    header('Location: index.php');
    exit();
}
$fileID = $_GET['id'];
$name = $_GET['name'];
$userID = $_SESSION['id'];
mysqli_query($link, 'DELETE FROM `files` WHERE user_id =' . $userID . ' AND file_id =' . $fileID);
unlink('./files/' . $userID . '/' . $name);
header('Location: index.php');
exit();