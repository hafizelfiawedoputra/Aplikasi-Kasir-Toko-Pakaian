<?php
error_reporting(0);
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION){
    include "../../../library/koneksi.php";
	include "../../../library/rupiah.php";
  ?>
    <div class="rinci_brg"><!-- rinci_brg -->    
       <table class="judul" >
        <tr>
          <th width="25px">no.</th>
          <th width="75px">kode</th>
          <th width="300px">nama barang</th>
          <th width="100px">harga</th>
          <th width="35px">disc</th>
          <th width="25px">qty</th>
          <th width="150px">total</th>
        </tr>
      </table>
      <div class="data_trans"><!-- class data -->
        <table class="data">
      <?php
	  $cari	 = $_POST['cari'];
	   
      $no=1;
      $brg = mysql_query("SELECT b.*, t.*
						    FROM barang b, 
						         transaksi_jual t
						   WHERE t.id_brg = b.id_brg
							 AND nota = '$cari'");
      $cek_brg = mysql_num_rows($brg);

      if ($cek_brg > 0){
        while($y = mysql_fetch_array($brg)){
		  $harga_jual = format_number($y['harga_jual']);
		  $total = format_number($y['total']);
	  ?>
          <tr>
            <td width="25px" align="center"><?php echo $no; ?></td>
            <td width="75" align="center"><?php echo $y['id_brg']; ?></td>
            <td width="300px"><?php echo $y['nama_brg']; ?></td>
            <td width="100px" align="right"><?php echo $harga_jual; ?></td>
            <td width="35px" align="center"><?php echo $y['diskon']; ?></td>
            <td width="25px" align="center"><?php echo $y['qty']; ?></td>
            <td width="150px" align="right"><?php echo $total; ?></td>
          </tr>
      <?php
        $no++;
		$grand_total = $grand_total+$y[total];		
        }
      }
      else{
      ?>
        <tr><td colspan="6"><b><center>DATA RINCIAN TRANSAKSI PENJUALAN BARANG BELUM TERSEDIA</center></b></td></tr>
      <?php
      }
      ?>

        </table>	
      </div><!-- end class data -->
      
      <div class="form_rinci"><!-- form_rinci -->
        <table class="form">
          <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><input type="text" name="tgl"  id="tgl" size="15" disabled="disabled" /></td>
            <td>&nbsp;</td>
            <td>Kasir</td>
            <td>:</td>
            <td><input type="text" name="kasir" id="kasir" size="30" disabled="disabled" /></td>
            <td>&nbsp;</td>
            <td>Grand Total</td>
            <td>:</td>
            <td><input type="text" name="total_harga" size="30" disabled="disabled" value="<?php echo format_number($grand_total); ?>" /></td>
          </tr>
        </table>
      </div><!-- end form_rinci -->
      
    </div><!-- rinci_brg --> 
    <?php
  }
}
?>