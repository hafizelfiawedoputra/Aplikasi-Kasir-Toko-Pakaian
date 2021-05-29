<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION){
    total_tr();
    if(isset($_POST['ok'])){
	  $bayar = $_POST['dibayar'];
	  if (($total<>0)&&($bayar)<>0){
	    $kembali = $bayar-$total;
		$_SESSION['bayar'] = $bayar;
		$_SESSION['kembali'] = $kembali;
		
		cek_order();
		total_tr();
		?>
        <script type="text/javascript">
		  cetak_struk();
        </script>
        <?php
	  }
	  else{
	    $total = 0;
		$bayar = 0;
		$kembali = 0;
	  }
	}
  ?>
    <div class="judul"><h2>Transaksi Pembayaran</h2></div>
    <div class="area_main"><!-- class area_main -->
      <div class="bayar"><!-- class item_barang --> 
      <form name="bayar" action="?mod=bayar" method="POST">										
        <table class="form" >
          <tr>
            <td>Total Belanja</td>
            <td>:</td>
            <td><input type="text" class="total" name="total_belanja" id="total_belanja" value="<?php echo format_number($total); ?>" size="25" /></td>
          </tr>
		  <tr>
            <td>Dibayar</td>
            <td>:</td>
            <td><input type="text" name="dibayar" id="dibayar" value="" size="25" /></td>
          </tr>
 		  <tr>
            <td>Kembali</td>
            <td>:</td>
            <td><input type="text" class="total" name="kembali" id="kembali" value="<?php echo format_number($kembali); ?>" size="25" /></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input type="submit" id="ok" class="button" name="ok" value="Simpan"></td>
          </tr>
      </table>
      </div><!-- end class item_barang -->
    </div><!-- end class area_main -->
    <?php
  }
}
?>
<script type="text/javascript">
	bayar_focus();
	int_bayar();
	aksi_bayar();
</script>