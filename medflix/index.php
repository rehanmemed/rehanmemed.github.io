<?php 
	session_start();
		if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
	include 'db.php';
	$film = mysqli_query($conn, "SELECT * FROM tb_film WHERE film_status = 1 ORDER BY film_id DESC LIMIT 8");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Medflix</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
		<h1><a href="index.php">Medflix</a></h1>
			<ul>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle">Kategori</a>
					<div class="dropdown-menu">
						<?php 
							$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY kategori_id DESC");
							if(mysqli_num_rows($kategori) > 0){
								while($k = mysqli_fetch_array($kategori)){
						?>
							<a href="film.php?kat=<?php echo $k['kategori_id'] ?>"><?php echo $k['kategori_name'] ?></a>
						<?php }}else{ ?>
							<p>Kategori tidak ada</p>
						<?php } ?>
					</div>
				</li>
				<li><a href="film.php">Film</a></li>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
			<center>
				<div class="search">
					<div class="container">
						<form action="film.php">
							<input type="text" name="search" placeholder="Cari Film">
							<input type="submit" name="cari" value="Cari Film">
						</form>
					</div>
				</div>
			</center>
		</div>
	</header>
	<div class="section">
		<div class="container">
			<div class="box">
		<h4>Selamat Datang <?php echo $_SESSION['a_global']->nama_user ?> di Medflix, disini kami menyediakan link berbagai film yang kamu cari. silahkan menikmati,semoga senang.</h4>			
	</div>
		<br>	
		<!-- new product -->
			<h3>Film Terbaru</h3>
			<div class="box">
				<?php 
					$film = mysqli_query($conn, "SELECT * FROM tb_film LEFT JOIN tb_kategori USING (kategori_id) ORDER BY film_id DESC");
					if(mysqli_num_rows($film) > 0){
						while($row = mysqli_fetch_array($film)){
				?>	
					<a href="detail-film.php?id=<?php echo $row['film_id'] ?>">
						<div class="col-4">
							<img src="film/<?php echo $row['film_img'] ?>">
							<p class="nama"><?php echo $row['judul_film'] ?></p>
						</div>
					</a>
				<?php }}else{ ?>
					<p>Film tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<small>&copy; 2023 - @raihanardianto.</small>
		</div>
	</div>

	<script>
  document.addEventListener('DOMContentLoaded', function() {
    var dropdown = document.querySelector('.dropdown');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    dropdown.addEventListener('click', function(event) {
      event.stopPropagation();
      dropdownMenu.classList.toggle('show');
    });

    document.addEventListener('click', function(event) {
      if (!dropdown.contains(event.target)) {
        dropdownMenu.classList.remove('show');
      }
    });

	var menuToggle = document.querySelector('.menu-toggle');
  	var menu = document.querySelector('header .container ul');

  	menuToggle.addEventListener('click', function() {
    menu.classList.toggle('active');
    menuToggle.classList.toggle('active');
  });
  });
</script>

</body>
</html>
