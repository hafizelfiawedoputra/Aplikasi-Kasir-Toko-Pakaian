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
    <script language="javascript" src="mod/laporan/rincian_penjualan/ajax_rinci.js"></script>
    
    <div class="judul"><h2>Rincian Penjualan Barang</h2></div>
    <div class="tambah"><input type="button" id="cetak" class="button" value="Cetak Data" ></div>
    <div class="area_main"><!-- class area_main -->
    
      <div id="laporan"><!-- id laporan -->
      <div class="judul_lap"><h2>Rincian Data Penjualan Barang</h2></div>										
        <table class="form">
          <tr>
            <td><b>Nota Penjualan</b></td>
            <td><b>:</b></td>
            <td><input type="text" name="nota" id="nota" maxlength="10" /></td>
          </tr>
        </table>            
        <div id="rinci"></div>
      </div><!-- end id laporan -->
    
    </div><!-- end class area_main -->
    <?php
  }
}
?>