<?php
require "functions.php";

// Cek sudah submit belum
if (isset($_POST["submit"])) {

    // var_dump($_POST);
    // var_dump($_FILES) die;

    if (tambah($_POST) > 0) {
        echo "Berhasil Ditambahkan <br>";
    } else {
        echo "Gagal Ditambahkan <br>";
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
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="">Nama :</label>
                <input type="text" id="" name="nama" require>
            </li>
            <li>
                <label for="">NRP :</label>
                <input type="text" id="" name="nrp" require>
            </li>
            <li>
                <label for="">Email :</label>
                <input type="text" id="" name="email" require>
            </li>
            <li>
                <label for="">Jurusan :</label>
                <input type="text" id="" name="jurusan" require>
            </li>
            <li>
                <label for="">Gambar :</label>
                <input type="file" id="" name="gambar" require>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
</body>

</html>