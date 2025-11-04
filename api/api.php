<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$host = "localhost";
$user = "root";
$pass = "mysql";
$db   = "akademik_kampus";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(["error" => "Koneksi gagal: " . $conn->connect_error]));
}

$table = isset($_GET['table']) ? $_GET['table'] : '';

switch ($table) {
    case 'mahasiswa':
        $sql = "SELECT m.*, p.nama_prodi 
                FROM mahasiswa m
                JOIN program_studi p ON m.id_prodi = p.id_prodi";
        break;

    case 'dosen':
        $sql = "SELECT * FROM dosen";
        break;

    case 'mata_kuliah':
        $sql = "SELECT mk.*, ps.nama_prodi 
                FROM mata_kuliah mk
                JOIN program_studi ps ON mk.id_prodi = ps.id_prodi";
        break;

    case 'nilai':
        $sql = "SELECT n.id_nilai, m.nama AS nama_mahasiswa, mk.nama_mk, n.nilai_angka, n.nilai_huruf
                FROM nilai n
                JOIN mahasiswa m ON n.id_mahasiswa = m.id_mahasiswa
                JOIN mata_kuliah mk ON n.id_mk = mk.id_mk";
        break;

    case 'kelas':
        $sql = "SELECT k.*, ps.nama_prodi 
                FROM kelas k
                JOIN program_studi ps ON k.id_prodi = ps.id_prodi";
        break;

    case 'program_studi':
        $sql = "SELECT * FROM program_studi";
        break;

    case 'jadwal':
        $sql = "SELECT j.id_jadwal, j.hari, j.jam_mulai, j.jam_selesai,
                       mk.nama_mk, d.nama AS nama_dosen, k.nama_kelas
                FROM jadwal j
                JOIN mata_kuliah mk ON j.id_mk = mk.id_mk
                JOIN dosen d ON j.id_dosen = d.id_dosen
                JOIN kelas k ON j.id_kelas = k.id_kelas";
        break;

    case 'absensi':
        $sql = "SELECT a.id_absensi, m.nama AS nama_mahasiswa, j.hari, a.tanggal, a.status
                FROM absensi a
                JOIN mahasiswa m ON a.id_mahasiswa = m.id_mahasiswa
                JOIN jadwal j ON a.id_jadwal = j.id_jadwal";
        break;

    case 'tahun_ajaran':
        $sql = "SELECT * FROM tahun_ajaran";
        break;

    case 'pengguna':
        $sql = "SELECT id_pengguna, username, role FROM pengguna";
        break;

    default:
        echo json_encode(["error" => "Parameter 'table' tidak valid atau kosong."]);
        exit;
}

$result = $conn->query($sql);
$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(["error" => "Query gagal: " . $conn->error]);
}

$conn->close();
?>
