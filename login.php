<?php
require('init.php');
$title = 'Login';
$username = '';
$password = '';
$errors = '';
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = htmlentities($_POST['username']);
    $password = $_POST['password'];
    $q = "SELECT * FROM users WHERE password = '". $password . "' AND username = '" . $username . "'";
    $result = mysqli_query($link, $q);
    $user = mysqli_fetch_assoc($result);
    if ($user === NULL)
    {
        $errors = 'Invalid username or password';
    } else
    {
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit();
    }

} else if (!empty($_POST['username']) || !empty($_POST['password'])){
    $errors = 'Invalid username or password';
}
ob_start();
?>
    <div class="content">
        <div class="errorBlock"><?= $errors ?></div>
        <form action="login.php" method="POST" class="loginForm">
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" class="form-control" value="<?= $username ?>"><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" class="form-control"><br>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
<?php
$content = ob_get_contents();
ob_end_clean();
require('layout.php');
?>