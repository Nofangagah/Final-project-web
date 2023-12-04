<?php
include("connectdb.php");
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} elseif (!isset($_POST['payment_method']) || !isset($_POST['credit_card_number'])) {
    header("Location: homepage.php?pesan=tidak ada data pembayaran");
    exit();
} elseif (!isset($_GET['id'])) {
    header("Location: homepage.php?pesan=idtidakdisertakan");
    exit();
}

// Get the ID from the GET parameter
$id = $_GET['id'];

// Fetch data associated with the provided ID
$msql = "SELECT * FROM destination WHERE id='$id'";
$result = mysqli_query($connect, $msql);

if (!$result || mysqli_num_rows($result) === 0) {
    // Redirect if ID is not found or query fails
    header("Location: homepage.php?pesan=id tidak valid");
    exit();
}

if (isset($_POST['quantity'])) {
    $totalPrice = $_POST['totalprice']; 
    // Mengambil total harga dari form
    $quantity = $_POST['quantity'];
}







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pembayaran</title>
</head>
<style>
body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .title {
            color: #333;
            margin-bottom: 10px;
        }

        h1 {
            color: lightgreen;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 10px;
        }

        .result {
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .back-btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #2980b9;
        }
    </style>
<body>
    <h1 class="title">Proses Pembayaran</h1>

    
    <p>Metode Pembayaran: <?= $_POST['payment_method'] ?></p>
    <p>Nomor Kartu Kredit: <?= $_POST['credit_card_number'] ?></p>
    <?php 
    
if (isset($_POST['quantity'])){
$totalPrice=$_POST['totalprice'];
$quantity=$_POST['quantity'];
}
    $msql=("SELECT * FROM destination WHERE id=$id ");
    $take=mysqli_query($connect,$msql);
    $row=mysqli_fetch_array($take);
    ?>
    
    <p>Asal: <?= $row['asal'] ?></p>
    <p>Tujuan: <?= $row['tujuan'] ?></p>
    <p>Pesawat: <?= $row['nama_pesawat'] ?></p>
    <p>Tanggal: <?= $row['tanggal'] ?></p>
    <p>Harga Tiket: <?= $row['harga_tiket'] ?></p>
    <p>Quantity: <?= $quantity ?></p>
    <p>Total Harga: <?= $totalPrice ?></p>
<div class="result">
    <?php 
   if (isset($_POST['bayar'])) {
    $bayar = intval($_POST['bayar']); // Convert to integer
    $totalPrice = intval($_POST['totalprice']); // Convert to integer
}
if ($bayar >=$totalPrice) {
    if(isset($id)){
        $msql=mysqli_query($connect,"SELECT * FROM destination WHERE id=$id");
        $row=mysqli_fetch_array($msql);
        $asal=$row['asal'];
        $tujuan=$row['tujuan'];
        $pesawat=$row['nama_pesawat'];
        $tanggal=$row['tanggal'];
        $username=$_SESSION['username'];
        $status="lunas";
        if($_SESSION['username']) {
            $osql=mysqli_query($connect,"INSERT INTO ordered(username,asal,tujuan,pesawat,tanggal,status) VALUES('".$username."','".$asal."','".$tujuan."','".$pesawat."','".$tanggal."','".$status."');");
        }
    }

           echo"<h1>pembayaran berhasil</h1>";
        

}else {
  
    
        echo"<h1>pembayaran gagal, uang kurang</h1>";
    
}


?>
</div>
    <a href="homepage.php" class="back-btn">Kembali ke Halaman Utama</a>
</body>
</html>
