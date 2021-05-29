<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION['status']=='admin'){
    $aksi="mod/data_master/merk/merk_aksi.php";
	   
    $tampil = mysql_query("SELECT * FROM merk WHERE id_merk='$_GET[id]'");
    $y      = mysql_fetch_array($tampil);
    ?>
    <div class="judul"><h2> Ubah Data Merk</h2></div>
       <div class="area_main">
         <form method="POST" action="<?php echo "$aksi?mod=merk&aksi=ubh_dt"; ?>">
           <table class="form">
			 <tr>
               <td>Nama Merk</td>
               <td>:</td>
               <td><input type="hidden" name="id_merk" value="<?php print $y['id_merk']; ?>">
                   <input type="text" name="nama_merk" id="nama_merk" value="<?php print $y['nama_merk']; ?>" size="41px" />
               </td>
             </tr>
             <tr>
               <td></td>
               <td></td>
               <td><input type="submit" class="button" value="Simpan"> <input type="button" class="button" value="Batal" onclick="merk_bat()"></td>
             </tr>
           </table>
		 </form>
       </div>
<?php
   }
}
?>