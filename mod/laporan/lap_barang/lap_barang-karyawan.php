<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION){
  ?>
    <div class="judul"><h2>Laporan Data Barang</h2></div>
    <div class="tambah"><input type="button" id="cetak" class="button" value="Cetak Data" ></div>
    <div class="area_main"><!-- class area_main -->	
    <div id="laporan"><!-- id laporan -->
      <div class="judul_lap"><h2>Laporan Data Barang</h2></div>											
      <table class="lap">
        <tr>
          <th width="25px" align="center">no.</th>
          <th width="50px">ID barang</th>
          <th width="225px">nama barang</th>
          <th width="100px">merk</th>
          <th width="100px">kategori</th>
          <th width="100px">satuan</th>
          <th width="100px">harga barang</th>
          <th width="50px">Barcode</th>
          <th width="50px">stock</th>
        </tr>
      <?php
      $no=1;
      $brg = mysql_query("select  * from barang") or die(mysql_error());
      $tot_hargajual = 0;
      $tot_stok = 0;
      $brg = mysql_query("SELECT b.*, k.*, m.*, s.*
						    FROM barang b, 
						         kategori k, 
							     merk m,
								 satuan s
						   WHERE b.id_kat = k.id_kat
							 AND b.id_merk = m.id_merk
							 AND b.id_sat = s.id_sat
						ORDER BY b.id_brg DESC");
      $cek_brg = mysql_num_rows($brg);

      if ($cek_brg > 0){
        while($y = mysql_fetch_array($brg)){
          $tot_hargajual += ($y['harga_jual']);
          $tot_stok += ($y['stock']);
		  $harga_jual = format_number($y['harga_jual']);
		  $harga_beli = format_number($y['harga_beli']);
	  ?>
          <tr>
            <td width="25px" align="center"><?php print $no; ?></td>
            <td width="50px"><?php echo $y['id_brg']; ?></td>
            <td width="225px"><?php echo $y['nama_brg']; ?></td>
            <td width="100px"><?php echo $y['nama_merk']; ?></td>
            <td width="100px"><?php echo $y['nama_kat']; ?></td>
            <td width="100px"><?php echo $y['nama_sat']; ?></td>
            <td width="100px" align="right"><?php echo $harga_jual; ?></td>
            <td width="50px"><?php echo $y['barcode']; ?></td>
            <td width="50px" align="center"><?php echo $y['stock']; ?></td>
          </tr>
      <?php
        $no++;
        }
      }
      else{
      ?>
        <tr><td colspan="12"><b><center>LAPORAN DATA BARANG BELUM TERSEDIA</center></b></td></tr>
      <?php
      } echo '<tr><td colspan="6">Total</td>
      <td align="right">' .  format_number($tot_hargajual) . '</td><td align="right"></td><td align="right"><center>' .($tot_stok). '</center></td></tr></tbody>'
      ?>
      </table> 
      </div><!-- end id laporan -->
    </div><!-- end class area_main -->
    <?php
  }
}
?>

