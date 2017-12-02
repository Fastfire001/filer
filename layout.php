<!doctype html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"> <!--font -->
    <link rel="stylesheet" href="./assets/styles.css" type="text/css" />
</head>
<body>
    <header>
        <h1><a href="index.php">My Filer</a></h1>
    </header>
    <nav class="account">
        <a href="register.php">register</a>
        <a href="login.php">login</a>
        <a href="logout.php">Logout</a>
    </nav>
    <main>
        <?php echo $content; ?>
    </main>
    <?php
    echo $_SESSION['username'];
    ?>
    <footer>
        Maxime Maréchal &#169;
    </footer>
</body>
</html>