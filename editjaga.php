<?php
include 'koneksi.php';

$kd_dokter = $_GET['kd_dokter'];
$hari = "";
$jam_mulai = "";
$jam_selesai = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_dokter = $_POST['kd_dokter'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    $sql = "UPDATE tb_jaga SET hari='$hari', jam_mulai='$jam_mulai', jam_selesai='$jam_selesai' WHERE kd_dokter='$kd_dokter'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Record updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . $conn->error . "</div>";
    }

    header('Location: jaga.php');
    exit;
} else {
    $sql = "SELECT hari FROM tb_jaga WHERE kd_dokter='$kd_dokter'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_dokter = $row['hari'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Jadwal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Dokter</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="kd_dokter">Kode Dokter:</label>
            <input type="text" class="form-control" id="kd_dokter" name="kd_dokter" value="<?php echo $kd_dokter; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="hari">Hari:</label>
            <input type="text" class="form-control" id="hari" name="hari" value="<?php echo $hari; ?>" required>
        </div>
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai:</label>
            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="<?php echo $jam_mulai; ?>" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Jam Selesai:</label>
            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="<?php echo $jam_selesai; ?>" required>
        </div>
   
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>

<?php $conn->close(); ?>
