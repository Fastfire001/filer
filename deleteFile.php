<?php
require ('init.php');
$fileID = $_GET['id'];
$name = $_GET['name'];
$userID = $_SESSION['id'];
$result = mysqli_query($link, 'DELETE FROM `files` WHERE user_id =' . $userID . ' AND file_id =' . $fileID);
$file = mysqli_fetch_assoc($result);
unlink('./files/' . $userID . '/' . $name);
header('Location: index.php');
exit();