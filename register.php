<?php
require ('init.php');
if (isset($_SESSION['id'])){
    header('Location: index.php');
    exit();
}
$title = 'Register';
$firstname = '';
$lastname = '';
$username = '';
$email = '';
$password = '';
$password_repeat= '';
$errors = '';
$isFormValid = false;

if (!empty($_POST['firstname']) || !empty($_POST['lastname']) || !empty($_POST['username']) || !empty($_POST['email']) || !empty($_POST['password']) || !empty($_POST['password_repeat'])){
    $firstname = htmlentities($_POST['firstname']);
    $lastname = htmlentities($_POST['lastname']);
    $username = htmlentities($_POST['username']);
    $email = htmlentities($_POST['email']);
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    if (strlen($firstname) >= 2 && strlen($lastname) >= 2 && strlen($username) >=2 && filter_var($email, FILTER_VALIDATE_EMAIL)&& strlen($password) >= 6 && $password == $password_repeat){
        $isFormValid = true;
    } else if (strlen($firstname) < 2){
        $errors = "First name must be 2 characters or more<br>";
    } if (strlen($lastname) < 2){
        $errors = $errors . "Last name must be 2 characters or more<br>";
    }if (strlen($username) < 2){
        $errors = $errors . "Username must be 2 characters or more<br>";
    } if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors = $errors . "Email must be valid<br>";
    } if (strlen($password) < 6){
        $errors = $errors . "Password must be 6 characters or more<br>";
    } if ($password !== $password_repeat){
        $errors = $errors . "Both passwords must be the same<br>";
    }
}

if ($isFormValid === true){
    $creation = date('Y-m-d H:i:s');

    $q = "INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `creation`) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $q);
    mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $lastname, $username, $email, $password , $creation);
    mysqli_stmt_execute($stmt);
    header('Location: index.php');
    exit();
}

ob_start();
?>
    <div class="content">
        <div class="error"><?= $errors ?></div>
        <form action="register.php" method="POST" class="registerForm">
            <label for="firstname">First name</label><br>
            <input type="text" name="firstname" id="firstname" maxlength="254" class="form-control" value="<?= $firstname ?>"><br>
            <label for="lastname">Last name</label><br>
            <input type="text" name="lastname" id="lastname" maxlength="254" class="form-control" value="<?= $lastname ?>"><br>
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" maxlength="254" class="form-control" value="<?= $username ?>"><br>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" maxlength="254" class="form-control" value="<?= $email ?>"><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" maxlength="254" class="form-control"><br>
            <label for="password_repeat">Repeat password</label><br>
            <input type="password" name="password_repeat" id="password_repeat" maxlength="254" class="form-control"><br>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
<?php
$content = ob_get_contents();
ob_end_clean();
require('layout.php');
?>