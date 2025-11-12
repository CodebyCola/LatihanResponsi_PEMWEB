<?php
include "koneksi.php";

if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $sutradara = $_POST['sutradara'];
    $harga = $_POST['harga'];

    if (!empty($judul) && !empty($sutradara) && !empty($harga)) {
        $stmt = $conn->prepare("INSERT INTO film (judul_film, sutradara, harga_tiket) VALUES (?, ?, ?)");
        $stmt->bind_param('ssi', $judul, $sutradara, $harga);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal menambahkan film: " . $conn->error;
        }
    } else {
        echo "<script>
    alert('Semua field wajib diisi');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <nav style="color: white; background-color: #283c50; padding: 1rem;">
        <h1>Tambah FILM Baru</h1>
        <span>Isi Form untuk menambahkan film</span>
    </nav>

    <section style="padding: 1rem;">
        <form action="tambahfilm.php" method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul FILM</label>
                <input type="text" class="form-control" id="judul" placeholder="Masukkan judul film" name="judul">
            </div>
            <div class="mb-3">
                <label for="Sutradara" class="form-label">Sutradara</label>
                <input type="text" class="form-control" id="Sutradara" placeholder="Masukkan nama sutradara" name="sutradara">
            </div>
            <div class="mb-3">
                <label for="Harga" class="form-label">Harga Tiket (Rp)</label>
                <input type="text" class="form-control" id="Harga" placeholder="Masukkan harga tiket" name="harga">
            </div>

            <button type="submit" class="btn btn-success px-4" name="tambah">Simpan</button>
            <a href="index.php" class="btn btn-secondary px-4">Kembali</a>
        </form>
    </section>
</body>


</html>
