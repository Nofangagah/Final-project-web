<?php
include ("connectdb.php");
session_start();

if(isset($_POST["asal"])) {
    $id = $_GET['id'];
    $asal = mysqli_real_escape_string($connect, $_POST["asal"]);
    $tujuan = mysqli_real_escape_string($connect, $_POST["tujuan"]);
    $tanggal = mysqli_real_escape_string($connect, $_POST["tanggal"]);
    $pesawat = mysqli_real_escape_string($connect, $_POST["pesawat"]);
    $harga = mysqli_real_escape_string($connect, $_POST["harga"]);
    $rate = mysqli_real_escape_string($connect, $_POST["rate"]);
    $filename = $_FILES['image']['name'];
    $filenametemp = $_FILES['image']['tmp_name'];
    $fileextension = pathinfo($filename, PATHINFO_EXTENSION);
    $filedestination = 'img/' . $filename;

    if(!in_array($fileextension, ['pdf', 'jpg', 'jpeg', 'png'])) {
        echo "Your file must be in PDF, JPG, JPEG, or PNG format.";
    } else {
        if(move_uploaded_file($filenametemp, $filedestination)) {
            $sql = "UPDATE destination SET asal = '$asal', tujuan = '$tujuan', tanggal = '$tanggal', nama_pesawat = '$pesawat', harga_tiket = '$harga', rate = '$rate', image = '$filename' WHERE id = '$id'";
            $result = mysqli_query($connect, $sql);
            if($result) {
                header("location: homepage.php");
                exit;
            } else {
                echo "Failed to update data.";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
  .garis {
  width: 100%;
  height: 2px;
  background-color: rgba(0, 0, 0, 0.8);
  border-radius: 10px;
  margin-bottom: 8px;
}


</style>
<body>
    <?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $msql = mysqli_query($connect,"SELECT * FROM destination WHERE id = $id");
        if ($row = mysqli_fetch_array($msql)) {?>
         
        <div class="text-center">
          <h2>Edit Destinasi</h2>
          <div class="garis"></div>
        </div>
            <form action="edit.php?id=<?= $row['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class=" d-flex flex-wrap justify-content-start gap-2 mx-2">
          <div class="w-75 d-flex flex-column align-items-center">
            <h4 class="col-4">Foto destinasi : </h4>
            <div class="d-flex justify-content-start align-items-center gap-2">
              <img src="img/unknown_profile.png" id="imageView" class="bg-secondary progilePictureView mt-2 rounded-4  " width="100px" height="100px">
              <div class="w-40 mx-auto">
                <input id="file-upload" type="file" name="image" class="w-100" />
              </div>
            </div>
          </div>

          <div class="w-50 mx-auto ">
            <h4 class="mt-2">Asal: </h4>
            <input type="text" name="asal" class="form-control border-black"value="<?= $row['asal'] ?>" placeholder="asal">
          </div>
          <div class="w-50 mx-auto ">
            <h4 class="mt-2">tujuan : </h4>
            <input type="text"name="tujuan" class="form-control border-black" value="<?= $row['tujuan'] ?>"  placeholder="tujuan">
          </div>
          <div class="w-50 mx-auto ">
            <h4 class="mt-2">Tanggal : </h4>
            <input type="date"   name="tanggal" class="form-control border-black" value="<?= $row['tanggal'] ?>" placeholder="Email">
          </div>
          <div class="w-50 mx-auto ">
            <h4 class="mt-2">Pesawat : </h4>
            <input type="text"  name="pesawat" class="form-control border-black" value="<?= $row['nama_pesawat'] ?>" placeholder="Contoh : Mahasiswa yang suka memasak">
          </div>
          <div class="w-50 mx-auto ">
            <h4 class="mt-2">Harga: </h4>
            <input type="text" name="harga" class="form-control border-black" value="<?= $row['harga_tiket'] ?>" placeholder="Contoh : Mahasiswa yang suka memasak">
          </div>
          <div class="w-50 mx-auto ">
            <h4 class="mt-2">Rate : </h4>
            <input type="text"name="rate" class="form-control border-black" value="<?= $row['rate'] ?>" placeholder="Contoh : Mahasiswa yang suka memasak">
          </div>

          

          <div class="w-100 d-flex justify-content-center mt-4">
            <button type="submit" value="submit" class="btn btn-warning">Submit</button>
          </div>

        </div>

            </form>
        <?php
        }
    }
    ?>
</body>
</html>


