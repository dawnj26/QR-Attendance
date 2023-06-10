<?php
session_start();
// if (!isset($_SESSION["user"])) {
//     header("Location: login.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.cjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/8.2.2/adapter.min.js"></script>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <title>Result</title>
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-primary px-3" data-bs-theme="dark">

        <div class="container-fluid d-flex justify-content-space-between">
            <a class="navbar-brand" href="#">QR Attendance</a>
            <!-- Links -->
            <form class="d-flex" role="search" action="result.php" method="get">
                <input class="form-control me-2" name="search" id="search" type="number" placeholder="Student ID"
                    aria-label="Search" required>
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
            <a href="logout.php" class="btn btn-warning">Log out</a>
        </div>

    </nav>
    <div class="container my-3">
        <a href="admin.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                <path
                    d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
            </svg>

        </a>

        <h3 class="text-center mb-3">Results</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Course Name</th>
                </tr>
            </thead>
            <tbody>
                <?php


                if (isset($_GET["search"])) {
                    require_once "database.php";

                    $search = (int) $_GET["search"];

                    $query = "SELECT student.studentID, student.firstName, student.lastName, student.emailAdd, course.courseName FROM student INNER JOIN course ON student.courseID = course.courseID WHERE student.studentID = $search";
                    $result = mysqli_query($connection, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($connection));
                    }

                    $row = mysqli_fetch_assoc($result);


                    if (mysqli_num_rows($result) <= 0) {
                        echo "<tr><td colspan='5' class='text-center'>NONE</td></tr>";
                    } else {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["studentID"] . "</td>";
                        echo "<td>" . $row["firstName"] . "</td>";
                        echo "<td>" . $row["lastName"] . "</td>";
                        echo "<td>" . $row["emailAdd"] . "</td>";
                        echo "<td>" . $row["courseName"] . "</td>";
                        echo "</tr>";
                    }
                }

                ?>
            </tbody>
        </table>

    </div>

</body>

</html>