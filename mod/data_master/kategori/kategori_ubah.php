<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION['status']=='admin'){
    $aksi="mod/data_master/kategori/kategori_aksi.php";
	   
    $tampil = mysql_query("SELECT * FROM kategori WHERE id_kat='$_GET[id]'");
    $y      = mysql_fetch_array($tampil);
    ?>
    <div class="judul"><h2> Ubah Data Kategori</h2></div>
       <div class="area_main">
         <form method="POST" action="<?php echo "$aksi?mod=kat&aksi=ubh_dt"; ?>">
           <table class="form">
			 <tr>
               <td>Nama Kategori</td>
               <td>:</td>
               <td><input type="hidden" name="id_kat" value="<?php echo $y['id_kat']; ?>">
                   <input type="text" name="nama_kat" id="nama_kat" value="<?php echo $y['nama_kat']; ?>" size="41px" />
               </td>
             </tr>
             <tr>
               <td></td>
               <td></td>
               <td><input type="submit" class="button" value="Simpan"> <input type="button" class="button" value="Batal" onclick="kat_bat()"></td>
             </tr>
           </table>
		 </form>
       </div>
<?php
   }
}
?>