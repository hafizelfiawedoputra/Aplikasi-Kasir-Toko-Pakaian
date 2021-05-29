<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
?>
   <script>alert('Untuk mengakses halaman admin, Anda harus login terlebih dahulu.'); window.location = './index.php'</script>
<?php
}
else{
  if ($_SESSION[status]=='admin'){
  ?>
    <script type="text/javascript">
    if (window.print){document.write();}
      function move(){
	    setTimeout('self.location.href ="?mod=bar"',1);
	  }
    </script>
    <?php
    if ($_SESSION['barcode']==1){ 
    ?>
	  <script type="text/javascript">
	    setTimeout('window.print()', 1000);
        setTimeout('move()', 1000);
	  </script>
      <?php
	  $qry=mysql_query("SELECT barang.*,
	  						   kategori.*,
							   cetak_barcode.*
						  FROM barang, kategori, cetak_barcode
					     WHERE barang.id_brg = cetak_barcode.id_brg
						   AND barang.id_kat = kategori.id_kat
					  ORDER BY barang.id_brg");
	  while ($row=mysql_fetch_array($qry)){
	    $i=1;
	    while($i<=($row[qty])){
        ?>
          <div class="barcode">
	        <?php print bar128(stripslashes($row[barcode]),$row[harga_jual]); ?>
          </div>
        <?php
          $i++;
	    }
	    print "</br>";
	    $q_delbar=mysql_query("DELETE FROM cetak_barcode WHERE id_bar='$row[id_bar]'");
	  }
	  unset($_SESSION['barcode']);
    }
	else{
      ?>
	  <script type="text/javascript">
      setTimeout('self.location.href ="?mod=bar"',1);
	  </script>
	  <?php
	}
  }
}
?>
