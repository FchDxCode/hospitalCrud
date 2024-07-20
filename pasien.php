<?php
include 'koneksi.php';
// Initialize variables
$action = isset($_GET['action']) ? $_GET['action'] : '';
$kd_pasien = isset($_GET['kd_pasien']) ? $_GET['kd_pasien'] : '';
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kd_pasien = $_POST['kd_pasien'];
    $nama_pasien = $_POST['nama_pasien'];
    $alamat_pasien = $_POST['alamat_pasien'];
    $umur_pasien = $_POST['umur_pasien'];
    $sex = $_POST['sex'];
    $telepon = $_POST['telepon'];
    $spesialis = $_POST['spesialis'];

    if ($action == 'add') {
        $sql = "INSERT INTO tb_pasien (nama_pasien, alamat_pasien, umur_pasien, sex, telepon, spesialis) VALUES ('$nama_pasien', '$alamat_pasien', $umur_pasien, '$sex', '$telepon', '$spesialis')";
        if ($conn->query($sql) === TRUE) {
            $message = "New record created successfully";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action == 'edit') {
        $sql = "UPDATE tb_pasien SET nama_pasien='$nama_pasien', alamat_pasien='$alamat_pasien', umur_pasien=$umur_pasien, sex='$sex', telepon='$telepon', spesialis='$spesialis' WHERE kd_pasien=$kd_pasien";
        if ($conn->query($sql) === TRUE) {
            $message = "Record updated successfully";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Handle deletion
if ($action == 'delete' && !empty($kd_pasien)) {
    $sql = "DELETE FROM tb_pasien WHERE kd_pasien=$kd_pasien";
    if ($conn->query($sql) === TRUE) {
        $message = "Record deleted successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch data for edit
if ($action == 'edit' && !empty($kd_pasien)) {
    $sql = "SELECT * FROM tb_pasien WHERE kd_pasien=$kd_pasien";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $kd_pasien = $row['kd_pasien'];
    $nama_pasien = $row['nama_pasien'];
    $alamat_pasien = $row['alamat_pasien'];
    $umur_pasien = $row['umur_pasien'];
    $sex = $row['sex'];
    $telepon = $row['telepon'];
    $spesialis = $row['spesialis'];
} else {
    $kd_pasien = '';
    $nama_pasien = '';
    $alamat_pasien = '';
    $umur_pasien = '';
    $sex = '';
    $telepon = '';
    $spesialis = '';
}

// Fetch all data
$sql = "SELECT * FROM tb_pasien";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien</title>
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
            <li class="nav-item">
                <a class="nav-link" href="pasien.php">Pasien</a>
            </li>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-5">
    <h1>Data Pasien</h1>
    <?php if ($message): ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Pasien</th>
                <th>Nama Pasien</th>
                <th>Alamat Pasien</th>
                <th>Umur Pasien</th>
                <th>Sex</th>
                <th>Telepon</th>
                <th>Spesialis</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['kd_pasien']; ?></td>
                <td><?php echo $row['nama_pasien']; ?></td>
                <td><?php echo $row['alamat_pasien']; ?></td>
                <td><?php echo $row['umur_pasien']; ?></td>
                <td><?php echo $row['sex']; ?></td>
                <td><?php echo $row['telepon']; ?></td>
                <td><?php echo $row['spesialis']; ?></td>
                <td>
                    <a href="?action=edit&kd_pasien=<?php echo $row['kd_pasien']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?action=delete&kd_pasien=<?php echo $row['kd_pasien']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <h2><?php echo $action == 'edit' ? 'Edit' : 'Tambah'; ?> Pasien</h2>
    <form method="post" action="?action=<?php echo $action == 'edit' ? 'edit' : 'add'; ?>">
        <?php if ($action == 'edit'): ?>
            <input type="hidden" name="kd_pasien" value="<?php echo $kd_pasien; ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="nama_pasien">Nama Pasien:</label>
            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?php echo $nama_pasien; ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat_pasien">Alamat Pasien:</label>
            <input type="text" class="form-control" id="alamat_pasien" name="alamat_pasien" value="<?php echo $alamat_pasien; ?>" required>
        </div>
        <div class="form-group">
            <label for="umur_pasien">Umur Pasien:</label>
            <input type="number" class="form-control" id="umur_pasien" name="umur_pasien" value="<?php echo $umur_pasien; ?>" required>
        </div>
        <div class="form-group">
            <label for="sex">Sex:</label>
            <input type="text" class="form-control" id="sex" name="sex" value="<?php echo $sex; ?>" required>
        </div>
        <div class="form-group">
            <label for="telepon">Telepon:</label>
            <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $telepon; ?>" required>
        </div>
        <div class="form-group">
            <label for="spesialis">Spesialis:</label>
            <input type="text" class="form-control" id="spesialis" name="spesialis" value="<?php echo $spesialis; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $action == 'edit' ? 'Update' : 'Tambah'; ?> Pasien</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
