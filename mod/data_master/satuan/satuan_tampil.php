<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION[status]=='admin'){
    $aksi="mod/data_master/satuan/satuan_aksi.php";
  ?>
    <div class="judul"><h2>Data Satuan</h2></div>
    <div class="tambah">
    <form method="post" enctype="multipart/form-data" action="mod/data_master/satuan/satuan_import.php">
    <input name="fileketegori" id="fileketegori" type="file" required="required"><input name="upload" type="submit" value="Import" class="button">
    <input type="button" class="button" value="Tambah Data" onclick="sat_tb()"></div>
    <div class="area_main"><!-- class area_main -->											
      <table class="judul" >
        <tr>
          <th width="50px">no.</th>
          <th width="700px">nama satuan</th>
          <th width="80px" align="center">aksi</th>
        </tr>
      </table>
      <div class="data"><!-- class data -->
      <table class="data">
      <?php
      $no=1;

      $sat = mysql_query("SELECT * FROM satuan ORDER BY id_sat DESC");
      $cek_sat = mysql_num_rows($sat);

      if ($cek_sat > 0){
        
        while($y = mysql_fetch_array($sat)){
	  ?>
          <tr>
            <td width="50px" align="center"><?php echo $no; ?></td>
            <td width="700px"><?php echo $y['nama_sat']; ?></td>
            <td width="80px" align="center">
              <a href="?mod=sat_ub&id=<?php echo $y['id_sat']; ?>"><img src="images/edit.png" title="edit"></a> |
              <a href="<?php echo "$aksi?mod=sat&aksi=hap_dt&id=$y[id_sat]"; ?>" onclick="return confirm('Anda yakin ingin menghapus data <?php echo $y['nama_sat']; ?>')"><img src="images/delete.png" title="Hapus"></a>
            </td>
          </tr>
      <?php
        $no++;
        }
      }
      else{
      ?>
        <tr><td colspan="3"><b><center>DATA SATUAN BELUM TERSEDIA</center></b></td></tr>
      <?php
      }
      ?>
      </table>
      </div><!-- end class data -->
      <div class="jml_data">Jumlah Data : <?php echo $cek_sat; ?></div>
    </div><!-- end class area_main -->
    <?php
  }
}
?>