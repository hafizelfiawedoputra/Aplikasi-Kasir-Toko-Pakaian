<?php
	mysql_connect('localhost', 'root', '');
	mysql_select_db('dbpenjualan');

	//memanggil file excel_reader
	require "excel_reader2.php";

	// upload file xls
	$target = basename($_FILES['fileketegori']['name']) ;
	move_uploaded_file($_FILES['fileketegori']['tmp_name'], $target);

	// beri permisi agar file xls dapat di baca
	chmod($_FILES['fileketegori']['name'], 0777);

	// mengambil isi file xls
	$aksi = new Spreadsheet_Excel_Reader($_FILES['fileketegori']['name'], false);
	// menghitung jumlah baris data yang ada
	$jumlah_baris = $aksi->rowcount($sheet_index=0);

	// jumlah default data yang berhasil di import
	$berhasil = 0;
	for ($y=2; $y<=$jumlah_baris; $y++){

  		// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
  		$id_brg     = $aksi->val($y, 1);
  		$id_merk    = $aksi->val($y, 2);
  		$id_kat     = $aksi->val($y, 3);
  		$id_sat     = $aksi->val($y, 4);
  		$nama_brg   = $aksi->val($y, 5);
  		$harga_beli = $aksi->val($y, 6);
  		$harga_jual = $aksi->val($y, 7);
  		$bercode    = $aksi->val($y, 8);
  		$stock     	= $aksi->val($y, 9);

  		if($id_brg != "" && $id_merk != "" && $id_kat != "" && $id_sat != "" && $nama_brg != "" && $harga_beli != "" && $harga_jual != "" && $bercode != "" && $stock != ""){
    	// input data ke database (table kategori)
    	mysql_query("INSERT into barang values('$id_brg','$id_merk','$id_kat','$id_sat','$nama_brg','$harga_beli','$harga_jual','$bercode','$stock')");
    	$berhasil++;
 	 	}
	}

	/// hapus kembali file .xls yang di upload tadi
	unlink($_FILES['fileketegori']['name']);

	// alihkan halaman ke index.php
	header('location:../../../mediaweb.php?mod=brg');
?>