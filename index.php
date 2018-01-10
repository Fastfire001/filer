<?php
require ('init.php');
$title = 'Home';
if (isset($_SESSION['id'])){
    $userID = $_SESSION['id'];
    $result = mysqli_query($link, 'SELECT * FROM files WHERE user_id =' . $userID);
    $files = [];
    while ($row = mysqli_fetch_assoc($result))
    {
        $files[] = $row;
    }
}
ob_start();
?>
<div class="content">
    <div class="error">
        <?php
            if (!empty($_GET['error'])){
                echo $_GET['error'];
            }
        ?>
    </div>
    <div class="addfile">
        <form method="post" action="./addFile.php" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000">
            <input type="file" name="file"><br>
            <label for="fileName">Choose the name of your file (don't forget the extension):</label><br>
            <input id="fileName" name="fileName" type="text"><br>
            <input type="submit" value="Send">
        </form>
    </div>
    <div class="allfiles">
        <?php foreach ($files as $file): ?>
            <div data-fileID="<?= $file['file_id']; ?>" class="file">
                <a class="download" download="<?= $file['name'] ?>" href="./files/<?= $userID ?>/<?= $file['name'] ?>"><?= $file['name'] ?></a>
                <a class="delete" href="deleteFile.php?id=<?= $file['file_id'] ?>&name=<?= $file['name'] ?>">Delete</a>
                <span class="rename">Rename</span>
            </div>
            <div class="line"></div>
        <?php endforeach; ?>
    </div>
    <div class="overlay hide"></div>
    <div class="popup hide">
        <form action="renameFile.php" method="POST" class="renameForm">
            <label for="newName">New name:</label><br>
            <input id="newName" name="newName" type="text"><br>
            <input type="hidden" name="fileID" value="">
            <input type="hidden" name="oldFileName" value="">
            <input type="submit" value="Send"><br>
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
