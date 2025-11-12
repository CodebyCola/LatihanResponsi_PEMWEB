<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM film WHERE id_film = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $sutradara = $_POST['sutradara'];
    $harga = (int)$_POST['harga'];

    if (!empty($judul) && !empty($sutradara) && !empty($harga)) {
        $update = $conn->prepare("UPDATE film SET judul_film = ?, sutradara = ?, harga_tiket = ? WHERE id_film = ?");
        $update->bind_param('ssii', $judul, $sutradara, $harga, $id);

        if ($update->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal memperbarui data: " . $conn->error;
        }
    } else {
        echo "<script>alert('Semua field wajib diisi');</script>";
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
        <h1>Edit FILM</h1>
        <span>Perbarui informasi FILM</span>
    </nav>

    <section style="padding: 1rem;">
        <form action="editfilm.php" method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">ID Film</label>
                <input type="text" class="form-control" id="id" value="<?= $data['id_film'] ?>" disabled>
                <input type="hidden" name="id" value="<?= $data['id_film'] ?>">
            </div>

            <div class="mb-3">
                <label for="judul" class="form-label">Judul FILM</label>
                <input type="text" class="form-control" id="judul" placeholder="Masukkan nama anda" name="judul" value="<?= $data['judul_film'] ?>">
            </div>
            <div class="mb-3">
                <label for="Sutradara" class="form-label">Sutradara</label>
                <input type="text" class="form-control" id="Sutradara" placeholder="Masukkan nama anda" name="sutradara" value="<?= $data['sutradara'] ?>">
            </div>
            <div class="mb-3">
                <label for="Harga" class="form-label">Harga Tiket (Rp)</label>
                <input type="text" class="form-control" id="Harga" placeholder="Masukkan nama anda" name="harga" value="<?= $data['harga_tiket'] ?>">
            </div>

            <button type="submit" class="btn btn-success px-4" name="edit">Perbarui</button>
            <a href="index.php" class="btn btn-secondary px-4">Kembali</a>
        </form>
    </section>
</body>

</html>