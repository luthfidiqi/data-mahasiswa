<?php
require "functions.php";
$mahasiswa = query("SELECT * FROM mahasiswa");

// Search
if (isset($_POST["search"])) {
    $mahasiswa = search($_POST["keyword"]);
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
    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" placeholder="Masukan Pencarian..." autocomplete="off">
        <button type="submit" name="search">Search</button>
    </form>

    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>N0</th>
            <th>FOTO</th>
            <th>NRP</th>
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>JURUSAN</th>
            <th>AKSI</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $row) : ?>
            <tr>
                <td><?= $row["id"]; ?></td>
                <td> <img src="img/<?= $row["gambar"]; ?>" alt="" width="50px" height="50px"> </td>
                <td><?= $row["nrp"]; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["jurusan"]; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row["id"]; ?>">Edit</a>
                    <a href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');">Hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </table>
</body>

</html>