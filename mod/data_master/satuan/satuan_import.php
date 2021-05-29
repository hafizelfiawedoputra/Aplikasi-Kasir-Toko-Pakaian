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
  		$nama_sat     = $aksi->val($y, 1);

  		if($nama_sat != ""){
    	// input data ke database (table kategori)
    	mysql_query("INSERT into satuan values('','$nama_sat')");
    	$berhasil++;
 	 	}
	}

	/// hapus kembali file .xls yang di upload tadi
	unlink($_FILES['fileketegori']['name']);

	// alihkan halaman ke index.php
	header('location:../../../mediaweb.php?mod=sat');
?>