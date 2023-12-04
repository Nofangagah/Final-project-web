<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            margin-top: 20px;
            background-image: url(img/lombok.jpeg);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;

        }

        .main {
            padding: 15px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .card {

            position: relative;
            display: flex;
            flex-direction: column;
            width: 500px;
            height: 500px;
        }

        .content {
            background-color: whitesmoke;
        }

        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    <section class="profile-container">
        <?php
        session_start();
        include "connectdb.php";

        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            $query = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($connect, $query) or die(mysqli_error($connect));

            if ($result) {
                $userData = mysqli_fetch_assoc($result);
        ?>
                <div class="row">
                    <div class="col-md-8 mt-1">
                        <div class="card mb-3 content " style="background-color: black;">
                            <div class="card-body" style="  color:white; border-radius:10px;">
                                <div class="text-center">
                                    <img src="img/amba.jpg" alt="" width="150" style="border-radius: 50%; ">
                                </div>
                                <div class="mt-3 text-center">
                                    <h3 style="text-transform: uppercase;"><?= $userData['username'] ?></h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Username: </h5>
                                    </div>
                                    <div class="col-md-9 text-white">
                                        <?= $userData['username'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>email : </h5>
                                    </div>
                                    <div class="col-md-9 text-white">
                                        <?= $userData['email_address'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Phone : </h5>
                                    </div>
                                    <div class="col-md-9 text-white">
                                        <?= $userData['phone_number'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Address : </h5>
                                    </div>
                                    <div class="col-md-9 text-white">
                                        <?= $userData['address'] ?>
                                    </div>
                                </div>

                                <hr>

                            </div>
                        </div>

                <?php
            } else {
                echo "Query gagal.";
            }
        } else {
            session_destroy();
            header("Location: homepage.php?pesan=gagal");
            exit;
        }
                ?>
    </section>

</body>

</html>