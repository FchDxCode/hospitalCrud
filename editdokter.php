<?php
include 'koneksi.php';

$kd_dokter = $_GET['kd_dokter'];
$nama_dokter = "";
$kd_spesialis = "";
$telepon = "";
$sex = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_dokter = $_POST['kd_dokter'];
    $nama_dokter = $_POST['nama_dokter'];
    $kd_spesialis = $_POST['kd_spesialis'];
    $telepon = $_POST['telepon'];
    $sex = $_POST['sex'];

    $sql = "UPDATE tb_dokter SET nama_dokter='$nama_dokter', kd_spesialis='$kd_spesialis', telepon='$telepon', sex='$sex' WHERE kd_dokter='$kd_dokter'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Record updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . $conn->error . "</div>";
    }

    header('Location: dokter.php');
    exit;
} else {
    $sql = "SELECT nama_dokter FROM tb_dokter WHERE kd_dokter='$kd_dokter'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_dokter = $row['nama_dokter'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Spesialis</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Dokter</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="kd_">Kode Dokter:</label>
            <input type="text" class="form-control" id="kd_dokter" name="kd_dokter" value="<?php echo $kd_dokter; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="spesialis">Nama Dokter:</label>
            <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="<?php echo $nama_dokter; ?>" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Kode Spesialis:</label>
            <input type="text" class="form-control" id="kd_spesialis" name="kd_spesialis" value="<?php echo $kd_spesialis; ?>" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Telepon:</label>
            <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $telepon; ?>" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Jenis Kelamin:</label>
            <input type="text" class="form-control" id="sex" name="sex" value="<?php echo $sex; ?>" required>
        </div>
   
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>

<?php $conn->close(); ?>
