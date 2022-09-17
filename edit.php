<?php
require "functions.php";

// Ambil data di URL
$id = $_GET["id"];

// Query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
// var_dump($mhs);

// Cek sudah submit belum
if (isset($_POST["submit"])) {

    if (edit($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil Diedit');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "Gagal Diubah";
        echo mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="index.php">Kembali</a>
    <h1>Ubah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"] ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["id"] ?>">
        <ul>
            <li>
                <label for="">Nama :</label>
                <input type="text" id="" name="nama" value="<?= $mhs["nama"] ?>">
            </li>
            <li>
                <label for="">NRP :</label>
                <input type="text" id="" name="nrp" value="<?= $mhs["nrp"] ?>">
            </li>
            <li>
                <label for="">Email :</label>
                <input type="text" id="" name="email" value="<?= $mhs["email"] ?>">
            </li>
            <li>
                <label for="">Jurusan :</label>
                <input type="text" id="" name="jurusan" value="<?= $mhs["jurusan"] ?>">
            </li>
            <li>
                <label for="">Gambar :</label> <br>
                <img src="img/<?= $mhs["gambar"] ?>" alt="" width="50px" height="50px"> <br>
                <input type="file" id="" name="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Edit Data</button>
            </li>
        </ul>
    </form>
</body>

</html>