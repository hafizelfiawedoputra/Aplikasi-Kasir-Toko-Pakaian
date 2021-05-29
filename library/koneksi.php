<?php
$server   = "localhost";
$user     = "root";
$password = "";
$database = "dbpenjualan";

//koneksikan dan pilih database di server
mysql_connect($server,$user,$password) or die ("Koneksi Gagal");
mysql_select_db($database) or die ("Database tidak ditemukan");
?>
