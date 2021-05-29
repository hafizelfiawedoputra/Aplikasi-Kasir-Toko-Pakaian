<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION['status']=='admin'){
    $aksi="mod/utility/profil_toko/profil_toko_aksi.php";
	   
    $tampil = mysql_query("SELECT * FROM toko LIMIT 1");
    $y      = mysql_fetch_array($tampil);
  ?>
    <div class="judul"><h2>Profil Toko</h2></div>
    <div class="area_main">
      <form method="POST" action="<?php echo "$aksi?mod=tok&aksi=ubh_dt"; ?>">
        <table class="form">
		  <tr>
            <td>Nama Toko</td>
            <td>:</td>
            <td><input type="hidden" name="id_toko" value="<?php print $y['id_toko']; ?>">
                <input type="text" name="nama" id="nama" value="<?php print $y['nama']; ?>" size="41px" />
            </td>
          </tr>
          <tr>
            <td>Alamat Toko</td>
            <td>:</td>
            <td><textarea name="alamat" id="alamat"><?php print $y['alamat']; ?></textarea></td>
          </tr>
		  <tr>
            <td>No. Telpon</td>
            <td>:</td>
            <td><input type="text" name="telp" id="telp" value="<?php print $y['telp']; ?>" size="20px" /></td>
          </tr>
	      <tr>
            <td>Email</td>
            <td>:</td>
            <td><input type="text" name="email" id="email" value="<?php print $y['email']; ?>" size="20px" /></td>
          </tr>
          <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><textarea name="keterangan" id="keterangan"><?php print $y['keterangan']; ?></textarea></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input type="submit" class="button" value="Ubah"> <input type="button" class="button" value="Batal" onclick="self.history.back()"></td>
          </tr>
        </table>
      </form>
    </div>
<?php
   }
}
?>
