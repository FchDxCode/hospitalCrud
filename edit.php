<?php
include 'koneksi.php';

$kd_spesialis = $_GET['kd_spesialis'];
$spesialis = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_spesialis = $_POST['kd_spesialis'];
    $spesialis = $_POST['spesialis'];

    $sql = "UPDATE tb_spesialis SET spesialis='$spesialis' WHERE kd_spesialis='$kd_spesialis'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Record updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . $conn->error . "</div>";
    }

    header('Location: index.php');
    exit;
} else {
    $sql = "SELECT spesialis FROM tb_spesialis WHERE kd_spesialis='$kd_spesialis'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $spesialis = $row['spesialis'];
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
    <h2>Edit Spesialis</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="kd_spesialis">Kode Spesialis:</label>
            <input type="text" class="form-control" id="kd_spesialis" name="kd_spesialis" value="<?php echo $kd_spesialis; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="spesialis">Spesialis:</label>
            <input type="text" class="form-control" id="spesialis" name="spesialis" value="<?php echo $spesialis; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>

<?php $conn->close(); ?>
