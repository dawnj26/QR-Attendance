<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container-fluid {
            height: 100vh;
        }

        .hero {
            height: 90%;
        }

        img {
            aspect-ratio: auto;
            width: 100%;
            border-radius: 3rem;
        }
    </style>
    <title>QR Attendance</title>
</head>

<body>

    <div class="container-fluid p-0 h-100">

        <nav class="navbar navbar-expand-sm navbar-dark bg-primary px-3">

            <div class="container d-flex justify-content-space-between m-0" style="max-width: 100%">
                <a class="navbar-brand" href="#">QR Attendance</a>
                <!-- Links -->
                <div>
                    <a href="login.php" class="btn btn-warning">Log in</a>
                    <a href="register.php" class="btn btn-success">Register</a>
                </div>

            </div>

        </nav>
    </div>


    <div class="container hero d-flex align-items-center">
        <div class="row my-4">
            <div class="col">
                <h1 class="mb-4">
                    Efficient Attendance Tracking in Schools: An automated QR Code System
                </h1>
                <p class="mb-4">
                    Upgrade your school's attendance tracking system with an automated QR code login system. Say
                    goodbye
                    to time-consuming manual processes and hello to efficiency and accuracy.
                </p>
                <a href="login.php" class="btn btn-primary">Try it now!</a>
            </div>
            <div class="col text-center">
                <img src="./img/qr_attendance.png" class="my-5" style="min-width: 20rem; max-width: 30rem;" alt="">
            </div>

        </div>

    </div>




</body>

</html>