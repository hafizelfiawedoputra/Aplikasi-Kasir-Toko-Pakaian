<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION['status']=='admin'){
    include "../../../library/koneksi.php";

    $mod  = $_GET['mod'];
    $aksi = $_GET['aksi'];

    //hapus data
    if ($mod=='sat' AND $aksi=='hap_dt'){
      mysql_query("DELETE FROM satuan WHERE id_sat='$_GET[id]'");
      header('location:../../../mediaweb.php?mod='.$mod);
    }
    //tambah data
    if($mod=='sat' AND $aksi=='tb_dt'){
      mysql_query("INSERT INTO satuan(nama_sat) VALUES ('$_POST[nama_sat]')");
      header('location:../../../mediaweb.php?mod='.$mod);
    }
    //ubah data
    elseif($mod=='sat' AND $aksi=='ubh_dt'){
      mysql_query("UPDATE satuan SET nama_sat = '$_POST[nama_sat]' WHERE id_sat = '$_POST[id_sat]'");
      header('location:../../../mediaweb.php?mod='.$mod);
    }
  }
}
?>
