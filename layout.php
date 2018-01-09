<!doctype html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"> <!--font -->
    <link rel="stylesheet" href="./assets/styles.css" type="text/css" />
    <script src="./assets/script.js"></script>
</head>
<body>
    <header>
        <h1><a href="index.php">My Filer</a></h1>
    </header>
    <nav class="account">
        <?php
        if (!isset($_SESSION['username'])): ?>
        <a href="register.php">register</a>
        <a href="login.php">login</a>
        <?php else: ?>
        <a href="index.php"><?= $_SESSION['username'] ?></a>
        <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>
    <main>
        <?php echo $content; ?>
    </main>
</body>
</html>