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

            <h1 class="text-light my-4">Register</h1>
            <?php

            function insertAccount($firstName, $lastName, $email, $password, $course, $conn)
            {

                $query = "INSERT INTO student (firstName, lastName, emailAdd, password, courseID) VALUES (?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepare = mysqli_stmt_prepare($stmt, $query);

                if ($prepare) {
                    mysqli_stmt_bind_param($stmt, "ssssi", $firstName, $lastName, $email, $password, $course);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    $conn->close();

                    echo "<div class='alert alert-success'>You are registered successfully!</div>";
                } else {
                    die("Something went wrong");
                }

            }
            function checkFields()
            {
                $firstName = $_POST["firstname"];
                $lastName = $_POST["lastname"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $course = (int) $_POST["course"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $error = array();

                # check if all fields are empty
                if (empty($firstName) or empty($lastName) or empty($email) or empty($password) or $course == 0) {
                    array_push($error, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($error, "Email is not valid");
                }
                if (strlen($password) < 8) {
                    array_push($error, "Password must be atleast 8 characters long");
                }
                require_once "database.php";

                $query = "SELECT * FROM student WHERE emailAdd = '$email'";
                $res = mysqli_query($connection, $query);
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    array_push($error, "Email already exist!");
                }
                if (count($error) > 0) {
                    foreach ($error as $errors) {
                        echo "<div class='alert alert-danger'>$errors</div>";
                    }
                } else {
                    insertAccount($firstName, $lastName, $email, $passwordHash, $course, $connection);
                }
            }

            if (isset($_POST["submit"])) {
                checkFields();
            }
            ?>
            <form action="register.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" name="firstname" class="form-control form-control-sm" id="firstname"
                        placeholder="First Name">
                    <label for="firstname">First Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="lastname" class="form-control" id="lasttname" placeholder="Last Name">
                    <label for="lastname">Last Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <label for="course" class="form-label text-light mb-2">Course</label>
                <select class="form-select mb-3" name="course" aria-label="Default select example" id="course">
                    <option value="0" selected>Select Course</option>
                    <option value="1">Bachelor of Science in Information Technology</option>
                    <option value="2">Bachelor of Science in Civil Engineering</option>
                    <option value="3">Bachelor of Science in Electrical Engineering</option>
                </select>
                <p class="text-light text-center">Already have an account? <a href="login.php">Sign in</a></p>
                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-primary mb-4 btn-lg">Register</button>

                </div>
            </form>
        </div>
    </div>

</body>

</html>