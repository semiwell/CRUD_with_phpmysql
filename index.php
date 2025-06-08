<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Belajar PHP & Database</title>
  <style>
    main {
      padding: 2rem;
      font-family: Arial, sans-serif;
    }

    main .content {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 1rem;
    }

    main .content-box p {
      line-height: 1.6;
      color: #34495e;
    }

    .content-box {
      background-color: #ecf0f1;
      padding: 1rem;
      border-radius: 8px;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
  <?php include "layout/header.html" ?>

  <main>
    <div class="content">
    <h2>Selamat Datang di Website Saya</h2>
    <p>Halo! Ini adalah website sederhana untuk belajar <strong>PHP dan Database</strong>.</p>
    </div>
        
    <div class="content-box">
      <p>Website ini akan membantu Anda memahami dasar-dasar pemrograman backend menggunakan PHP dan cara berinteraksi dengan database seperti MySQL.</p>
      <p>Belajar PHP dan Database adalah langkah awal yang penting untuk menjadi pengembang web profesional. PHP adalah bahasa pemrograman yang digunakan untuk membangun halaman web dinamis, sedangkan database seperti MySQL digunakan untuk menyimpan dan mengelola data pengguna. Dengan memahami keduanya, kamu dapat membuat sistem login, halaman admin, dan berbagai aplikasi berbasis web lainnya. Mulailah dari dasar seperti struktur sintaks PHP, koneksi database, hingga membuat aplikasi CRUD (Create, Read, Update, Delete) sederhana. Teruslah berlatih dan eksplorasi agar kemampuanmu berkembang seiring waktu!
        Belajar PHP dan Database adalah langkah awal yang penting untuk menjadi pengembang web profesional. PHP adalah bahasa pemrograman yang digunakan untuk membangun halaman web dinamis, sedangkan database seperti MySQL digunakan untuk menyimpan dan mengelola data pengguna. Dengan memahami keduanya, kamu dapat membuat sistem login, halaman admin, dan berbagai aplikasi berbasis web lainnya. Mulailah dari dasar seperti struktur sintaks PHP, koneksi database, hingga membuat aplikasi CRUD (Create, Read, Update, Delete) sederhana. Teruslah berlatih dan eksplorasi agar kemampuanmu berkembang seiring waktu!
      </p>
      <br>
      <p>Setelah memahami dasar-dasar PHP, kamu bisa mulai belajar bagaimana PHP berinteraksi dengan database menggunakan MySQLi atau PDO. Misalnya, bagaimana menyimpan data dari form pendaftaran ke dalam database, menampilkan data ke halaman web, hingga membuat fitur pencarian dan filter. Pemahaman ini sangat berguna untuk membangun aplikasi seperti sistem manajemen konten, e-commerce, atau portal berita.
      </p>
    </div>
  </main>

  <?php include "layout/footer.html" ?>
</body>
</html>
