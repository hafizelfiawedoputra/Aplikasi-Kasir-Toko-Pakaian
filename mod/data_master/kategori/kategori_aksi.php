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
    if ($mod=='kat' AND $aksi=='hap_dt'){
      mysql_query("DELETE FROM kategori WHERE id_kat='$_GET[id]'");
      header('location:../../../mediaweb.php?mod='.$mod);
    }
    //tambah data
    if($mod=='kat' AND $aksi=='tb_dt'){
      mysql_query("INSERT INTO kategori(nama_kat) VALUES ('$_POST[nama_kat]')");
      header('location:../../../mediaweb.php?mod='.$mod);
    }
    //ubah data
    elseif($mod=='kat' AND $aksi=='ubh_dt'){
      mysql_query("UPDATE kategori SET nama_kat = '$_POST[nama_kat]' WHERE id_kat = '$_POST[id_kat]'");
      header('location:../../../mediaweb.php?mod='.$mod);
    }
  }
}
?>

