<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MedFlix</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="dashboard.php">MedFlix</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="data-kategori.php">Kategori</a></li>
				<li><a href="data-film.php">Film</a></li>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Data Film</h3>
			<div class="box">
				<p><a href="tambah-film.php" class="box-tambah">Tambah Data</a></p>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Kategori</th>
							<th>Judul</th>
							<th>Link</th>
							<th>Gambar</th>
							<th>Status</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$film = mysqli_query($conn, "SELECT * FROM tb_film LEFT JOIN tb_kategori USING (kategori_id) ORDER BY film_id DESC");
							if(mysqli_num_rows($film) > 0){
							while($row = mysqli_fetch_array($film)){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['kategori_name'] ?></td>
							<td><?php echo $row['judul_film'] ?></td>
							<td><?php echo $row['film_link'] ?></td>
							<td><a href="film/<?php echo $row['film_img'] ?>" target="_blank"> <img src="film/<?php echo $row['film_img'] ?>" width="50px"> </a></td>
							<td><?php echo ($row['film_status'] == 0)? 'On Going':'Completed'; ?></td>
							<td>
								<a href="edit-film.php?id=<?php echo $row['film_id'] ?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['film_id'] ?>" onclick="return confirm('Yakin ingin hapus ?')">Hapus</a>
							</td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="7">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2023 - TokoSepatu.</small>
		</div>
	</footer>
</body>
</html>