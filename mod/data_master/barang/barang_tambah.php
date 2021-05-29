<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION['status']=='admin'){
    $aksi="mod/data_master/barang/barang_aksi.php";
  ?>
    <div class="judul"><h2>Tambah Data Barang</h2></div>
    <div class="area_main">
      <form method="POST" action="<?php echo "$aksi?mod=brg&aksi=tb_dt"; ?>">
        <table class="form">
		  <tr>
            <td>ID Barang</td>
            <td>:</td>
            <td>
              <input type="text" name="id_brg" id="id_brg" maxlength="6" value="<?php echo kdauto("barang","BRG"); ?>" size="10" disabled="disabled" />
              <input type="hidden" name="id_brg_h" id="id_brg_h" value="<?php echo kdauto("barang","BRG"); ?>" size="10" />            
            </td>
          </tr>
		  <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><input type="text" name="nama_brg" id="nama_brg" value="" size="30" /></td>
          </tr>
		  <tr>
            <td>Merk</td>
            <td>:</td>
            <td>
              <select name="merk" style="width:130px;">
				<option selected="selected" value="">- Pilih Merk -</option>
				<?php
				$merk=mysql_query("SELECT * FROM merk ORDER BY id_merk DESC");		  
				if (mysql_num_rows($merk)>0) {
				  while ($m=mysql_fetch_array($merk)){
				?>
				    <option value="<?php echo $m['id_merk']; ?>"><?php echo $m['nama_merk']; ?></option>
                <?php
				}
			  }
              ?>
		      </select>         
            </td>
          </tr>
		  <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>
              <select name="kategori" style="width:130px;">
				<option selected="selected" value="">- Pilih Kategori -</option>
				<?php
				$kat=mysql_query("SELECT * FROM kategori ORDER BY id_kat DESC");		  
				if (mysql_num_rows($kat)>0) {
				  while ($k=mysql_fetch_array($kat)){
				?>
				    <option value="<?php echo $k['id_kat']; ?>"><?php echo $k['nama_kat']; ?></option>
                <?php
				}
			  }
              ?>
		      </select>         
            </td>
          </tr>
		  <tr>
            <td>Satuan</td>
            <td>:</td>
            <td>
              <select name="satuan" style="width:130px;">
				<option selected="selected" value="">- Pilih Satuan -</option>
				<?php
				$sat=mysql_query("SELECT * FROM satuan ORDER BY id_sat DESC");		  
				if (mysql_num_rows($sat)>0) {
				  while ($s=mysql_fetch_array($sat)){
				?>
				    <option value="<?php echo $s['id_sat']; ?>"><?php echo $s['nama_sat']; ?></option>
                <?php
				}
			  }
              ?>
		      </select>         
            </td>
          </tr>
		  <tr>
            <td>Harga Beli</td>
            <td>:</td>
            <td><input type="text" name="harga_beli" id="harga_beli" value="" size="10" /></td>
          </tr>
		  <tr>
            <td>Harga Jual</td>
            <td>:</td>
            <td><input type="text" name="harga_jual" id="harga_jual" value="" size="10" /></td>
          </tr>
		  <tr>
            <td>Barcode</td>
            <td>:</td>
            <td><input type="text" name="barcode" id="barcode" value="" size="10" maxlength="10" /></td>
          </tr>
		  <tr>
            <td>Stock</td>
            <td>:</td>
            <td><input type="text" name="stock" id="stock" value="" size="5px" /></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input type="submit" class="button" value="Simpan"> <input type="button" class="button" value="Batal" onclick="brg_bat()"></td>
          </tr>
        </table>
	  </form>
    </div>
<?php
   }
}
?>
