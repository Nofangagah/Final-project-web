<?php
include("connectdb.php");
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    if (isset($_GET['mode'])) {
        $mode = $_GET['mode'];

        if ($mode == "login") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $take = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
            $sql = mysqli_query($connect, $take);
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                header("Location: homepage.php?pesan=berhasil");
                exit;
            } else {
                header("Location: homepage.php?pesan=gagal");
                exit;
            }
        } else if ($mode == "registrasi") {
            $username = $_POST['username'];
            $pin = $_POST['pin'];
            $confirmPassword = $_POST['confirmpassword'];
            $password = $_POST['password'];

            if (strlen($password) < 8) {
                echo "
                <script>
                    alert('password minimal 8 karakter!');
                    document.location.href = 'homepage.php';
                </script>";
                exit;
            }

            if (empty($confirmPassword) || $confirmPassword !== $password) {
                echo "
                <script>
                    alert('harus sama password dan confirm!');
                    document.location.href = 'homepage.php';
                </script>";
                exit;
            }

            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $dob = $_POST['dob'];
            $address = $_POST['address'];

            if (empty($email) || empty($phone) || empty($dob) || empty($address)) {
                echo "
                <script>
                    alert('isi data dengan lengkap!');
                    document.location.href = 'homepage.php';
                </script>";
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "
                <script>
                    alert('Email tidak valid!');
                    document.location.href = 'homepage.php';
                </script>";
                exit;
            }

            if (!preg_match("/^[0-9]{10,}$/", $phone)) {
                echo "
                <script>
                    alert('nomor telepon tidak valid!');
                    document.location.href = 'homepage.php';
                </script>";
                exit;
            }

            $take = "SELECT * FROM user WHERE username='$username' OR email_address='$email' OR phone_number='$phone'";
            $sql = mysqli_query($connect, $take);

            if (mysqli_num_rows($sql) > 0) {
                echo "
                <script>
                    alert('data sudah ada langsung login aj!');
                    document.location.href = 'homepage.php';
                </script>";
                exit;
            }

            $msql = mysqli_query($connect, "INSERT INTO user(username, password, email_address, phone_number, pincode, dob, address) VALUES ('$username', '$password', '$email', '$phone', '$pin', '$dob', '$address');");

            if ($msql) {
                echo "
                <script>
                    alert('registrasi berhasillll!');
                    document.location.href = 'homepage.php';
                </script>";
                exit;
            } else {
                echo "Error: " . mysqli_error($connect);
                exit;
            }
        }
    }
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Quicksand&family=Raleway:wght@200&family=Urbanist&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }

        .h-font {
            font-family: 'Merienda', cursive;
        }

        .background-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .background-image {
            flex: 1;
            height: 100vh;
            background-size: cover;
            background-position: center;
            transition: opacity 0.5s ease;
        }

        .background-image:nth-child(1) {
            background-image: url('img/borobudurhd.jpeg');
        }

        .background-image:nth-child(2) {
            background-image: url('img/sunsetan.jpeg');
        }

        .background-image:nth-child(3) {
            background-image: url('img/rajaampat.jpeg');
        }

        .center-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .center-text p {
            font-size: 50px;
            font-family: 'Urbanist', sans-serif;
            font-weight: bold;
        }

        .proces {
            background-color: white;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: .5rem .5rem 1rem grey;


        }

        .proces-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(24rem, 1fr));
            grid-gap: 3rem;

        }

        /* .proces-item {

        } */

        .proces-icon>svg {
            width: 4rem;
            height: 4rem;
        }

        .proces-title {
            font-weight: bold;
        }

        .proces-text {
            font-size: 1rem;
        }

        .client {
            margin-top: 10rem;
        }

        .client-title-r {
            font-weight: 800;
            font-size: 2rem;
        }

        .client-countainer {
            width: 100%;
            display: flex;
            flex-direction: row;
            gap: 7.7rem;

        }

        .client-card {
            margin-top: 2rem;
            width: 300px;
            /* Set the desired width */
            background-color: white;
            box-shadow: 0.5rem 0.5rem 1rem #7f7f7f49;
            border-radius: 2rem;
            padding: 2rem;


        }

        .client-text {
            font-size: 1rem;
            color: black;
        }

        .client-details {
            display: flex;
            align-items: center;
        }

        .client-img {
            width: 50px;
            /* Set the desired width for the client image */
            height: 50px;
            border-radius: 50%;
            /* Make the client image circular */
            margin-right: 10px;
        }

        .client-title {
            font-size: 14px;

        }

        .client-name {
            margin-top: 15px;
        }

        .client-p {
            font-size: 12px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-3 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="#">Travel<span class="navbar-brand me-5 fw-bold fs-3 h-font" style="color: gold;">Tix</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if (isset($_GET['pesan' != 'berhasil']) || !isset($_SESSION['username'])) { ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex ms-auto">
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-3" data-bs-toggle="modal" data-bs-target="#loginmodal">
                        Login
                    </button>
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-3" data-bs-toggle="modal" data-bs-target="#registmodal">
                        Register
                    </button>
                </div>
            </div>
        <?php } else if(isset($_SESSION['username']) || $_GET['pesan']=='berhasil') { 
            ?>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex ms-auto">
                    <button type="button" class="btn btn-outline-warning shadow-none me-lg-3 me-3" data-bs-toggle="modal">
                        <a href="logout.php" style="text-decoration:none;color:black;"> Logout</a>
                    </button>    
                    <button type="button" class="btn btn-outline-warning shadow-none me-lg-3 me-3" data-bs-toggle="modal">
                        <a href="profile.php" style="text-decoration:none;color:black;"> Profile</a>
                    </button>
                </div>
            </div>
        <?php } ?>
    </div>
</nav>
    <div class="modal fade" id="loginmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="homepage.php?mode=login" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            <i class="bi bi-person-circle"></i> User Login
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control shadow-none" name="username" required style="border: solid black;">

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control shadow-none" name="password" required style="border: solid black;">
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3" style="margin-right:15px; margin-left :15px;">
                        <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                        <a href="resetpassword.php" class="text-secondary text-decoration-none">Forgot Password?</a>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="homepage.php?mode=registrasi" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            <i class="bi bi-person-lines-fill"></i> User Registration
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control shadow-none" name="username" required style="border: solid black;">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email address</label>
                                    <input type="text" class="form-control shadow-none" name="email" required style="border: solid black;">

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control shadow-none" name="phone" required style="border: solid black;">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Pincode</label>
                                    <input type="number" class="form-control shadow-none" name="pin" required style="border: solid black;">

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control shadow-none" name="dob" required style="border: solid black;">

                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Adress</label>
                                    <textarea class="form-control shadow-none" rows="1" name="address" required style="border: solid black;"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none" name="password" required style="border: solid black;">

                                </div>
                                <div class="col-md-6 ">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control shadow-none" name="confirmpassword" required style="border: solid black;">
                                </div>

                            </div>
                            <div class="text-center my-1">
                                <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                            </div>
                            <div class="text-center my-2">
                                <a data-bs-toggle="modal" data-bs-target="#loginmodal" class="text-secondary text-decoration-none">Already have Account?Login</a>
                            </div>
                        </div>
                    </div>
            </div>

            </form>
        </div>
    </div>
    </div>
    <?php
    if (isset($_GET['pesan'])) {
        $pesan = $_GET['pesan'];
        if ($pesan == "gagal") { ?>
            <center>
                <h3 style="color: red;">Wrong Username or password</h3>
            </center>
        <?php  } else if ($pesan == "belum") { ?>
            <center>
                <h3 style="color: red;">Register First</h3>
            </center>
        <?php } else if ($pesan == "berhasil_logout") { ?>
            <center>
                <h3 style="color: red;">YOU HAVE LOGGED OUT!!!</h3>
            </center>
        <?php } else if ($pesan == "berhasil") {
          
             ?>
            <center>
                
                <h3 style="color: green;">Login Success</h3>

            </center>
    <?php
        }
    }
    ?>
   


    <div class="background-container">
        <div class="background-image" style="background-image: url('img/yogyakarta.jpg');">

        </div>
        <div class="background-image" style="background-image: url('img/lombok.jpeg');">

        </div>
        <div class="background-image" style="background-image: url('img/bali.jpeg');">

        </div>
    </div>

    <div class="center-text">
        <p>Discover New Place and Create Unforgettable Memories</p>
    </div>

    <div class="container" style="margin-top: -4rem;">
        <div class="row">
            <div class="col-lg-12  bg-white  p-4 " style="box-shadow:.5rem .5rem 1rem grey; border-radius:1rem">
                <!-- <h5>Where do you want to go?</h5> -->
                <form action="availability.php" method="POST">
                    <div class="row">
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: 500;">Where do you want to go?</label>
                            <input type="text" class="form-control shadow-none" placeholder="insert the destination..." name="tujuan">

                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: 500;">Check Date</label>
                            <input type="date" class="form-control shadow-none" name="date">

                        </div>
                
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: 500;">Guest</label>
                            <select name="id" id="id" class="form-control shadow-none">
                                <option value="">Select an options</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>


                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-3">
                                <input type="submit" value="Check availability" class="btn btn-dark shadow-none">
                            </div>
                            <?php
                            if (isset($_SESSION['status'])){
                                $status=$_SESSION['status'];
                                if($status=="yes"){ 
                                    echo"<script>
                                    alert('sudah dibooking ini mas')
                                    </script>";
                                }
                                else if ($status=="no") {
                                    echo"<script>
                                    alert('ini masih ada mas')
                                    </script>";
                                }
                                unset($_SESSION['status']);
                            }
                            ?>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="proces container">
        <div class="proces-container">
            <div class="proces-item">
                <div class="proces-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div class="proces-title"> Search your destination</div>
                <div class="proces-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate libero vel laboriosam qui amet explicabo cumque harum ex, corporis ipsam?
                </div>
            </div>
            <div class="proces-item">
                <div class="proces-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                    </svg>

                </div>
                <div class="proces-title">Get your ticket</div>
                <div class="proces-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate libero vel laboriosam qui amet explicabo cumque harum ex, corporis ipsam?
                </div>
            </div>
            <div class="proces-item">
                <div class="proces-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                    </svg>

                </div>
                <div class="proces-title">Travel to paradise </div>
                <div class="proces-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate libero vel laboriosam qui amet explicabo cumque harum ex, corporis ipsam?
                </div>
            </div>
        </div>
    </div>






    <h3 class="mt-5 pt-4 mb-4  fw-bold h-font" style="margin-top: 3rem; font-weight:800; font-size:2rem;">Travel</h3>
    <?php
    if (isset($_SESSION['username'])) {
        if ($_SESSION['username']=="Admin" && $_SESSION['password']=="admin123"){?>
            <a href="add.php" class="btn btn-outline-warning shadow-none">Add Data</a>
            <?php
        }
    }
    ?>
    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <?php
            $query = mysqli_query($connect, "SELECT * FROM destination");
    

            if ($query) {
                while ($data = mysqli_fetch_array($query)) :
            ?>

                    <div class="col-md-4 mt-4 d-flex flex-column">
                        <div class="card border-0 shadow" style="width:18rem;">
                            <img src="img/<?= $data['image'] ?>" class="card-img-top" alt="">
                            <div class="card-body">
                                <span class="card-title" style="font-weight: bold;"><?= $data['asal'] ?></span> <span style="font-weight: bold;">-></span> <span class="card-title" style="font-weight: bold;"><?= $data['tujuan'] ?></span>
                                <p class="card-text"><?= $data['tanggal'] ?></p>
                                <div class="thumb-content">
                                    <div class="stars-rating">
                                        <ul class="list-inline">
                                            <?php
                                            $stars = 1;
                                            while ($stars <= 5) {
                                                if ($data['rate'] < $stars) {
                                            ?>

                                             <li class="list-inline-item"><i class="fa fa-star-o" style="color:gold" ></i></li>

                                                <?php

                                                } else {
                                                ?>
                                                <li class="list-inline-item"><i class="fa fa-star" style="color: gold;"></i></li>

                                            <?php

                                                }
                                                $stars++;
                                            }



                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <p class="card-text"> <i class='bx bxs-plane-alt'></i> <?= $data['nama_pesawat'] ?></p>
                                <p class="card-text">Rp. <?= number_format($data['harga_tiket'], 2, '.', ',') ?></p>
            
                                <?php 
                                if(!isset($_SESSION['username'])) {

                                    ?>
                                 <p class="text-danger">Silahkan login untuk pesan tiket.</p>
                               
                                <?php 
                                } else {
                                    ?>
                                  <a href="booking.php?id=<?= $data['id']?>" class="btn btn-outline-dark shadow-none">Booking</a>
                                  <?php if(isset($_SESSION['username']) ) {
                                    $username=$_SESSION['username'];
                                    $password=$_SESSION['password'];
                                    if($username == "Admin" && $password== "admin123") {
                                    ?>
                                      
                                        <a href="delete.php?id=<?= $data['id']?>" class="btn btn-outline-dark shadow-none">delete</a>
                                        <a href="edit.php?id=<?= $data['id']?>" class="btn btn-outline-dark shadow-none">edit</a>
                                        <?php 
                                        
                               } }?>
                                 
                                 <?php
                                }
                                ?>
                                
                                
                            </div>
                        </div>
                    </div>
                    

            <?php
            
                endwhile;
            } else {
                die("Error in SQL query: " . mysqli_error($kon));
            }
            ?>
        </div>
    </div>

    <div class="client">
        <div class="container">
            <h3 class="mt-5 pt-4 mb-4  fw-bold h-font"> CLIENT REVIEWS</h3>
        </div>
        <div class="container client-countainer">
            <div class="client-card">
                <p class="client-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam mollitia velit provident dicta enim est minima fuga molestias libero fugit?</p>
                <div class="client-details">
                    <img src="img/amba.jpg" alt="" class="client-img">
                    <div class="client-name">
                        <h4 class="client-title">Ambatukam</h4>
                        <p class="client-p">Ceo & Founder of TravelTix</p>
                    </div>
                </div>
            </div>
            <div class="client-card">
                <p class="client-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam mollitia velit provident dicta enim est minima fuga molestias libero fugit?</p>
                <div class="client-details">
                    <img src="img/amba.jpg" alt="" class="client-img">
                    <div class="client-name">
                        <h4 class="client-title">Ambatukam</h4>
                        <p class="client-p">Ceo & Founder of TravelTix</p>
                    </div>
                </div>
            </div>
            <div class="client-card">
                <p class="client-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam mollitia velit provident dicta enim est minima fuga molestias libero fugit?</p>
                <div class="client-details">
                    <img src="img/amba.jpg" alt="" class="client-img">
                    <div class="client-name">
                        <h4 class="client-title">Ambatukam</h4>
                        <p class="client-p">Ceo & Founder of TravelTix</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <h2 class="mt-5 pt-4 mb-4  fw-bold h-font">REACH US </h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 mb-lg-0 mb-3 bg-white rounded">
            <iframe  class="w-100 rounded" height="320px"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.2613866261695!2d110.28546607485728!3d-7.762079976981519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af7ab911e583f%3A0x2aba8c257c95669b!2sPuri%20Damara%20Godean!5e0!3m2!1sid!2sid!4v1700482616181!5m2!1sid!2sid"   loading="lazy" ></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Call us</h5>
                    <a href="tel : +62 895-4020-32060" class="d-inline-block mb-2 text-decoration-none text-dark">
                    <i class="bi bi-telephone-fill"></i>    +62 895-4020-32060
                    </a>
                    <br>
                    <a href="tel : +62 823-3947-7974" class="d-inline-block  text-decoration-none text-dark">
                    <i class="bi bi-telephone-fill"></i>    +62 823-3947-7974
                    </a>

                </div>
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow us</h5>
                    <a href="#" class="d-inline-block mb-3">
                   <span class="badge bg-light text-dark fs-6 p-2">
                   <i class="bi bi-instagram me-1"></i> Instagram
                   </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                   <span class="badge bg-light text-dark fs-6 p-2">
                   <i class="bi bi-facebook me-1"></i> Facebook
                   </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block ">
                   <span class="badge bg-light text-dark fs-6 p-2">
                   <i class=" bi bi-twitter-x me-1"></i> Twitter
                   </span>
                    </a>
                    
                  

                </div>

            </div>
        </div>
    </div>



    <div class="container fliud bg-white mt-5">
        <div class="row">
            <div class="col-lg-4">
                <h3 class="h-font fw-bold">Travel<span class="h-font fw-bold" style="color: gold;">Tix</span></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                     Rerum, enim! Doloribus, sint quibusdam.
                      Reprehenderit mollitia, sit aliquam cupiditate saepe iusto.
                    </p>

            </div>
            <div class="col-lg-4">
                <h5 class="mb-3">Follow us</h5>
                <a href="#" class="d-inline-block text-dark text-decoration-none mb-3"> 
                     <i class=" bi bi-twitter-x me-1"></i>Twitter
                    </a>
                <a href="#" class="d-inline-block text-dark text-decoration-none mb-3"> 
                <i class="bi bi-facebook me-1"></i>Facebook
                    </a>
                <a href="#" class="d-inline-block text-dark text-decoration-none "> 
                <i class="bi bi-instagram me-1"></i>Intagram
                    </a>
                
            </div>
        </div>
    </div>




   
<footer class="text-center py-3 bg-light">
    <p>&copy; 2023 Your Website. All Rights Reserved.</p>
</footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>