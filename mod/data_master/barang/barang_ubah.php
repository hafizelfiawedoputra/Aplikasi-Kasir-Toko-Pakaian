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
	   
    $tampil = mysql_query("SELECT * FROM barang WHERE id_brg='$_GET[id]'");
    $y      = mysql_fetch_array($tampil);
    ?>
    <div class="judul"><h2> Ubah Data Barang</h2></div>
       <div class="area_main">
         <form method="POST" action="<?php echo "$aksi?mod=brg&aksi=ubh_dt"; ?>">
        <table class="form">
		  <tr>
            <td>ID Barang</td>
            <td>:</td>
            <td>
              <input type="text" name="id_brg" id="id_brg" maxlength="6" value="<?php echo $y['id_brg']; ?>" size="10" disabled="disabled" />
              <input type="hidden" name="id_brg_h" id="id_brg_h" value="<?php echo $y['id_brg']; ?>" size="10" />            
            </td>
          </tr>
		  <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><input type="text" name="nama_brg" id="nama_brg" value="<?php echo $y['nama_brg']; ?>" size="30" /></td>
          </tr>
		  <tr>
            <td>Merk</td>
            <td>:</td>
            <td>
              <select name="merk" style="width:130px;">
				<?php
				$merk=mysql_query("SELECT * FROM merk ORDER BY id_merk DESC");
				if ($y[id_merk]==0){
				?>                
				  <option selected="selected" value="">- Pilih Merk -</option>
                <?php
				}
				while ($m=mysql_fetch_array($merk)){
				  if ($y[id_merk]==$m[id_merk]){
				?>
				    <option selected="selected" value="<?php echo $m['id_merk']; ?>"><?php echo $m['nama_merk']; ?></option>
                <?php
				  }
				  else{
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
				<?php
				$kat=mysql_query("SELECT * FROM kategori ORDER BY id_kat DESC");
				if ($y[id_kat]==0){
				?>                
				  <option selected="selected" value="">- Pilih Kategori -</option>
                <?php
				}
				while ($k=mysql_fetch_array($kat)){
				  if ($y[id_kat]==$k[id_kat]){
				?>
				    <option selected="selected" value="<?php echo $k['id_kat']; ?>"><?php echo $k['nama_kat']; ?></option>
                <?php
				  }
				  else{
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
				<?php
				$sat=mysql_query("SELECT * FROM satuan ORDER BY id_sat DESC");
				if ($y[id_sat]==0){
				?>                
				  <option selected="selected" value="">- Pilih Satuan -</option>
                <?php
				}
				while ($s=mysql_fetch_array($sat)){
				  if ($y[id_sat]==$s[id_sat]){
				?>
				    <option selected="selected" value="<?php echo $s['id_sat']; ?>"><?php echo $s['nama_sat']; ?></option>
                <?php
				  }
				  else{
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
            <td><input type="text" name="harga_beli" id="harga_beli" value="<?php echo $y['harga_beli']; ?>" size="10" /></td>
          </tr>
		  <tr>
            <td>Harga Jual</td>
            <td>:</td>
            <td><input type="text" name="harga_jual" id="harga_jual" value="<?php echo $y['harga_jual']; ?>" size="10" /></td>
          </tr>
		  <tr>
            <td>Barcode</td>
            <td>:</td>
            <td><input type="text" name="barcode" id="barcode" value="<?php echo $y['barcode']; ?>" size="10" maxlength="10" /></td>
          </tr>
		  <tr>
            <td>Stock</td>
            <td>:</td>
            <td><input type="text" name="stock" id="stock" value="<?php echo $y['stock']; ?>" size="5px" /></td>
          </tr>
             <tr>
               <td></td>
               <td></td>
               <td><input type="submit" class="button" value="Ubah"> <input type="button" class="button" value="Batal" onclick="brg_bat()"></td>
             </tr>
           </table>
		 </form>
       </div>
<?php
   }
}
?>