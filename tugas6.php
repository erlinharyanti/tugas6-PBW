<?php
// Array pajak bandara asal
$bandara_asal = array(
    "Soekarno Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000
);

// Array pajak bandara tujuan
$bandara_tujuan = array(
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000
);

asort($bandara_asal);
asort($bandara_tujuan);

$hasil = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maskapai = $_POST['maskapai'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $harga_tiket = (int)$_POST['harga_tiket'];

    $pajak_asal = isset($bandara_asal[$asal]) ? $bandara_asal[$asal] : 0;
    $pajak_tujuan = isset($bandara_tujuan[$tujuan]) ? $bandara_tujuan[$tujuan] : 0;

    $total_pajak = $pajak_asal + $pajak_tujuan;
    $total_harga = $harga_tiket + $total_pajak;
    $nomor = "FL-" . rand(1000, 9999);
    $tanggal = date("d-m-Y");

    $hasil = "
    <h3>Output:</h3>
    <p>Nomor: $nomor<br>
    Tanggal: $tanggal<br>
    Nama Maskapai: $maskapai</p>

    <table border='1' cellpadding='5' cellspacing='0'>
        <tr><td>Asal Penerbangan</td><td>$asal</td></tr>
        <tr><td>Tujuan Penerbangan</td><td>$tujuan</td></tr>
        <tr><td>Harga Tiket</td><td>Rp " . number_format($harga_tiket, 0, ',', '.') . "</td></tr>
        <tr><td>Pajak</td><td>Rp " . number_format($total_pajak, 0, ',', '.') . "</td></tr>
        <tr><td>Total Harga Tiket</td><td>Rp " . number_format($total_harga, 0, ',', '.') . "</td></tr>
    </table>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Penerbangan</title>
</head>
<body>

<h2>Form Pendaftaran Rute Penerbangan</h2>

<form method="post">
    Nama Maskapai:<br>
    <input type="text" name="maskapai" required><br><br>

    Bandara Asal:<br>
    <select name="asal" required>
        <option value="" disabled selected>Pilih Bandara Asal</option>
        <?php foreach ($bandara_asal as $nama => $pajak): ?>
            <option value="<?= $nama ?>"><?= $nama ?></option>
        <?php endforeach; ?>
    </select><br><br>

    Bandara Tujuan:<br>
    <select name="tujuan" required>
        <option value="" disabled selected>Pilih Bandara Tujuan</option>
        <?php foreach ($bandara_tujuan as $nama => $pajak): ?>
            <option value="<?= $nama ?>"><?= $nama ?></option>
        <?php endforeach; ?>
    </select><br><br>

    Harga Tiket:<br>
    <input type="number" name="harga_tiket" required><br><br>

    <input type="submit" value="Submit">
</form>

<?php
if (!empty($hasil)) {
    echo $hasil;
}
?>

</body>
</html>
