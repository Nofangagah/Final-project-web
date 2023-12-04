<?php
include("connectdb.php");
session_start();

if (isset($_POST['quantity'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $msql = "SELECT * FROM destination WHERE id='$id'";
        $result = mysqli_query($connect, $msql) or die(mysqli_error($connect));
        $row = mysqli_fetch_array($result);

        if ($row) {
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];

                // Simpan quantity ke dalam session
                $_SESSION['quantity'] = $_POST['quantity'];

                // Redirect ke halaman pembayaran
                header("Location: payment.php?id=$id");
                exit();
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
    <title>Booking</title>


    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            text-transform: capitalize;
        }
        body {
            background-image: url(img/lombok.jpeg);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
            min-height: 100vh;
           
            
            padding-bottom: 70px;
        }

        .container form {
            padding: 20px;
            width: 700px;
            border-radius: 10px;
            box-shadow: 0 5px 10px grey;
            background-color: #fff;


        }

        .container form .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .container form .row .col {
            flex: 1 1 250px;
        }

        .container form .row .col .title {

            text-align: center;
            font-size: 2opx;
            
            text-transform: uppercase;
        }

        .container form .row .col .inputbox {
           
            margin: 15px 0;
        }

        .container form .row .col .inputbox span {
            
            margin-bottom: 5px;
            display: block;
        }

        .container form .row .col .inputbox input {
            
            border-radius: 10px;
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px 15px;
            font-size: 15px;
            color: #fff;
            text-transform: none;

        }

        .container form .row .col .inputbox input {
          border: 1px solid #000;
          color: black;
        }
       

        .container form .submit-btn {
            width: 100%;
            padding: 12px;
            font-size: 17px;
            
            cursor: pointer;
            border: 1px solid #343a40; 
            color: #343a40;
            margin-top: 5px;
            border-radius: 10px;
            




        }
        .container form .submit-btn:hover {
        background-color:#343a40 ;
        color: #fff;
        
    } 
        
    </style>
</head>

<body>


    <?php
    include "connectdb.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $msql = "SELECT * FROM destination WHERE id='$id'";
        $result = mysqli_query($connect, $msql) or die(mysqli_error($connect));
        $row = mysqli_fetch_array($result);

        if ($row) { ?>

            <div class="container">

                <form action="booking.php?id=<?= $_GET['id'] ?>" method="POST">
                    <div class="row">
                        <div class="col">
                            <h3 class="title">Booking Ticket</h3>
                            <div class="inputbox">
                                <span>Asal :</span>
                                <input type="text" value="<?= $row['asal'] ?>" readonly>
                            </div>
                            <div class="inputbox">
                                <span>Tujuan : </span>
                                <input type="text" value="<?= $row['tujuan'] ?>"readonly>
                            </div>
                            <div class="inputbox">
                                <span>Pesawat : </span>
                                <input type="text" value="<?= $row['nama_pesawat'] ?>"readonly>
                            </div>
                            <div class="inputbox">
                                <span>tanggal : </span>
                                <input type="text" value="<?= $row['tanggal'] ?>"readonly>
                            </div>
                            <div class="inputbox">
                                <span>Harga : </span>
                                <input type="text" value="Rp . <?= number_format($row['harga_tiket'], 2, '.', ',')  ?>"readonly>
                            </div>

                            <?php
                            if (!isset($_POST['quantity'])) { ?>
                                <div class="inputbox">
                                    <span>Quantity : </span>
                                    <input type="number" class="form-control shadow-none" placeholder="Insert Quantity" id="quantity" name="quantity" required>
                                </div>
                            <?php } ?>

                            <?php
                            if (isset($_POST['quantity'])) {
                                $quantity = $_POST['quantity'];
                                $price = $row['harga_tiket'];
                                $totalprice = $quantity * $price;
                            ?>
                                <input type="hidden" name="totalprice" value="<?= $totalprice ?>">
                                <div class="inputbox">
                                    <span>Total :</span>
                                    <input type="text"name=total_price value="<?= $totalprice ?>"readonly>
                                </div>
                                <div class="inputbox">
                                    <span>Payment :</span>
                                    <input type="text" class="form-control shadow-none">
                                </div>
                            <?php } ?>


                        </div>
                    </div>
                    <input type="submit" class="submit-btn">
                </form>
        <?php }
    } ?>
            </div>
</body>

</html>