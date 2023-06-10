<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
} elseif ($_SESSION["user"] !== "admin") {
    header("Location: home.php");
}
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
    <title>Admin</title>
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

        <h1 class='mb-3'>Welcome admin!</h1>
        <h3 class="text-center mb-3">Attendance List</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Attendance ID</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Class Name</th>
                    <th scope="col">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "database.php";

                $query = "SELECT * FROM attendance";
                $result = mysqli_query($connection, $query);

                if (!$result) {
                    die("Query failed: " . mysqli_error($connection));
                }



                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["attendanceID"] . "</td>";
                        echo "<td>" . $row["studentID"] . "</td>";
                        echo "<td>" . $row["className"] . "</td>";
                        echo "<td>" . $row["timestamp"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>NONE</td></tr>";
                }

                ?>
            </tbody>
        </table>

    </div>

</body>

</html>