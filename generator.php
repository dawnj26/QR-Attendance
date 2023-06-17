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

        .qr {
            opacity: 0;
            pointer-events: none;
        }

        .active {
            opacity: 1;
            pointer-events: auto;
        }

        .generate {
            width: 100%;
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

            <a href="logout.php" class="btn btn-warning mt-2">Log out</a>
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

        <div class="container d-flex flex-column">
            <div class="container d-flex flex-column align-items-center">
                <h3 class="my-3">QR code generator</h3>
                <div class="form">
                    <input type="text" name="qr" id="input" class="form-control mb-3 generate"
                        placeholder="Enter class code">
                    <button class="btn btn-primary generate" id="btn">Generate</button>
                </div>
            </div>
            <div class="container text-center w-100">
                <img style="width: 10rem;" id="qr" class="my-4 d-block qr m-auto" src="" alt="">
                <button class="btn btn-primary qr" id="download">Save QR code</button>
            </div>
        </div>
    </div>

    <script>
        const qr = document.getElementById("qr"),
            input = document.getElementById("input"),
            btn = document.getElementById("btn"),
            download = document.getElementById('download'),
            body = document.body;

        let preVal;
        let link;

        btn.addEventListener("click", () => {
            let qrVal = input.value;
            if (!qrVal) return;
            link = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' + qrVal;
            qr.src = link;
            download.classList.add('active');
            qr.classList.add("active");

        })


        download.addEventListener('click', e => {
            e.preventDefault();

            fetchFile(link);
        })

        function fetchFile(url) {
            fetch(url).then(res => res.blob()).then(file => {
                let tempUrl = URL.createObjectURL(file);
                let aTag = document.createElement('a');
                aTag.href = tempUrl;
                aTag.download = 'qr';
                body.appendChild(aTag);
                aTag.click();
                aTag.remove();
            })
        }

    </script>

</body>

</html>