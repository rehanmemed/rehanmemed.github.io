<?php 

	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$dbname   = 'medfilm';

	$conn = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal terkoneksi ke database');
?>