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

    $mod=$_GET['mod'];
    $aksi=$_GET['aksi'];

    // Update identitas
    if ($mod=='tok' AND $aksi=='ubh_dt'){
      mysql_query("UPDATE toko SET nama       = '$_POST[nama]',
								   alamat     = '$_POST[alamat]',
								   telp		  = '$_POST[telp]',
								   email	  = '$_POST[email]',
								   keterangan = '$_POST[keterangan]'
                             WHERE id_toko    = '$_POST[id_toko]'");
  	  header('location:../../../mediaweb.php?mod='.$mod);
  	}
  }
}
?>
