<?php 
        include 'db.php'; //terhubung ke koneksi.php
        
        $nama_user=$_GET['nama'];
        $email_user=$_GET['email'];
        $telp_user=$_GET['telepon'];
        $address_user=$_GET['alamat'];
        $username=$_GET['username'];
        $password_user = md5($_GET['password']);

        $sql = "INSERT INTO tb_user (nama_user, email_user, telp_user, address_user, username, password_user)
        VALUES('$nama_user', '$email_user', '$telp_user', '$address_user', '$username', '$password_user')";

        if (mysqli_query($conn, $sql)) {
        header("location:login.php");
        } 
?>