<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION[status]=='admin'){
    $aksi="mod/data_master/barang/barang_aksi.php";
  ?>
    <div class="judul"><h2>Data Barang</h2></div>
    <div class="tambah">
    <form method="post" enctype="multipart/form-data" action="mod/data_master/barang/barang_import.php">
    <input name="fileketegori" id="fileketegori" type="file" required="required"><input name="upload" type="submit" value="Import" class="button">
    <input type="button" class="button" value="Tambah Data" onclick="brg_tb()"></div>
    <div class="area_main"><!-- class area_main -->											
      <table class="judul" >
        <tr>
          <th width="25px" align="center">no.</th>
          <th width="225px">nama barang</th>
          <th width="100px">merk</th>
          <th width="100px">kategori</th>
          <th width="100px">satuan</th>
          <th width="100px">harga beli</th>
          <th width="100px">harga jual</th>
          <th width="50px">stock</th>
          <th width="60px" align="center">aksi</th>
        </tr>
      </table>
      <div class="data"><!-- class data -->
      <table class="data">
      <?php
      $no=1;
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
		  $harga_jual = format_number($y['harga_jual']);
		  $harga_beli = format_number($y['harga_beli']);
	  ?>
          <tr>
            <td width="25px" align="center"><?php print $no; ?></td>
            <td width="225px"><?php echo $y['nama_brg']; ?></td>
            <td width="100px"><?php echo $y['nama_merk']; ?></td>
            <td width="100px"><?php echo $y['nama_kat']; ?></td>
            <td width="100px"><?php echo $y['nama_sat']; ?></td>
            <td width="100px" align="right"><?php echo $harga_beli; ?></td>
            <td width="100px" align="right"><?php echo $harga_jual; ?></td>
            <td width="50px" align="center"><?php echo $y['stock']; ?></td>
            <td width="60px" align="center">
              <a href="?mod=brg_ub&id=<?php echo $y['id_brg']; ?>"><img src="images/edit.png" title="edit"></a> |
              <a href="<?php echo "$aksi?mod=brg&aksi=hap_dt&id=$y[id_brg]"; ?>" onclick="return confirm('Anda yakin ingin menghapus data <?php echo $y['nama_brg']; ?>')"><img src="images/delete.png" title="Hapus"></a>
            </td>
          </tr>
      <?php
        $no++;
        }
      }
      else{
      ?>
        <tr><td colspan="9"><b><center>DATA BARANG BELUM TERSEDIA</center></b></td></tr>
      <?php
      }
      ?>
      </table>
      </div><!-- end class data -->
      <div class="jml_data">Jumlah Data : <?php echo $cek_brg; ?></div>
    </div><!-- end class area_main -->
    <?php
  }
}
?>