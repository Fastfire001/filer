<?php
require ('init.php');
$fileID = $_GET['id'];
$name = $_GET['name'];
$userID = $_SESSION['id'];
mysqli_query($link, 'DELETE FROM `files` WHERE user_id =' . $userID . ' AND file_id =' . $fileID);
unlink('./files/' . $userID . '/' . $name);
header('Location: index.php');
exit();