<?php
include ("connectdb.php");
session_start();
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $msql=mysqli_query($connect,"DELETE FROM destination WHERE id=$id ");
    header("location:homepage.php");
}
?>