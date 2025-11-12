<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("location: login.php?error=true");
}

$stmt = $conn->prepare("SELECT * FROM film");
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <nav style="color: white; background-color: #283c50; padding: 1rem;">
        <h1>Manajemen FILM Bioskop</h1>
        <span>Selamat datang,</span> <span><b><?= $_SESSION['username'] ?></b></span>
        <span>| </span>
        <form action="login.php" method="POST" style="display: inline;">
            <button type="submit" name="logout" style="color: white; border: none; background: none; color: white; cursor: pointer; text-decoration: underline;">Logout
        </form>
    </nav>
    <section style="padding: 1rem;">
        <a href="tambahfilm.php"><button class="btn btn-success mb-3">Tambah Film</button></a>

        <table class="table table-bordered table-striped" style="width: 80%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Film</th>
                    <th>Sutradara</th>
                    <th>Harga Tiket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = $result->fetch_assoc()) {

                ?>
                    <tr>
                        <td><?= $data['id_film'] ?></td>
                        <td><?= $data['judul_film'] ?></td>
                        <td><?= $data['sutradara'] ?></td>
                        <td><?= $data['harga_tiket'] ?></td>
                        <td><a href="editfilm.php?id=<?= $data['id_film'] ?>" style="color: blue; text-decoration: none;">Edit</a> |
                            <a href="hapus.php?id=<?= $data['id_film'] ?>" style="color: red; text-decoration: none;" onclick="return confirm ('Yakin mau hapus data ini?')">Hapus</a>
                        </td>
                    </tr>

                <?php
                }
                ?>

                <tr style="font-weight: bold;">
                    <td colspan="3" class="text-start">Total Harga Tiket</td>
                    <td colspan="2" class="text-start">Rp 170.000</td>
                </tr>
            </tbody>
        </table>
    </section>
</body>

</html>