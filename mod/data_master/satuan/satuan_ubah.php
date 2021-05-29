<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION['status']=='admin'){
    $aksi="mod/data_master/satuan/satuan_aksi.php";
	   
    $tampil = mysql_query("SELECT * FROM satuan WHERE id_sat='$_GET[id]'");
    $y      = mysql_fetch_array($tampil);
    ?>
    <div class="judul"><h2> Ubah Data Satuan</h2></div>
       <div class="area_main">
         <form method="POST" action="<?php echo "$aksi?mod=sat&aksi=ubh_dt"; ?>">
           <table class="form">
			 <tr>
               <td>Nama Satuan</td>
               <td>:</td>
               <td><input type="hidden" name="id_sat" value="<?php print $y['id_sat']; ?>">
                   <input type="text" name="nama_sat" id="nama_sat" value="<?php print $y['nama_sat']; ?>" size="41px" />
               </td>
             </tr>
             <tr>
               <td></td>
               <td></td>
               <td><input type="submit" class="button" value="Simpan"> <input type="button" class="button" value="Batal" onclick="sat_bat()"></td>
             </tr>
           </table>
		 </form>
       </div>
<?php
   }
}
?>