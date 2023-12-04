
<?php
// Include file koneksi ke database
include("connectdb.php");

// Mulai session
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Redirect ke halaman login jika belum login
    header("Location: login.php");
    exit();
}

// Periksa apakah ada data tiket yang disimpan di session
if (!isset($_SESSION['quantity'])) {
    // Redirect ke halaman sebelumnya jika tidak ada data tiket
    header("Location: index.php"); // Ganti dengan halaman sebelumnya
    exit();
}

// Ambil informasi tiket dari database berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $msql = "SELECT * FROM destination WHERE id='$id'";
    $result = mysqli_query($connect, $msql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($result);

    if (!$row) {

        header("Location: index.php");
        exit();
    }
} else {
    // Redirect ke halaman sebelumnya jika ID tidak disertakan
    header("Location: index.php"); // Ganti dengan halaman sebelumnya
    exit();
}

// Ambil data quantity dari session
$quantity = $_SESSION['quantity'];

// Hitung total harga
$totalPrice = $quantity * $row['harga_tiket'];


unset($_SESSION['quantity']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Tiket Pesawat</title>
    

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Quicksand&family=Raleway:wght@200&family=Urbanist&display=swap');
    *{
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-transform: capitalize;
        transition: all .2s linear;

    }
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 25px;
        min-height: 100vh;
        padding-bottom: 70px;
        background-image: url(img/lombok.jpeg);
        background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
    
        
        
    }
    .container form {
        padding: 20px;
        width: 700px;
        background-color: #fff;
        box-shadow: 0 5px 10px grey;
        border-radius: 10px;
        

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
        font-size: 20px;
        color: #333;
        padding-bottom: 5px;
        text-transform: uppercase;
        

    }
    .container form .row .col .inputbox {
        margin: 15px 0;
        
    }
    .container form .row .col .inputbox span {
        margin-bottom:10px ;
        display: block;
        text-align: center;
        

    }
    .container form .row .col .inputbox input {
        background-color :#fff;
        width: 100%;
        border:1px solid black;
        padding: 10 px 15px;
        font-size: 15px;
        text-transform: none;
        font-weight: bold;
        text-align: center;
        
        
        

    }
    .container form .row .col .inputbox input:focus {
        border: 1px solid #000;
    }
    .container form .row .col .inputbox img {
        height: 34px;
        margin-top: 5px;
        filter: drop-shadow(0 0 1px #000);
    }
     .container form .submit-btn {
        width: 100%;
        padding: 12px;
        font-size: 17px;
        color: white;
        margin-top: 5px;
     cursor: pointer;
     padding: 10px 20px;
    border: 1px solid #343a40; 
    background-color: transparent;
    color: #343a40;
    border-radius: 10px;

        
    }
    .container form .submit-btn:hover {
        background-color:#343a40 ;
        color: white;
    } 
    .container form .row .col .inputbox select {
        border: 1px solid #ccc;
    }
     
</style>

<body>
   


    <div class="container">
        <form action="proses_pembayaran.php?id=<?=$row['id']?>" method="post">
            <div class="row">
                <div class="col">
                    <h3 class="title">Information detail</h3>
                    <div class="inputbox">
                        <span>Asal</span>
                        <input type="text" value="<?= $row['asal'] ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <span>Tujuan</span>
                        <input type="text" value="<?= $row['tujuan'] ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <span>Pesawat</span>
                        <input type="text" value="<?= $row['nama_pesawat'] ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <span>Tanggal</span>
                        <input type="text" value="<?= $row['tanggal'] ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <span>Harga Tiket</span>
                        <input type="text" value=" Rp. <?=number_format($row['harga_tiket'], 2, '.', ',') ?>" readonly>
                    </div>
                    </div>
                   <div class="col">
                    <h3 class="title">Payment</h3>
                    
                    <div class="inputbox">
                        <span>Quantity</span>
                        <input type="text" name="quantity" value="<?= $quantity ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <span>Total harga</span>
                        <input type="text" name="totalprice" value="<?=$totalPrice?>" placeholder="Rp. <?=number_format($totalPrice , 2, '.', ',') ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <span>Pembayaran yang Tersedia</span>
                        <img src="img/card_img.png" alt="">
                    </div>
                    <div class="inputbox">
                        <span>Metode Pembayaran</span>
                        <select name="payment_method" id="payment_method" required>
                            <option value="paypal">PayPal</option>
                            <option value="master_card">Master card</option>
                            <option value="american_express">American express</option>
                            <option value="visa">Visa</option>
                        </select>
                    </div>
                    <div class="inputbox">
                       <span>Nomer kartu Kredit</span>
                       <input type="number" name="credit_card_number" id="credit_card_number" required>
                    </div>
                    <div class="inputbox">
                       <span>Bayar </span>
                       <input type="number" name="bayar" id="bayar" required>
                    </div>
                    </div>
               
            </div>
            <input type="submit" value="Bayar" class="submit-btn">
            
        </form>
    </div>


</body>

</html>