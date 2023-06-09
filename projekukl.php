<?php
$host = mysqli_connect("localhost", "root", "");

if ($host) {
	echo "Hore koneksi hostmu berhasil.<br/>";
} else {
	echo "Koneksi gagal :(.<br/>";
}

$db = mysqli_select_db($host, "matyuk");

if ($db) {
	echo "Koneksi database berhasil.<br/>";
} else {
	echo "Koneksi database gagal.<br/>";
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Menampilkan Tabel</title>
</head>

<body>
	<h1>Data Materi</h1>
	<table border="1">
		<tr>
			<th>ID_MATERI</th>
			<th>Judul Materi</th>
			<th>Jenis Materi</th>
			<th>Isi Materi</th>
			<th>Tanggal</th>
		</tr>
		<?php
		include_once "projekukl.php";
		$query_mysql = mysqli_query($host, "SELECT * FROM materi") or die(mysqli_error($host));
		$nomor = 1;
		while ($data = mysqli_fetch_array($query_mysql)) {
			echo "<tr>";
			echo "<td>" . $nomor++ . "</td>";
			echo "<td>" . $data['judul_materi'] . "</td>";
			echo "<td>" . $data['jenis_materi'] . "</td>";
			echo "<td>" . $data['isi_materi'] . "</td>";
			echo "<td>" . $data['tanggal'] . "</td>";
			echo "</tr>";
		}
		?>
	</table>

	<h1>Data Kelas</h1>
	<table border="1">
		<tr>
			<th>ID_KELAS</th>
			<th>nama_kelas</th>
			<th>jenjang_kelas</th>
		</tr>
		<?php
		include_once "projekukl.php";
		$query_mysql = mysqli_query($host, "SELECT * FROM kelas") or die(mysqli_error($host));
		$nomor = 1;
		while ($data = mysqli_fetch_array($query_mysql)) {
			echo "<tr>";
			echo "<td>" . $nomor++ . "</td>";
			echo "<td>" . $data['nama_kelas'] . "</td>";
			echo "<td>" . $data['jenjang_kelas'] . "</td>";
			echo "</tr>";
		}
		?>
	</table>
</body>

</html>