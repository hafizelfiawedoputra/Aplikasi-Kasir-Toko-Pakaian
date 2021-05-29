<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION){
	cek_order();
	total_tr();
  ?>
    <div class="judul"><h2>Transaksi Penjualan</h2></div>
    <div class="area_main"><!-- class area_main -->
    
    <div class="trans_top"><!-- class trans_top -->
      <div class="trans_top_left"><!-- class trans_top_left -->
        Nota<br />
        Tanggal<br />
        Jam
      </div><!-- end class trans_top_left -->
      <div class="trans_top_right"><!-- class trans_top_right -->
        : <?php echo $order; ?><br />
        : <?php echo tgl_indo(date("Y m d")); ?><br />
        : <?php echo $jam; ?>
      </div><!-- end class trans_top_right -->   
      
      <div class="trans_top_left2">Total :</div>
      <div class="trans_top_right2"><h3><?php echo format_number($total); ?></h3></div>
    </div><!-- end class trans_top -->
    
      <table class="judul" >
        <tr>
          <th width="25px">no.</th>
          <th width="75px">kode</th>
          <th width="300px">nama barang</th>
          <th width="100px">harga</th>
          <th width="100px">disc</th>
          <th width="25px">qty</th>
          <th width="150px">jumlah</th>
        </tr>
      </table>
      <div class="data_trans"><!-- class data -->
      <table class="data">
      <?php
      $no=1;
      $brg = mysql_query("SELECT b.*, t.*
						    FROM barang b, 
						         transaksi_jual t
						   WHERE t.id_brg = b.id_brg
							 AND aktif=1
					    ORDER BY nomor ASC");
      $cek_brg = mysql_num_rows($brg);

      if ($cek_brg > 0){
        while($y = mysql_fetch_array($brg)){
		  $harga_jual = format_number($y['harga_jual']);
		  $total = format_number($y['total']);
	  ?>
          <tr>
            <td width="25px" align="center"><?php print $no; ?></td>
            <td width="75px"><?php echo $y['id_brg']; ?></td>
            <td width="300px"><?php echo $y['nama_brg']; ?></td>
            <td width="100px" align="right"><?php echo $harga_jual; ?></td>
            <td width="100px" align="center"><?php echo $y['diskon']; ?></td>
            <td width="25px" align="center"><?php echo $y['qty']; ?></td>
            <td width="150px" align="right"><?php echo $total; ?></td>
          </tr>
      <?php
        $no++;
        }
      }
      else{
      ?>
        <tr><td colspan="7"><b><center>DATA TRANSAKSI PENJUALAN BARANG BELUM TERSEDIA</center></b></td></tr>
      <?php
      }
      ?>
      </table>
      </div><!-- end class data -->
      
      <div class="trans_bottom"></div>
      <?php
      $bcode = $_POST['barcode'];
	  if ($bcode<>''){
	    if(isset($_POST['ok'])){ cek_transaksi($bcode);	}
		else if(isset($_POST['up'])){
		  if ($bcode=='0'){ hapus_transaksi(); }
		  else { update_transaksi($bcode); }
		}
		else if(isset($_POST['ds'])){ update_diskon($bcode); }
	  }
      ?>
      <form method="POST" action="?mod=pj">
        <div class="trans_bottom_left"><!-- class trans_bottom_left -->
          Barcode : <input type="text" name="barcode" id="barcode" size="20" maxlength="10" value="<?php echo $bid; ?>" />
          <input type="submit" name="ok" id="ok" value="" />
          <input type="submit" name="up" id="up" value="" />
          <input type="submit" name="ds" id="ds" value="" />
          <br />
          Kasir : <?php echo $_SESSION[nama_lengkap]; ?>
        </div><!-- end class trans_bottom_left -->
      </form>
      
      <div class="trans_bottom_right"><!-- class trans_bottom_right -->
        ENTER = Input Barang || F2 = Hapus item terakhir [0+F2] / ubah item QTY terakhir [angka+F2] ||
        F4 = Ubah item diskon terakhir [angka+F4] || F7 = Bayar || ESC = Keluar
      </div><!-- end class trans_bottom_right -->
    
    </div><!-- end class area_main -->
    <?php
  }
}
?>
<script type="text/javascript">
	id_bar();
	bar_focus();
	aksi_trans();
</script>