<!DOCTYPE html>
<html>

<head>
  <title>Laporan Transaksi Harian</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script>
    function printReport() {
      window.print();
    }
  </script>
</head>

<body>

  <h1>Laporan Transaksi Harian</h1>
  <form method="get" id="form-input">
    <label for="tanggal">Pilih Tanggal:</label>
    <input type="date" id="tanggal" name="tanggal"
      value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>">
    <br><br>
    <label for="pimpinan">Nama Pimpinan:</label>
    <input type="text" id="pimpinan" name="pimpinan"
      value="<?php echo isset($_GET['pimpinan']) ? $_GET['pimpinan'] : ''; ?>">
    <br><br>
    <button type="submit">Tampilkan</button>
    <button onclick="printReport()">Cetak Laporan</button>
  </form>

  <?php
  include 'inc/db_config.php';
  include 'inc/assentials.php';

  $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
  $pimpinan = isset($_GET['pimpinan']) ? $_GET['pimpinan'] : '';

  $sql = "SELECT p.nama_produk, t.jumlah, t.tanggal 
          FROM payment t 
          JOIN produk p 
          ON t.id_produk = p.id_produk 
          WHERE t.tanggal = '$tanggal'";
  $result = $conn->query($sql);

  echo "<h2>Transaksi pada $tanggal</h2>";
  if ($result->num_rows > 0) {
    echo "<table><tr><th>Nama Produk</th><th>Jumlah</th><th>Tanggal</th></tr>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["nama"] . "</td><td>" . $row["jumlah"] . "</td><td>" . $row["tanggal"] . "</td></tr>";
    }
    echo "</table>";
  } else {
    echo "Tidak ada transaksi pada tanggal ini.";
  }

  if ($pimpinan) {
    echo "<div class='signature'>";
    echo "<h3>Disetujui oleh:</h3>";
    echo "<p><strong>$pimpinan</strong></p>";
    echo "<br><br>";
    echo "<p>_______________________</p>";
    echo "<p>Tanda Tangan</p>";
    echo "</div>";
  }
  ?>

</body>

</html>