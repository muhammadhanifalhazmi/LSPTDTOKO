<?php
include 'db.php';
include 'navbar.php';

// Fetch Penjualan Data
$penjualan_result = $conn->query("SELECT * FROM penjualan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan - Toko Toserba</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* CSS untuk styling tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Penjualan</h1>

    <h2>Data Penjualan</h2>
    <table>
        <tr>
            <th>No Penjualan</th>
            <th>Nama Kasir</th>
            <th>Tanggal Penjualan</th>
            <th>Jam Penjualan</th>
            <th>Total</th>
        </tr>
        <?php while ($row = $penjualan_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['no_penjualan']; ?></td>
            <td><?php echo $row['nama_kasir']; ?></td>
            <td><?php echo $row['tgl_penjualan']; ?></td>
            <td><?php echo $row['jam_penjualan']; ?></td>
            <td><?php echo $row['total']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br><br>

    <h2>Data Detail Penjualan</h2>
    <table>
        <tr>
            <th>No Penjualan</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Jumlah Barang</th>
            <th>Satuan</th>
            <th>Sub Total</th>
        </tr>
        <?php
        // Ambil data detail_penjualan dari tabel detail_penjualan dan barang
        $detail_result = $conn->query("SELECT dp.*, b.harga_jual FROM detail_penjualan dp JOIN barang b ON dp.nama_barang = b.nama_barang");

        while ($row = $detail_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['no_penjualan']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['harga_barang']; ?></td>
            <td><?php echo $row['jumlah_barang']; ?></td>
            <td><?php echo $row['satuan']; ?></td>
            <td><?php echo $row['sub_total']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
