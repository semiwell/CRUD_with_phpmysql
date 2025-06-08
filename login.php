<?php 
include "service/database.php";
session_start();

$login_message = "";

if (isset($_SESSION["is_login"])) {
  header("location: dashboard.php");
  exit();
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    
    if (password_verify($password, $data['password'])) {
      $_SESSION["username"] = $data["username"];
      $_SESSION["is_login"] = true;
      header("location: dashboard.php");
      exit();
    } else {
      $login_message = "Password salah.";
    }
  } else {
    $login_message = "Akun tidak ditemukan.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
</head>
<body>
  <?php include "layout/header.html" ?>

  <main>
    <style>
      .login-wrapper {
        max-width: 400px;
        margin: 60px auto;
        padding: 2rem;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
      }

      .login-wrapper h3 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 1.5rem;
      }

      .login-wrapper form {
        display: flex;
        flex-direction: column;
      }

      .login-wrapper input {
        padding: 10px;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
      }

      .login-wrapper button {
        padding: 10px;
        background-color: #2c3e50;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s;
      }

      .login-wrapper button:hover {
        background-color: #34495e;
      }

      .login-wrapper .error-message {
        color: red;
        text-align: center;
        margin-bottom: 1rem;
        font-size: 0.95rem;
      }
    </style>

    <div class="login-wrapper">
      <h3>LOGIN AKUN</h3>
      <?php if (!empty($login_message)) : ?>
        <div class="error-message"><?= htmlspecialchars($login_message) ?></div>
      <?php endif; ?>
      <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit" name="login">Masuk Sekarang</button>
      </form>
    </div>
  </main>

  <?php include "layout/footer.html" ?>
</body>
</html>
