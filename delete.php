<?php
include 'koneksi.php';

$kd_spesialis = $_GET['kd_spesialis'];

$sql = "DELETE FROM tb_spesialis WHERE kd_spesialis='$kd_spesialis'";
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

header('Location: index.php');
exit;

$conn->close();
?>
