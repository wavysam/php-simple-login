<?php

session_start();

// if (!isset($_SESSION["username"]))
// {
//     header("Location: login.php");
//     exit();
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="max-w-4xl mx-auto my-10">
        <?php if (isset($_SESSION["username"])) : ?>
        <h1 class="text-3xl font-bold">
            You are now logged in, 
            <span class="capitalize text-indigo-600">
                <?= htmlspecialchars($_SESSION["username"]) ?>
            </span>
        </h1>

        <div class="mt-4">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <?php endif; ?>

        <?php if (!isset($_SESSION["username"])) : ?>
        <h1 class="text-3xl font-bold">
            You are currently not logged in.
        </h1>

        <div class="mt-4">
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-warning">Register</a>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>