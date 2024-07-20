<?php
include 'koneksi.php';

// Handle form submission for creating a new entry
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_dokter = $_POST['kd_dokter'];
    $nama_dokter = $_POST['nama_dokter'];
    $kd_spesialis = $_POST['kd_spesialis'];
    $telepon = $_POST['telepon'];
    $sex = $_POST['sex'];

    $sql = "INSERT INTO tb_dokter (kd_dokter, nama_dokter, kd_spesialis, telepon, sex) VALUES ('$kd_dokter', '$nama_dokter', '$kd_spesialis', '$telepon', '$sex')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New record created successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Fetch data from the table
$sql = "SELECT kd_dokter, nama_dokter, kd_spesialis, telepon, sex FROM tb_dokter";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dokter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="dokter.php">Dokter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="jaga.php">Jaga</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Spesialis</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-5">
    <h2>Tambah Dokter</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="kd_spesialis">Kode Dokter:</label>
            <input type="text" class="form-control" id="kd_dokter" name="kd_dokter" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Nama Dokter:</label>
            <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Kode Spesialis:</label>
            <input type="text" class="form-control" id="kd_spesialis" name="kd_spesialis" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Telepon:</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Jenis Kelamin:</label>
            <input type="text" class="form-control" id="sex" name="sex" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>

    <h2 class="mt-5">Daftar Spesialis</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Dokter</th>
                <th>Nama Dokter</th>
                <th>Kode Spesialis</th>
                <th>Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['kd_dokter']}</td>
                    <td>{$row['nama_dokter']}</td>
                    <td>{$row['kd_spesialis']}</td>
                    <td>{$row['telepon']}</td>
                    <td>{$row['sex']}</td>
                    <td>
                        <a href='editdokter.php?kd_dokter={$row['kd_dokter']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='deletedokter.php?kd_dokter={$row['kd_dokter']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php $conn->close(); ?>
