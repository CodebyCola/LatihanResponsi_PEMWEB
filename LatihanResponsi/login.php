<?php
include "koneksi.php";
$error = "";
session_start();

if(isset($_GET['error']) && $_GET['error'] == 'true') {
    $error = "Belum Login.";
}

if(isset($_POST['logout'])) {
    session_destroy();
    $error = "Logout.";
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users where username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($data = $result->fetch_assoc()) {

        if ($password == $data['password']) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $data['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Login gagal! Password salah.";
        }
    } else {
        $error = "Login gagal! Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <img src="film.jpg" alt="" width="400px" height="540px">
        <div class="regist-form">
            <h2>Login</h2>
            <p>Masukkan username dan password</p>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Masukkan username anda" name="username">
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Masukkan Password anda" name="password">
                </div>
                <button type="submit" class="btn me-2 px-4 mb-3" style="background-color: #283c50; color:white;" name="login">Login</button>
                <p></p>
                <?= "<p style='color: red;'>$error</p>" ?>

                <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
            </form>
        </div>
    </div>
</body>

</html>