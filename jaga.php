<?php
include 'koneksi.php';

// Handle form submission for creating a new entry
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_dokter = $_POST['kd_dokter'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    $sql = "INSERT INTO tb_jaga (kd_dokter, hari, jam_mulai, jam_selesai) VALUES ('$kd_dokter', '$hari', '$jam_mulai', '$jam_selesai')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New record created successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Fetch data from the table
$sql = "SELECT kd_dokter, hari, jam_mulai, jam_selesai FROM tb_jaga";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jaga</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
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
    <h2>Tambah Jaga</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="kd_dokter">Kode Dokter:</label>
            <input type="text" class="form-control" id="kd_dokter" name="kd_dokter" required>
        </div>
        <div class="form-group">
            <label for="hari">Hari:</label>
            <input type="text" class="form-control" id="hari" name="hari" required>
        </div>
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai:</label>
            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
        </div>
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai:</label>
            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>

    <h2 class="mt-5">Daftar Jaga</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Dokter</th>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['kd_dokter']}</td>
                    <td>{$row['hari']}</td>
                    <td>{$row['jam_mulai']}</td>
                    <td>{$row['jam_selesai']}</td>
                    <td>
                    <a href='editjaga.php?kd_dokter={$row['kd_dokter']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='deletejaga.php?kd_dokter={$row['kd_dokter']}' class='btn btn-danger btn-sm'>Delete</a>
                </td>

                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
