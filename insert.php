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

        <div class="container px-3 py-5 rounded bg-dark" style="max-width: 45rem;">
            <?php

            if (isset($_POST["text"])) {
                $code = $_POST["text"];
                $id = $_SESSION["id"];

                $query = "INSERT INTO attendance(studentID, className) VALUES ($id, '$code')";

                require_once "database.php";

                if ($connection->query($query) === TRUE) {
                    echo "<div class='container-fluid d-flex justify-content-center'><img src='./img/check.png' alt='success' style='max-width: 10rem;'></div>";
                    echo "<h1 class='text-light text-center mt-4 mb-5'>Success!</h1>";
                } else {
                    echo "<div class='container-fluid d-flex justify-content-center'><img src='./img/cancel.png' alt='error' style='max-width: 10rem;'></div>";
                    echo "<h1 class='text-light text-center mt-4 mb-5'>Error!</h1>";
                    echo "<div class='alert alert-danger mt-3'>Error: " . $query . " " . $connection->error;
                }
                $connection->close();
            }
            ?>

            <div class="d-grid">
                <a href="index.php" class="btn btn-primary btn-lg">Scan again</a>
            </div>


            </form>
        </div>
    </div>

</body>

</html>