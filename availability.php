<?php
include("connectdb.php");
session_start();

if (isset( $_POST['tujuan'])) {
    $id=$_POST['id'];
    $tujuan=$_POST['tujuan'];
    $date=$_POST['date'];
    $msql = mysqli_query($connect, "SELECT * FROM ordered WHERE id='$id' AND tujuan='$tujuan' AND tanggal='$date'");
        if ( $row=mysqli_fetch_array($msql)) {
          
            $tujuan=$row['tujuan'];
            echo "$tujuan";
            $status="yes";
            $_SESSION['status']=$status;
            header("location:homepage.php");
        } else  {
            
            $status="no";
            $_SESSION['status']=$status;
          header("location:homepage.php");
        }
    
} 

?>




