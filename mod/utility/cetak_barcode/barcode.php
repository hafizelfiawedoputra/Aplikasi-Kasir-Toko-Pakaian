<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION[status]=='admin'){
	$_SESSION['barcode']=1;
	if (isset($_POST['simpan'])){
	  if (empty($_POST['qty'])){	
	    ?>
        <script type="text/javascript">
          alert("Anda belum mengisikan jumlah barcode yang akan dicetak");
		  document.getElementById(qty).focus();
        </script>
        <?php  
	  }
	  else{	$bar= mysql_query ("INSERT INTO cetak_barcode(id_brg,qty) VALUES('$_POST[nama_brg]','$_POST[qty]');"); }
	}
  ?>
    <div class="judul"><h2>Cetak Barcode</h2></div>
    <div class="tambah"><input type="button" class="button" value="Cetak Data" onclick="ctk_bar();" ></div>
    <div class="area_main"><!-- class area_main -->	
      <form name="bar" action="?mod=bar" method="POST">
      <table class="form">
	    <tr>
          <td>Kategori</td>
          <td>:</td>
          <td>
            <select name="kategori" style="width:130px;">
			  <option selected="selected" value="<?php print $_POST['kategori']; ?>"><?php print $_POST['kategori']; ?></option>
			  <?php
			  $kat=mysql_query("SELECT * FROM kategori ORDER BY id_kat DESC");		  
			  if (mysql_num_rows($kat)>0) {
				while ($k=mysql_fetch_array($kat)){
			  ?>
				<option value="<?php echo $k['nama_kat']; ?>"><?php echo $k['nama_kat']; ?></option>
              <?php
			    }
			  }
              ?>
		    </select>         
          </td>
          <td></td>
          <td><input type="submit" name="pil_kat" class="button" value="Pilih Kategori"></td>
        </tr>
        <tr>
          <td>Nama Barang</td>
          <td>:</td>
          <td>
            <?php $_POST['kategori'] ? $aktif = "" : $aktif ="disabled"; ?>
            <select name="nama_brg" style="width:130px;" <?php echo $aktif; ?>>
			  <option selected="selected" value=""></option>
			  <?php
			  $nama_brg=mysql_query("SELECT b.*, k.*
									   FROM barang b,
									   		kategori k
									  WHERE b.id_kat=k.id_kat
									    AND k.nama_kat
									   LIKE '$_POST[kategori]'
								   ORDER BY id_brg DESC");		  
			  if (mysql_num_rows($nama_brg)>0) {
			    while ($n=mysql_fetch_array($nama_brg)){
				?>
				  <option value="<?php echo $n['id_brg']; ?>"><?php echo $n['nama_brg']; ?></option>
                <?php
				}
			  }
              ?>
		      </select>         
            </td>
          </tr>
          <tr>
            <td>Jumlah Cetak</td>
            <td>:</td>
            <td><input type="text" name="qty" id="qty" size="5" /></td>
            <td></td>
            <td><input type="submit" name="simpan" class="button" value="Simpan"  /></td>
          </tr>
      </table>	
      								
      <table class="judul">
        <tr>
          <th width="10px" align="center">no.</th>
          <th width="65px">kode barang</th>
          <th width="250px">nama barang</th>
          <th width="100px">kategori</th>
          <th width="100px">harga jual</th>
          <th width="25px">qty</th>
        </tr>
      </table>
      
      <div class="bar"><!-- class bar -->
      <table class="data">
      <?php
      $no=1;	  
      $brg = mysql_query("SELECT barang.*, 
								 kategori.*,
								 cetak_barcode.*
							FROM barang, kategori, cetak_barcode 
						   WHERE barang.id_brg = cetak_barcode.id_brg
						     AND barang.id_kat = kategori.id_kat
						ORDER BY barang.id_brg");
      $cek_brg = mysql_num_rows($brg);

      if ($cek_brg > 0){
        while($y = mysql_fetch_array($brg)){
          $harga_jual = format_number($y['harga_jual']);
	  ?>
          <tr>
            <td width="10px" align="center"><?php echo $no; ?></td>
            <td width="65px" align="center"><?php echo $y['id_brg']; ?></td>
            <td width="250px"><?php echo $y['nama_brg']; ?></td>
            <td width="100px"><?php echo $y['nama_kat']; ?></td>
            <td width="100px" align="right"><?php echo $harga_jual; ?></td>
            <td width="25px" align="center"><?php echo $y['qty']; ?></td>
          </tr>
      <?php
        $no++;
        }
      }
      else{
      ?>
        <tr><td colspan="5"><b><center>CETAK DATA BARCODE BELUM TERSEDIA</center></b></td></tr>
      <?php
      }
      ?>
      </table>
      </div><!-- end class bar -->
      </form>
    </div><!-- end class area_main -->
    <?php
  }
}
?>
