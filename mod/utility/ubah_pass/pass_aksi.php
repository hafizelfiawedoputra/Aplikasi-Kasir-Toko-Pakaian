<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
    include "../../../library/koneksi.php";

    $mod=$_GET['mod'];
    $aksi=$_GET['aksi'];
	
    $pass_lama = MD5($_POST['pass_lama']);
    $pass_baru = MD5($_POST['pass_baru']);
	
	$y=mysql_fetch_array(mysql_query("SELECT * FROM user WHERE username='$_SESSION[username]' AND id_user='$_SESSION[id_user]'"));

   if (empty($_POST['pass_baru']) OR empty($_POST['pass_lama']) OR empty($_POST['pass_ulangi'])){
     echo "<p align=center>Anda harus mengisikan semua data pada form Ubah Password.<br />";
     echo "<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a></p>";
   }
   else{
     //apabila password lama cocok dengan password yang ada didatabase
     if ($pass_lama==$y[password]){
        //pastikan bahwa password baru yang dimasukan sebanyak dua kali sudah cocok
        if ($_POST[pass_baru]==$_POST[pass_ulangi]){
          mysql_query("UPDATE user SET password='$pass_baru' WHERE username='$_SESSION[username]' AND id_user='$_SESSION[id_user]'");
          header('location:../../../mediaweb.php?mod=beranda');
        }
        else{
          ?>
          <p align="center">Password baru yang Anda masukkan sebanyak dua kali belum cocok.<br />
          <a href="javascript:history.go(-1)"><b>Ulangi Lagi</b></a></p>
          <?php
        }
     }
     else{
       ?>
       <p align="center">Anda salah memasukkan Password Lama Anda.<br />
       <a href="javascript:history.go(-1)"><b>Ulangi Lagi</b></a></p>
       <?php
     }
   }
}
?>