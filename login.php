<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .vertical-center {
            min-height: 100vh;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="vertical-center d-flex align-items-center">

        <div class="container p-3 rounded bg-dark" style="max-width: 45rem;">
            <a href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                    class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                </svg>

            </a>
            <h1 class="text-light my-4">Login to your account</h1>
            <?php
            function login($email, $password)
            {



                require_once "database.php";

                $query = "SELECT * FROM student WHERE emailAdd = '$email'";
                $result = mysqli_query($connection, $query);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["user"] = $user["firstName"];
                        $_SESSION["id"] = (int) $user["studentID"];
                        header("Location: home.php");
                    } else {
                        echo "<div class='alert alert-danger'>Invalid password!</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not exist!</div>";
                }
            }


            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                if ($email == "admin@gmail.com" and $password == "admin") {
                    $_SESSION["user"] = "admin";
                    header("Location: admin.php");
                } else {
                    login($email, $password);
                }

            }

            ?>
            <form action="login.php" method="post">
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <p class="text-light text-center">Don't have an account? <a href="register.php">Sign up</a></p>
                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-primary btn-lg mb-4">Login</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>