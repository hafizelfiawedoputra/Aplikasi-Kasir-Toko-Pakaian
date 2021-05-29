<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION[status]=='admin'){
	if (isset($_POST['tampil'])){
		$tgl_awal=tgl_sql($_POST['tgl_awal']);
		$tgl_akhir=tgl_sql($_POST['tgl_akhir']);
	}
  ?>
    <div class="judul"><h2>Laporan Data Penjualan Barang</h2></div>
    <div class="tambah"><input type="button" id="cetak" class="button" value="Cetak Data" ></div>
    <div class="area_main"><!-- class area_main -->	
      <form name="lap_jual" action="?mod=lap_pj" method="POST">
      <table class="tanggal">
        <tr>
          <td>Tanggal Awal</td>
          <td>:</td>
          <td><input type="text" name="tgl_awal" class="tgl" size="10" /></td>
          <td>&nbsp;</td>
          <td>Tanggal Akhir</td>
          <td>:</td>
          <td><input type="text" name="tgl_akhir" class="tgl" size="10" /></td>
          <td>&nbsp;</td>
          <td><input type="submit" name="tampil" class="button" value="Tampil" /></td>
        </tr>
      </table>	
    <div id="laporan"><!-- id laporan -->
      <div class="judul_lap"><h2>Laporan Data Penjualan Barang</h2></div>										
      <table class="lap">
        <tr>
          <th width="25px" align="center">no.</th>
          <th width="50px">nota</th>
          <th width="75px">tanggal</th>
          <th width="100px">total</th>
          <th width="100px">dibayar</th>
          <th width="100px">kembali</th>
          <th width="100px">kasir</th>
        </tr>
      <?php
      $no=1;
	  
      $brg = mysql_query("SELECT penjualan.nota, 
						 		 penjualan.tanggal,
								 penjualan.total,
								 penjualan.dibayar,
								 penjualan.kembali,
								 user.nama_lengkap
							FROM penjualan, user 
						   WHERE penjualan.id_user = user.id_user
						     AND penjualan.tanggal >= '$tgl_awal'
                             AND penjualan.tanggal <= '$tgl_akhir'
						ORDER BY penjualan.nota DESC");
      $cek_brg = mysql_num_rows($brg);

      if ($cek_brg > 0){
        while($y = mysql_fetch_array($brg)){
		  $total   = format_number($y['total']);
		  $dibayar = format_number($y['dibayar']);
		  $kembali = format_number($y['kembali']);
		  $tgl	   = tgl_indo($y['tanggal']);
	  ?>
          <tr>
            <td width="25px" align="center"><?php echo $no; ?></td>
            <td width="50px" align="center"><?php echo $y['nota']; ?></td>
            <td width="75px"><?php echo $tgl; ?></td>
            <td width="100px" align="right"><?php echo $total; ?></td>
            <td width="100px" align="right"><?php echo $dibayar; ?></td>
            <td width="100px" align="right"><?php echo $kembali; ?></td>
            <td width="100px"><?php echo $y['nama_lengkap']; ?></td>
          </tr>
      <?php
        $no++;
        }
      }
      else{
      ?>
        <tr><td colspan="7"><b><center>LAPORAN DATA PENJUALAN BARANG BELUM TERSEDIA</center></b></td></tr>
      <?php
      }
      ?>
      </table>
      </div><!-- end id laporan -->
      </form>
    </div><!-- end class area_main -->
    <?php
  }
}
?>
