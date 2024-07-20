<?php
include 'koneksi.php';

$kd_dokter = $_GET['kd_dokter'];

$sql = "DELETE FROM tb_dokter WHERE kd_dokter='$kd_dokter'";
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

header('Location: dokter.php');
exit;

$conn->close();
?>