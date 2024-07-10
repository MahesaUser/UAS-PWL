<?php
// Pastikan Anda memulai session dan memeriksa koneksi database
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_penduduk");

// Periksa apakah 'id' untuk dihapus telah disediakan
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Gunakan prepared statements untuk menghindari SQL injection
    $stmt = $conn->prepare("DELETE FROM data_penduduk WHERE id = ?");
    $stmt->bind_param("i", $id); // 'i' berarti integer

    if ($stmt->execute()) {
        // Jika berhasil, redirect ke halaman yang sesuai
        header("Location: form.php");
    } else {
        // Tangani kesalahan jika perlu
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

// Tutup koneksi database
$conn->close();

?>