<?php
include 'koneksi.php';

// Handle form submission for creating a new entry
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_spesialis = $_POST['kd_spesialis'];
    $spesialis = $_POST['spesialis'];

    $sql = "INSERT INTO tb_spesialis (kd_spesialis, spesialis) VALUES ('$kd_spesialis', '$spesialis')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New record created successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Fetch data from the table
$sql = "SELECT kd_spesialis, spesialis FROM tb_spesialis";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Spesialis</title>
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
            <li class="nav-item">
                <a class="nav-link" href="pasien.php">pasien</a>
            </li>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-5">
    <h2>Tambah Spesialis</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="kd_spesialis">Kode Spesialis:</label>
            <input type="text" class="form-control" id="kd_spesialis" name="kd_spesialis" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Spesialis:</label>
            <input type="text" class="form-control" id="spesialis" name="spesialis" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>

    <h2 class="mt-5">Daftar Spesialis</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Spesialis</th>
                <th>Spesialis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['kd_spesialis']}</td>
                    <td>{$row['spesialis']}</td>
                    <td>
                        <a href='edit.php?kd_spesialis={$row['kd_spesialis']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete.php?kd_spesialis={$row['kd_spesialis']}' class='btn btn-danger btn-sm'>Delete</a>
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
