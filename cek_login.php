<?php
include "library/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysql_query("SELECT * FROM user WHERE username='$username' AND password='$password'");
                                           
//untuk mendeteksi apakah user tersebut memang terdaftar.
//jika terdaftar, maka tidak akan menghasilkan nilai 0 (null)
$ada = mysql_num_rows($login);
$y   = mysql_fetch_array($login);

//bandingkan isi dari variabel dengan nilai 0
if ($ada > 0){
   session_start(); //memulai session
   
   //isikan variabel session yang telah dibentuk diatas
   $_SESSION['id_user']      = $y['id_user'];
   $_SESSION['nama_lengkap'] = $y['nama_lengkap'];
   $_SESSION['username']     = $y['username'];
   $_SESSION['password']     = $y['password'];
   $_SESSION['status']       = $y['status'];
   
   //tampilkan awal halaman admin
   header('location:mediaweb.php?mod=beranda');
}
else{
?>
   <script type="text/javascript">
      alert("Username atau Password yang Anda masukan tidak cocok");
      self.location.href="index.php";
   </script>
<?php
}
?>