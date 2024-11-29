<?php
// Include file koneksi database dan navbar
include 'db.php';
include 'navbar.php';

// Handle Create, Update, and Delete for barang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crud_barang'])) {
    $id = $_POST['id'] ?? '';
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];

    if (isset($_POST['add_barang'])) {
        $sql = "INSERT INTO barang (kode_barang, nama_barang, harga_beli, harga_jual, stok, satuan) VALUES ('$kode_barang', '$nama_barang', '$harga_beli', '$harga_jual', '$stok', '$satuan')";
        $conn->query($sql);
    } elseif (isset($_POST['edit_barang'])) {
        $sql = "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok', satuan='$satuan' WHERE id='$id'";
        $conn->query($sql);
    } elseif (isset($_POST['delete_barang'])) {
        $sql = "DELETE FROM barang WHERE id='$id'";
        $conn->query($sql);
    }
}

// Handle Create, Update, and Delete for penjualan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crud_penjualan'])) {
    $id = $_POST['id'] ?? '';
    $no_penjualan = $_POST['no_penjualan'];
    $nama_kasir = $_POST['nama_kasir'];
    $tgl_penjualan = $_POST['tgl_penjualan'];
    $jam_penjualan = $_POST['jam_penjualan'];
    $total = $_POST['total'];

    if (isset($_POST['add_penjualan'])) {
        $sql = "INSERT INTO penjualan (no_penjualan, nama_kasir, tgl_penjualan, jam_penjualan, total) VALUES ('$no_penjualan', '$nama_kasir', '$tgl_penjualan', '$jam_penjualan', '$total')";
        $conn->query($sql);
    } elseif (isset($_POST['edit_penjualan'])) {
        $sql = "UPDATE penjualan SET no_penjualan='$no_penjualan', nama_kasir='$nama_kasir', tgl_penjualan='$tgl_penjualan', jam_penjualan='$jam_penjualan', total='$total' WHERE id='$id'";
        $conn->query($sql);
    } elseif (isset($_POST['delete_penjualan'])) {
        $sql = "DELETE FROM penjualan WHERE id='$id'";
        $conn->query($sql);
    }
}

// Handle Create, Update, and Delete for detail_penjualan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crud_detail_penjualan'])) {
    $detail_id = $_POST['detail_id'] ?? '';
    $no_penjualan = $_POST['no_penjualan_detail'];
    $nama_barang = $_POST['nama_barang'];
    $harga_barang = $_POST['harga_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan = $_POST['satuan'];
    $sub_total = $_POST['sub_total'];

    if (isset($_POST['add_detail_penjualan'])) {
        $sql = "INSERT INTO detail_penjualan (no_penjualan, nama_barang, harga_barang, jumlah_barang, satuan, sub_total) VALUES ('$no_penjualan', '$nama_barang', '$harga_barang', '$jumlah_barang', '$satuan', '$sub_total')";
        $conn->query($sql);
    } elseif (isset($_POST['edit_detail_penjualan'])) {
        $sql = "UPDATE detail_penjualan SET no_penjualan='$no_penjualan', nama_barang='$nama_barang', harga_barang='$harga_barang', jumlah_barang='$jumlah_barang', satuan='$satuan', sub_total='$sub_total' WHERE id='$detail_id'";
        $conn->query($sql);
    } elseif (isset($_POST['delete_detail_penjualan'])) {
        $sql = "DELETE FROM detail_penjualan WHERE id='$detail_id'";
        $conn->query($sql);
    }
}

// Fetch Barang Data
$barang_result = $conn->query("SELECT * FROM barang");

// Fetch Penjualan Data
$penjualan_result = $conn->query("SELECT * FROM penjualan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Toko Toserba</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Pengolahan Data</h1>
    <br><br>
    <h2>Tambah/Edit Barang</h2>
    <form method="POST" action="admin.php">
        <input type="hidden" name="id" id="id_barang">
        <input type="hidden" name="crud_barang" value="1">
        <label for="kode_barang">Kode Barang:</label>
        <input type="text" name="kode_barang" id="kode_barang" required><br><br>
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" id="nama_barang" required><br><br>
        <label for="harga_beli">Harga Beli:</label>
        <input type="number" step="0.01" name="harga_beli" id="harga_beli" required><br><br>
        <label for="harga_jual">Harga Jual:</label>
        <input type="number" step="0.01" name="harga_jual" id="harga_jual" required><br><br>
        <label for="stok">Stok:</label>
        <input type="number" name="stok" id="stok" required><br><br>
        <label for="satuan">Satuan:</label>
        <input type="text" name="satuan" id="satuan" required><br><br>
        <button type="submit" name="add_barang">Tambah</button>
        <button type="submit" name="edit_barang">Edit</button>
    </form>
    <br><br>
    <h2>Data Barang</h2>
    <table>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $barang_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['kode_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['harga_beli']; ?></td>
            <td><?php echo $row['harga_jual']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo $row['satuan']; ?></td>
            <td>
                <button onclick="editBarang(<?php echo $row['id']; ?>, '<?php echo $row['kode_barang']; ?>', '<?php echo $row['nama_barang']; ?>', '<?php echo $row['harga_beli']; ?>', '<?php echo $row['harga_jual']; ?>', '<?php echo $row['stok']; ?>', '<?php echo $row['satuan']; ?>')">Edit</button>
                <form method="POST" action="admin.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="crud_barang" value="1">
                    <button type="submit" name="delete_barang">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br><br>
    <h2>Tambah/Edit Penjualan</h2>
    <form method="POST" action="admin.php">
        <input type="hidden" name="id" id="id_penjualan">
        <input type="hidden" name="crud_penjualan" value="1">
        <label for="no_penjualan">No Penjualan:</label>
        <input type="text" name="no_penjualan" id="no_penjualan" required><br><br>
        <label for="nama_kasir">Nama Kasir:</label>
        <input type="text" name="nama_kasir" id="nama_kasir" required><br><br>
        <label for="tgl_penjualan">Tanggal Penjualan:</label>
        <input type="date" name="tgl_penjualan" id="tgl_penjualan" required><br><br>
        <label for="jam_penjualan">Jam Penjualan:</label>
        <input type="time" name="jam_penjualan" id="jam_penjualan" required><br><br>
        <label for="total">Total:</label>
        <input type="number" step="0.01" name="total" id="total" required><br><br>
        <button type="submit" name="add_penjualan">Tambah</button>
        <button type="submit" name="edit_penjualan">Edit</button>
    </form>
    <br><br>
    <h2>Data Penjualan</h2>
    <table>
        <tr>
            <th>No Penjualan</th>
            <th>Nama Kasir</th>
            <th>Tanggal Penjualan</th>
            <th>Jam Penjualan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $penjualan_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['no_penjualan']; ?></td>
            <td><?php echo $row['nama_kasir']; ?></td>
            <td><?php echo $row['tgl_penjualan']; ?></td>
            <td><?php echo $row['jam_penjualan']; ?></td>
            <td><?php echo $row['total']; ?></td>
            <td>
                <button onclick="editPenjualan(<?php echo $row['id']; ?>, '<?php echo $row['no_penjualan']; ?>', '<?php echo $row['nama_kasir']; ?>', '<?php echo $row['tgl_penjualan']; ?>', '<?php echo $row['jam_penjualan']; ?>', '<?php echo $row['total']; ?>')">Edit</button>
                <form method="POST" action="admin.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="crud_penjualan" value="1">
                    <button type="submit" name="delete_penjualan">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br><br>
    <h2>Tambah/Edit Detail Penjualan</h2>
    <form method="POST" action="admin.php">
        <input type="hidden" name="detail_id" id="detail_id">
        <input type="hidden" name="crud_detail_penjualan" value="1">
        <label for="no_penjualan_detail">No Penjualan:</label>
        <select name="no_penjualan_detail" id="no_penjualan_detail" required>
            <?php
            // Ambil data no_penjualan dari tabel penjualan
            $penjualan_result = $conn->query("SELECT * FROM penjualan");
            while ($row = $penjualan_result->fetch_assoc()) {
                echo "<option value='" . $row['no_penjualan'] . "'>" . $row['no_penjualan'] . "</option>";
            }
            ?>
        </select><br><br>
        <label for="nama_barang">Nama Barang:</label>
        <select name="nama_barang" id="nama_barang" required>
            <?php
            // Ambil data nama_barang dari tabel barang
            $barang_result = $conn->query("SELECT * FROM barang");
            while ($row = $barang_result->fetch_assoc()) {
                echo "<option value='" . $row['nama_barang'] . "'>" . $row['nama_barang'] . "</option>";
            }
            ?>
        </select><br><br>
        <label for="harga_barang">Harga Barang:</label>
        <input type="number" step="0.01" name="harga_barang" id="harga_barang" required><br><br>
        <label for="jumlah_barang">Jumlah Barang:</label>
        <input type="number" name="jumlah_barang" id="jumlah_barang" required><br><br>
        <label for="satuan">Satuan:</label>
        <input type="text" name="satuan" id="satuan" required><br><br>
        <label for="sub_total">Sub Total:</label>
        <input type="number" step="0.01" name="sub_total" id="sub_total" required><br><br>
        <button type="submit" name="add_detail_penjualan">Tambah</button>
        <button type="submit" name="edit_detail_penjualan">Edit</button>
    </form>
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
            <th>Aksi</th>
        </tr>
        <?php
        // Ambil data detail_penjualan dari tabel detail_penjualan
        $detail_result = $conn->query("SELECT * FROM detail_penjualan");
        while ($row = $detail_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['no_penjualan']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['harga_barang']; ?></td>
            <td><?php echo $row['jumlah_barang']; ?></td>
            <td><?php echo $row['satuan']; ?></td>
            <td><?php echo $row['sub_total']; ?></td>
            <td>
                <button onclick="editDetailPenjualan(<?php echo $row['id']; ?>, '<?php echo $row['no_penjualan']; ?>', '<?php echo $row['nama_barang']; ?>', '<?php echo $row['harga_barang']; ?>', '<?php echo $row['jumlah_barang']; ?>', '<?php echo $row['satuan']; ?>', '<?php echo $row['sub_total']; ?>')">Edit</button>
                <form method="POST" action="admin.php" style="display:inline;">
                    <input type="hidden" name="detail_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="crud_detail_penjualan" value="1">
                    <button type="submit" name="delete_detail_penjualan">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table><br><br><br>

    <script>
        // Fungsi untuk mengisi form barang dengan data yang ada saat edit
        function editBarang(id, kode_barang, nama_barang, harga_beli, harga_jual, stok, satuan) {
            document.getElementById('id_barang').value = id;
            document.getElementById('kode_barang').value = kode_barang;
            document.getElementById('nama_barang').value = nama_barang;
            document.getElementById('harga_beli').value = harga_beli;
            document.getElementById('harga_jual').value = harga_jual;
            document.getElementById('stok').value = stok;
            document.getElementById('satuan').value = satuan;
        }

        // Fungsi untuk mengisi form penjualan dengan data yang ada saat edit
        function editPenjualan(id, no_penjualan, nama_kasir, tgl_penjualan, jam_penjualan, total) {
            document.getElementById('id_penjualan').value = id;
            document.getElementById('no_penjualan').value = no_penjualan;
            document.getElementById('nama_kasir').value = nama_kasir;
            document.getElementById('tgl_penjualan').value = tgl_penjualan;
            document.getElementById('jam_penjualan').value = jam_penjualan;
            document.getElementById('total').value = total;
        }

        // Fungsi untuk mengisi form detail_penjualan dengan data yang ada saat edit
        function editDetailPenjualan(id, no_penjualan, nama_barang, harga_barang, jumlah_barang, satuan, sub_total) {
            document.getElementById('detail_id').value = id;
            document.getElementById('no_penjualan_detail').value = no_penjualan;
            document.getElementById('nama_barang').value = nama_barang;
            document.getElementById('harga_barang').value = harga_barang;
            document.getElementById('jumlah_barang').value = jumlah_barang;
            document.getElementById('satuan').value = satuan;
            document.getElementById('sub_total').value = sub_total;
        }
    </script>
</body>
</html>
