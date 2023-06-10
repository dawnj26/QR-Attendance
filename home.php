<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
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
    <title>Scanner</title>
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-primary px-3">

        <div class="container-fluid d-flex justify-content-space-between">
            <a class="navbar-brand" href="#">QR Attendance</a>
            <!-- Links -->
            <a href="logout.php" class="btn btn-warning">Log out</a>
        </div>

    </nav>
    <div class="container my-3">
        <?php
        $user = $_SESSION["user"];
        echo "<h1 class='mb-3'>Welcome $user!</h1>";
        ?>
        <div class="row">
            <div class="col-md-6">
                <video class="rounded" id="preview" width="100%"></video>
            </div>
            <div class="col-md-6">
                <form action="insert.php" method="post">
                    <input type="text" name="text" id="text" readonly placeholder="QR Code" class="form-control">
                </form>

            </div>
        </div>
    </div>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById("preview"), mirror: false
        })

        Instascan.Camera.getCameras().then((cameras) => {
            if (cameras.length > 0) {
                if (cameras[1] && (navigator.userAgent.match(/Android/i)
                    || navigator.userAgent.match(/webOS/i)
                    || navigator.userAgent.match(/iPhone/i)
                    || navigator.userAgent.match(/iPad/i)
                    || navigator.userAgent.match(/iPod/i)
                    || navigator.userAgent.match(/BlackBerry/i)
                    || navigator.userAgent.match(/Windows Phone/i))) {

                    scanner.start(cameras[1])
                } else {
                    scanner.start(cameras[0])
                }
            } else {
                alert("No cameras found")
            }
        }).catch((e) => {
            console.error(e)
        })

        scanner.addListener("scan", (c) => {
            document.getElementById("text").value = c
            document.forms[0].submit();
        })
    </script>
</body>

</html>