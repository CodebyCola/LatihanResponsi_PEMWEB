<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $konfirm = $_POST['konfirm'];

    if (empty($nama) || empty($username) || empty($password) || empty($konfirm)) {
        echo "<script>
    alert('Semua field wajib diisi!');</script>";
    } elseif ($password != $konfirm) {
        echo "<script>
    alert('Konfirmasi password tidak cocok!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, nama_lengkap) VALUES (? , ?, ?)");
        $stmt->bind_param('sss', $username, $password, $nama);
        $stmt->execute();
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <img src="film.jpg" alt="" width="400px" height="540px">
        <div class="regist-form">
            <h2>Register</h2>
            <p>isi semua data dengan benar</p>
            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama anda" name="nama">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Masukkan username anda" name="username">
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Masukkan Password anda" name="password">
                </div>
                <div class="mb-3">
                    <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="konfirmasi" placeholder="Konfirmasi password anda" name="konfirm">
                </div>

                <button type="submit" class="btn me-2 px-4 mb-3" style="background-color: #283c50; color:white;">Register</button>
                <a href="login.php" class="btn btn-secondary px-4 mb-3">>Kembali</a>

                <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
            </form>
        </div>
    </div>
</body>

</html>