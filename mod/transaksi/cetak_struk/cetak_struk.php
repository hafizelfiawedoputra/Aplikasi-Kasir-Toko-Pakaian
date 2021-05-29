<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION){
  ?>
    <script type="text/javascript">
	  window.print(); 
	  setTimeout('window.print()', 1000);
    </script>  
  <?php
    cek_order();
	total_tr();
  ?>
    <div class="struk"><!-- class struk -->
      <form name="struk" method="POST" action="">
        <table class="form">
          <?php 
  		  $query     = mysql_query("SELECT * FROM toko LIMIT 1");
  		  $jml_field = mysql_num_rows($query);
  		  if ($jml_field == 1){
      	    $y = mysql_fetch_array($query);
		  ?>
		  <tr>
            <td colspan="3" class="struk_judul"><b><?php echo strtoupper($y['nama']); ?></b></td>
          </tr>
          <tr>
            <td colspan="3" class="struk_judul">
			  <?php echo $y['alamat']; ?>
              <br /><?php echo "Telp. " . $y[telp]  . " Email : " . $y[email]; ?>
			</td>
          </tr>
          <?php
		  }
		  ?>
        </table>
        <table><tr><td colspan="3" class="struk_garis"></td></tr></table>
        <table class="form">
          <tr>
            <td width="45">Nota</td>
            <td width="5">:</td>
            <td width="200" align="left"><?php echo $order; ?></td>
          </tr>
          <tr>
            <td>Kasir</td>
            <td>:</td>
            <td><?php echo $_SESSION['nama_lengkap']; ?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><?php echo tgl_indo(date("Y m d")); ?></td>
          </tr>
          <tr>
            <td>Jam</td>
            <td>:</td>
            <td><?php echo $jam; ?></td>
          </tr>
        </table>
        <table class="form">
          <tr><td colspan="3" class="struk_garis"></td></tr>
        </table>
        <table class="form">
          <?php
		  $trans=mysql_query("SELECT transaksi_jual.*,
							 		  barang.* 
							   FROM transaksi_jual,
							   		 barang 
							   WHERE transaksi_jual.id_brg=barang.id_brg
							     AND aktif=1 
							ORDER BY nomor");		  
		  while ($tr=mysql_fetch_array($trans)){
		  ?>
          <tr>
            <td align="right"><?php echo $tr['barcode']; ?></td>
            <td align="left"><?php echo $tr['nama_brg']; ?></td>
          </tr>
          <tr>
            <td align="right"><?php echo $tr['qty']. " X"; ?></td>
            <td><?php echo format_number($tr['harga_jual']); ?></td>
            <td align="right"><?php echo format_number($tr['total']); ?></td>
          </tr>
          <?php
		  }
		  ?>
          <tr><td colspan="3" class="struk_garis"></td></tr>
        </table>
        <table class="form">
          <tr>
            <td>Total Belanja</td>
            <td>:</td>
            <td><?php echo format_number($total); ?></td>
          </tr>
          <tr>
            <td>Total Disc</td>
            <td>:</td>
            <td><?php echo format_number($disck); ?></td>
          </tr>
          <tr>
            <td>Tunai</td>
            <td>:</td>
            <td><?php echo format_number($_SESSION['bayar']); ?></td>
          </tr>
          <tr>
            <td>Kembali</td>
            <td>:</td>
            <td><?php echo format_number($_SESSION['kembali']); ?></td>
          </tr>
        </table>
        <table><tr><td colspan="3" class="struk_garis"></td></tr></table>
        <table>
          <tr><td colspan="3" class="struk_judul"><b>TERIMA KASIH ATAS KUNJUNGAN ANDA</b></td></tr>
          <tr><td colspan="3" class="struk_judul">Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan lagi</td></tr>
        </table>
	  </form>
    </div><!-- end class struk -->
	<?php
	simpan_transaksi($_SESSION['id_user']);
	unset($_SESSION['bayar']);
	unset($_SESSION['kembali']);
	?>
    <script type="text/javascript">
	  main_trans();
    </script>
<?php   
   }
}
?>
