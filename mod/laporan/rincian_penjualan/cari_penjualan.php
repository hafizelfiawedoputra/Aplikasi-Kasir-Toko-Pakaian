<?php
include "../../../library/koneksi.php";

$cari = $_POST['cari'];
$sql  = mysql_query("SELECT u.*, p.*
                      FROM user u,
                           penjualan p
                     WHERE p.id_user = u.id_user
                       AND nota = '$cari'");
                       
$row = mysql_num_rows($sql);

if ($row>0){
  while ($y=mysql_fetch_array($sql)){
    $data['tanggal']   = $y[tanggal];
    $data['nama_lengkap'] = $y[nama_lengkap];

    echo json_encode($data);
  }
}
else{
 $data['tanggal']      = '';
 $data['nama_lengkap'] = '';

 echo json_encode($data);
}
?>
