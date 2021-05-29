<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION[status]=='admin'){
    $aksi="mod/data_master/merk/merk_aksi.php";
  ?>
    <div class="judul"><h2>Data Merk</h2></div>
    <div class="tambah">
    <form method="post" enctype="multipart/form-data" action="mod/data_master/merk/merk_import.php">
    <input name="fileketegori" id="fileketegori" type="file" required="required"><input name="upload" type="submit" value="Import" class="button">
    <input type="button" class="button" value="Tambah Data" onclick="merk_tb()"></div>
    <div class="area_main"><!-- class area_main -->											
      <table class="judul" >
        <tr>
          <th width="50px">no.</th>
          <th width="700px">nama merk</th>
          <th width="80px" align="center">aksi</th>
        </tr>
      </table>
      <div class="data"><!-- class data -->
      <table class="data">
      <?php
      $no=1;

      $merk = mysql_query("SELECT * FROM merk ORDER BY id_merk DESC");
      $cek_merk = mysql_num_rows($merk);

      if ($cek_merk > 0){
        while($y = mysql_fetch_array($merk)){
	  ?>
          <tr>
            <td width="50px" align="center"><?php echo $no; ?></td>
            <td width="700px"><?php echo $y['nama_merk']; ?></td>
            <td width="80px" align="center">
              <a href="?mod=merk_ub&id=<?php echo $y['id_merk']; ?>"><img src="images/edit.png" title="edit"></a>  |
              <a href="<?php echo "$aksi?mod=merk&aksi=hap_dt&id=$y[id_merk]"; ?>" onclick="return confirm('Anda yakin ingin menghapus data <?php echo $y['nama_merk']; ?>')"><img src="images/delete.png" title="Hapus"></a>
            </td>
          </tr>
      <?php
        $no++;
        }
      }
      else{
      ?>
        <tr><td colspan="3"><b><center>DATA MERK BELUM TERSEDIA</center></b></td></tr>
      <?php
      }
      ?>
      </table>
      </div><!-- end class data -->
      <div class="jml_data">Jumlah Data : <?php echo $cek_merk; ?></div>
    </div><!-- end class area_main -->
    <?php
  }
}
?>