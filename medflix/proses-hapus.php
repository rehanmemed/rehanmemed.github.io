<?php 
	
	include 'db.php';

	if(isset($_GET['idk'])){
		$delete = mysqli_query($conn, "DELETE FROM tb_kategori WHERE kategori_id = '".$_GET['idk']."' ");
		echo '<script>window.location="data-kategori.php"</script>';
	}

	if(isset($_GET['idp'])){
		$film = mysqli_query($conn, "SELECT film_img FROM tb_film WHERE film_id = '".$_GET['idp']."' ");
		$p = mysqli_fetch_object($film);

		unlink('./film/'.$p->pfilm_img);

		$delete = mysqli_query($conn, "DELETE FROM tb_film WHERE film_id = '".$_GET['idp']."' ");
		echo '<script>window.location="data-film.php"</script>';
	}

?>