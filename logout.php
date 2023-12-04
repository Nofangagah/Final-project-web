<?php  
session_start();
session_destroy();
header('location:homepage.php?pesan=berhasil_logout');
?>