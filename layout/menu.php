<?php
if ($_SESSION['status']=='admin'){
?>
  <ul class="dropdown">
    <li><a href="?mod=beranda">Beranda</a></li>
    
	<li><a href="#">Data Master</a>
	  <ul>
        <li><a href="?mod=kat">Data Kategori</a></li>
        <li><a href="?mod=merk">Data Merk</a></li>
        <li><a href="?mod=sat">Data Satuan</a></li>
	    <li><a href="?mod=brg">Data Barang</a></li>
	  </ul>
	</li>
	
    <li><a href="#">Transaksi</a>
	  <ul><li><a href="?mod=pj">Penjualan</a></li></ul>
	</li>		
	
    <li><a href="#">Laporan</a>
	  <ul>
	    <li><a href="?mod=lap_brg">Laporan Barang</a></li>
	    <li><a href="?mod=lap_pj">Laporan Penjualan</a></li>
        <li><a href="?mod=rin_pj">Rincian Penjualan</a></li>										
	  </ul>
    </li>
    
    <li><a href="#">Utility</a>
	  <ul>
        <li><a href="?mod=tok">Profil Toko</a></li>
		<li><a href="?mod=pass">Ubah Password</a></li>
	    <li><a href="?mod=bar">Cetak Barcode</a></li>
	  </ul>
    </li>
    
    <li><a href="mod/logout.php">Logout</a></li>		
  </ul>
<?php
}
?>


<?php
if ($_SESSION['status']=='karyawan'){
?>
  <ul class="dropdown">
    <li><a href="?mod=beranda">Beranda</a></li>
    
	
    <li><a href="#">Transaksi</a>
	  <ul><li><a href="?mod=pj">Penjualan</a></li></ul>
	</li>		
	
    <li><a href="#">Laporan</a>
	  <ul>
	    <li><a href="?mod=lap_brgk">Laporan Barang</a></li>
	    <li><a href="?mod=rin_pj">Rincian Penjualan</a></li>									
	  </ul>
    </li>
    
    <li><a href="mod/logout.php">Logout</a></li>		
  </ul>
<?php
}
?>
