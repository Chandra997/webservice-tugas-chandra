<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sistem Akademik Kampus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="text-center mb-4">📚 Sistem Akademik Kampus</h1>

  <div class="row row-cols-2 row-cols-md-3 g-3">
    <?php
    $menu = [
      'mahasiswa' => 'Mahasiswa',
      'dosen' => 'Dosen',
      'mata_kuliah' => 'Mata Kuliah',
      'nilai' => 'Nilai',
      'jadwal' => 'Jadwal Kuliah',
      'absensi' => 'Absensi',
      'kelas' => 'Kelas',
      'program_studi' => 'Program Studi',
      'tahun_ajaran' => 'Tahun Ajaran',
      'pengguna' => 'Pengguna'
    ];
    foreach ($menu as $file => $label) {
      echo "
      <div class='col'>
        <div class='card shadow-sm text-center p-3'>
          <h5>$label</h5>
          <a href='{$file}.php' class='btn btn-primary btn-sm mt-2'>Lihat Data</a>
        </div>
      </div>";
    }
    ?>
  </div>
</div>

</body>
</html>
