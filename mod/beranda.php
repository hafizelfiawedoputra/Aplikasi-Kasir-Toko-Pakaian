<?php
if ($_SESSION['status']=='admin'){
?>
  <div class="judul_awal"><h2>Selamat Datang</h2></div>
  <p>Sekarang Anda berada pada <b>APLIKASI PENJUALAN</b><br />
     Anda login sebagai : <b><?php echo $_SESSION['username']; ?></b>, pada hari <b><?php echo $hari_ini.", ". tgl_indo(date("Y m d")). " | " . date("H:i:s") ." WIB "; ?></b><br />
     Pada aplikasi penjualan ini terdapat 5 menu utama dan 10 sub menu, yaitu :
     <ol class="beranda">
       <li>Beranda : sebuah menu utama yang digunakan untuk menampilkan halaman utama</li>
       <li>Data Master : sebuah menu utama yang digunakan untuk menampung 6 buah sub menu, yaitu : 
         <ol type="a">
           <li>Data Kategori : sebuah sub menu yang digunakan untuk menampilkan halaman data kategori barang</li>
           <li>Data Merk : sebuah sub menu yang digunakan untuk menampilkan halaman data merk barang</li>
           <li>Data Satuan : sebuah sub menu yang digunakan untuk menampilkan halaman data satuan barang</li>
           <li>Data Barang : sebuah sub menu yang digunakan untuk menampilkan halaman data barang</li>
           <li>Data Toko : sebuah sub menu yang digunakan untuk menampilkan halaman data toko atau profil sebuah perusahaan</li>
         </ol>
       </li>
       <li>Transaksi : sebuah menu utama yang digunakan untuk menampung 1 buah sub menu, yaitu :
         <ol type="a">
           <li>Penjualan : sebuah sub menu yang digunakan untuk menampilkan halaman transaksi penjualan barang</li>
         </ol>
       </li>
       <li>Laporan : sebuah menu utama digunakan untuk menampung 2 buah sub menu, yaitu :
         <ol type="a">
           <li>Laporan Barang : sebuah sub menu yang digunakan untuk menampilkan halaman laporan data barang</li>
           <li>Laporan Penjualan : sebuah sub menu yang digunakan untuk menampilkan halaman laporan data penjualan barang</li>
         </ol>
       </li>
       <li>Utility : sebuah menu utama yang digunakan untuk menampung 1 buah sub menu, yaitu :
         <ol type="a">
           <li>Cetak Barcode : sebuah sub menu yang digunakan untuk menampilkan halaman cetak barcode atau membuat barcode</li>
           <li>Ubah Password : sebuah sub menu yang digunakan untuk menampilkan halaman ubah password yang diperuntukan bagi user yang akan mengganti password</li>
         </ol>
       </li>
       <li>Logout : sebuah menu utama yang digunakan untuk keluar dari aplikasi program</li>
     </ol> 
     Perlu diperhatikan!! Apabila Anda ingin keluar pada aplikasi ini, Anda harus <a href="mod/logout.php"><b>Logout</b></a> untuk menjaga keamanan sistem.
  </p>
<?php
}
?>


<?php
if ($_SESSION['status']=='karyawan'){
?>
  <div class="judul_awal"><h2>Selamat Datang</h2></div>
  <p>Sekarang Anda berada pada <b>APLIKASI PENJUALAN</b><br />
     Anda login sebagai : <b><?php echo $_SESSION['username']; ?></b>, pada hari <b><?php echo $hari_ini.", ". tgl_indo(date("Y m d")). " | " . date("H:i:s") ." WIB "; ?></b><br />
     Pada aplikasi penjualan ini terdapat 4 menu utama, yaitu :
     <ol class="beranda">
       <li>Beranda : sebuah menu utama yang digunakan untuk menampilkan halaman utama</li>
       <li>Transaksi : sebuah menu utama yang digunakan untuk menampung 1 buah sub menu, yaitu :
         <ol type="a">
           <li>Penjualan : sebuah sub menu yang digunakan untuk menampilkan halaman transaksi penjualan barang</li>
         </ol>
       </li>
       <li>Laporan : sebuah menu utama digunakan untuk menampung 2 buah sub menu, yaitu :
         <ol type="a">
           <li>Laporan Barang : sebuah sub menu yang digunakan untuk menampilkan halaman laporan data barang</li>
           <li>Laporan Penjualan : sebuah sub menu yang digunakan untuk menampilkan halaman laporan data penjualan barang</li>
         </ol>
       </li>
       <li>Logout : sebuah menu utama yang digunakan untuk keluar dari aplikasi program</li>
     </ol> 
     Perlu diperhatikan!! Apabila Anda ingin keluar pada aplikasi ini, Anda harus <a href="mod/logout.php"><b>Logout</b></a> untuk menjaga keamanan sistem.
  </p>
<?php
}
?>