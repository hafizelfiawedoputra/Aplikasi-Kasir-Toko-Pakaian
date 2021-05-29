<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION['status']=='admin'){
    $aksi="mod/utility/ubah_pass/pass_aksi.php";
  ?>
    <div class="judul"><h2>Ubah Password User</h2></div>
    <div class="area_main">
      <form method="POST" action="<?php echo "$aksi?mod=pass&aksi=ubh_dt"; ?>">
        <table class="form">
		  <tr>
            <td>Masukan Password Lama</td>
            <td>:</td>
            <td><input type="password" name="pass_lama" id="pass_lama" value="" size="25px" /></td>
          </tr>
          <tr>
            <td>Masukan Password Baru</td>
            <td>:</td>
            <td><input type="password" name="pass_baru" id="pass_baru" value="" size="25px" /></td>
          </tr>
		  <tr>
            <td>Masukan Lagi Password Baru</td>
            <td>:</td>
            <td><input type="password" name="pass_ulangi" id="pass_ulangi" value="" size="25px" /></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input type="submit" class="button" value="Simpan"> <input type="button" class="button" value="Batal" onclick="beranda()"></td>
          </tr>
        </table>
      </form>
    </div>
<?php
   }
}
?>
