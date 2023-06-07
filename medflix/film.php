<?php 
	error_reporting(0);
	include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Medflix</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">
	<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
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
			<!-- search -->
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
			<!-- new product -->
			<h3>Daftar film</h3>
			<div class="box">
				<?php 
					$where = "";
					if ($_GET['search'] != '' || $_GET['kat'] != '') {
						$where = "AND judul_film LIKE '%".$_GET['search']."%' AND kategori_id LIKE '%".$_GET['kat']."%' ";
					}
					$film = mysqli_query($conn, "SELECT * FROM tb_film LEFT JOIN tb_kategori USING (kategori_id) WHERE 1=1 ".$where." ORDER BY film_id DESC");
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
			<small>Copyright &copy; 2023 - @raihanardianto.</small>
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
  });
</script>
</body>
</html>
