<?php 
include 'koneksi.php';
$id_sat = $_GET['id_sat'];
mysql_query("DELETE FROM satuan WHERE id_sat='$id_sat'")or die(mysql_error());

header("location:index.php?pesan=hapus");
?>