<?php
session_start();
require_once "dbconfig.php";

if (isset($_SESSION["username"]))
{
    header("Location: index.php");
    exit();
}

$username = $password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username)) $errors["username"] = "Username must not be empty.";
    if (empty($password)) $errors["password"] = "Username must not be empty.";

    if (count($errors) === 0)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam("username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $isMatchPassword = password_verify($password, $result->password);

        if($isMatchPassword)
        {
            $_SESSION["username"] = $result->username;
            header("Location: index.php");
            exit();
        } else {
            $errors["authentication"] = "Invalid credentials.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-3xl font-bold leading-9 tracking-tight text-gray-900">
                Login your account
            </h2>
            <p class="text-center mt-2">Please fill in this form to login your account.</p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" method="post">
            <div>
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                <div class="my-2">
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        class="form-control"
                        value="<?= htmlspecialchars($_POST["username"] ?? "") ?>"
                    >
                </div>
                <?php if (isset($errors["username"])) : ?>
                    <div class="bg-red-200 py-1 text-sm my-1 text-center rounded text-neutral-600" role="alert" style="border: 1px solid #fb7185;">
                        <?= $errors["username"] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                </div>
                <div class="my-2">
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="form-control"
                        value="<?= htmlspecialchars($_POST["password"] ?? "") ?>"
                    >
                </div>
                <?php if (!empty($errors["password"])) : ?>
                    <div class="bg-red-200 py-1 text-sm my-1 text-center rounded text-neutral-600" role="alert" style="border: 1px solid #fb7185;">
                        <?= $errors["password"] ?>
                    </div>
                <?php endif; ?>
            </div>

                <?php if (!empty($errors["authentication"])) : ?>
                    <div class="bg-red-200 py-1 text-sm my-1 text-center rounded text-neutral-600" role="alert" style="border: 1px solid #fb7185;">
                        <?= $errors["authentication"] ?>
                    </div>
                <?php endif; ?>

            <div>
                <button class="btn btn-warning w-full">Sign in</button>
            </div>

            <div>
                <p>Need an account?
                    <a href="register.php" class="text-blue-500 font-medium tracking-wide hover:underline">Register</a>
                </p>
            </div>
            </form>
        </div>
    </div>
</body>
</html>