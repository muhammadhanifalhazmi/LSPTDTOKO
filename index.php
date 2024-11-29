<?php
include 'db.php';
include 'navbar.php';

$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM barang WHERE nama_barang LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Toko Toserba</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Data Barang</h1>
    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Cari Nama Barang" value="<?php echo $search; ?>">
        <button type="submit">Cari</button>
    </form><br>
    <table>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Satuan</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['kode_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['harga_beli']; ?></td>
            <td><?php echo $row['harga_jual']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo $row['satuan']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
