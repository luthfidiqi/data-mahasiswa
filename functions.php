<?php
// Koneksi ke database
$db = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $db;

    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    // $gambar = htmlspecialchars($data["gambar"]);

    // Upload Gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES ('', '$nama', '$nrp','$email','$jurusan','$gambar' )";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "Pilih gambar terlebih dahulu <br>";
        return false;
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "Ekstensi buka gambar <br>";
        return false;
    }

    // Cek Ukuran Gambar (1 mb)
    if ($ukuranFile > 1000000) {
        echo "Ukuran gambar terlalu besar <br>";
        return false;
    }

    // Generate nama file gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // Lolos cek, gambar diupload
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function delete($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($db);
}

function edit($data)
{
    global $db;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek user upload gambar baru
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE mahasiswa SET 
                nama = '$nama',
                nrp = '$nrp',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function search($keyword)
{
    $query = "SELECT * FROM mahasiswa WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";
    return query($query);
}
