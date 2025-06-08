<?php
include "service/database.php";
session_start();

// Cek login
if (empty($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

// Logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('location: index.php');
    exit();
}

$register_message = "";
$update_message = "";
$delete_message = "";
$editing_data = null;

// Tambah data
if (isset($_POST["add_data"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $category_id = $_POST["category_id"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $sql = "INSERT INTO books (name, description, category_id) VALUES ('$name', '$description', '$category_id')";
        if ($db->query($sql)) {
            $register_message = "Data berhasil ditambahkan.";
        } else {
            $register_message = "Gagal menambah data.";
        }
    } catch (mysqli_sql_exception) {
        $register_message = "Terjadi kesalahan saat menambahkan data.";
    }
}

// Edit data - ambil data untuk ditampilkan di form
if (isset($_POST['edit'])) {
    $edit_id = $_POST['id'];
    $edit_sql = "SELECT * FROM books WHERE id = '$edit_id'";
    $edit_result = $db->query($edit_sql);
    if ($edit_result->num_rows > 0) {
        $editing_data = $edit_result->fetch_assoc();
    }
}

// Update data
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $category_id = $_POST["category_id"];

    try {
        $sql_update = "UPDATE books SET name = '$name', description = '$description', category_id = '$category_id' WHERE id = '$id'";
        if ($db->query($sql_update)) {
            $update_message = "Data berhasil diupdate.";
        } else {
            $update_message = "Gagal update data.";
        }
    } catch (mysqli_sql_exception) {
        $update_message = "Terjadi kesalahan saat update.";
    }
}

// reset data
if (isset($_POST["reset"])) {
    $edit_data = [];
}

// Hapus data
if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $sql_delete = "DELETE FROM books WHERE id = '$id'";
        if ($db->query($sql_delete)) {
            $delete_message = "Data berhasil dihapus.";
        } else {
            $delete_message = "Gagal menghapus data.";
        }
    } catch (mysqli_sql_exception) {
        $delete_message = "Terjadi kesalahan saat menghapus.";
    }
}

// Ambil semua data
$sql = "SELECT a.id, a.name AS book_name, b.name AS category_name, a.description FROM `books` AS a LEFT JOIN categories AS b ON b.id = a.category_id";
$result = $db->query($sql);

$queryCategory = "SELECT * FROM categories";

$resultCategories = $db->query($queryCategory);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pengguna</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>

  </style>
</head>
<body>

  <?php include "layout/header.html" ?>

  <h2>Data Pengguna</h2>

  <div class="form-add">
    <i><?= $register_message ?></i><br>
    <i><?= $update_message ?></i><br>
    <i><?= $delete_message ?></i>
    
    <form action="dashboard.php" method="POST">
      <input type="text" placeholder="name" name="name" value="<?= $editing_data ? htmlspecialchars($editing_data['name']) : '' ?>" required>
      <input type="text" placeholder="description" name="description" value="<?= $editing_data ? htmlspecialchars($editing_data['description']) : '' ?>" required>
      <select class="selection" name="category_id" value="<?= $editing_data ? htmlspecialchars($editing_data['name']) : '' ?>" required>
      <?php foreach ($resultCategories as $key => $value) {
    $selected = ($value['id'] == $editing_data['category_id']) ? 'selected' : '';
    echo "<option value='" . $value['id'] . "' $selected>" . $value['name'] . "</option>";
} ?>
      </select>
      <?php if ($editing_data): ?>
        <input type="hidden" name="id" value="<?= $editing_data['id'] ?>">
        <button type="submit" name="update">Update Data</button>
        <button type="submit" name="reset">reset</button>
      <?php else: ?>
        <button type="submit" name="add_data">Tambah Data</button>
      <?php endif; ?>
    </form>
  </div>
  
  <table>
      <tr>
          <th>name</th>
          <th>category</th>
          <th>description</th>
          <th>Aksi</th>
      </tr>
      <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                  <td><?php echo htmlspecialchars($row['book_name']); ?></td>
                  <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                  <td><?php echo htmlspecialchars($row['description']); ?></td>
                  <td>
                    <form method="POST" action="dashboard.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="edit">Edit</button>
                    </form>
                    <form method="POST" action="dashboard.php" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                  </td>
              </tr>
          <?php endwhile; ?>
      <?php else: ?>
          <tr><td colspan="3">Belum ada data</td></tr>
      <?php endif; ?>
  </table>

  <?php include "layout/footer.html" ?>

</body>
</html>
