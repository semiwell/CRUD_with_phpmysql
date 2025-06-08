<?php
include "service/database.php";
session_start();

$register_message = "";

if (isset($_SESSION["is_login"])) {
  header("location: dashboard.php");
  exit();
}

if (isset($_POST["register"])) {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  if ($username === "" || $password === "") {
    $register_message = "Username dan password tidak boleh kosong.";
  } else {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
      // Hash password sebelum disimpan
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->bind_param("ss", $username, $hashed_password);

      if ($stmt->execute()) {
        $register_message = "Daftar berhasil, silakan <a href='login.php'>login</a>.";
      } else {
        $register_message = "Terjadi kesalahan saat menyimpan data.";
      }
    } catch (mysqli_sql_exception $e) {
      $register_message = "Username sudah digunakan, silakan ganti.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Page</title>
</head>
<body>

<?php include "layout/header.html" ?>

<main>
  <style>
    .register-wrapper {
      max-width: 400px;
      margin: 60px auto;
      padding: 2rem;
      background: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      font-family: Arial, sans-serif;
    }

    .register-wrapper h3 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 1.5rem;
    }

    .register-wrapper form {
      display: flex;
      flex-direction: column;
    }

    .register-wrapper input {
      padding: 10px;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    .register-wrapper button {
      padding: 10px;
      background-color: #2c3e50;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s;
    }

    .register-wrapper button:hover {
      background-color: #34495e;
    }

    .register-wrapper .message {
      text-align: center;
      color: #c0392b;
      font-size: 0.95rem;
      margin-bottom: 1rem;
    }

    .register-wrapper .message a {
      color: #2980b9;
      text-decoration: none;
    }
  </style>

  <div class="register-wrapper">
    <h3>DAFTAR AKUN</h3>

    <?php if (!empty($register_message)) : ?>
      <div class="message"><?= $register_message ?></div>
    <?php endif; ?>

    <form action="register.php" method="POST">
      <input type="text" placeholder="Username" name="username" required />
      <input type="password" placeholder="Password" name="password" required />
      <button type="submit" name="register">Daftar Sekarang</button>
    </form>
  </div>
</main>

<?php include "layout/footer.html" ?>
</body>
</html>
