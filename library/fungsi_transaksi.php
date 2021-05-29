<?php
function cek_order(){
  global $order,$orderSR,$orderST,$JumlahTR,$TBayar;

  $ymd	= date("Y")."-".date("m")."-".date("d");

  $q_ordert = mysql_query("SELECT * FROM penjualan WHERE tanggal='$ymd' ORDER BY nota");
  if (mysql_num_rows($q_ordert)>0){
    $q_ordert = mysql_fetch_array($q_ordert) ;
	$orderSR=($q_ordert['nota']);
  }
  else{
    $orderSR=date("y").date("m").date("d").'0000';
  }

  $q_order=mysql_query("SELECT * FROM penjualan WHERE tanggal='$ymd' ORDER BY nota DESC");
  if (mysql_num_rows($q_order)>0) {
    $q_order	= mysql_fetch_array($q_order) ;
	$orderST=($q_order['nota']);
	$order=substr($q_order['nota'],6);
	$order=$order+1;

	if (strlen($order)==1){$order='000'.$order;}
	else if(strlen($order)==2){$order='00'.$order;}
	else if(strlen($order)==3){$order='0'.$order;}
	else {$order=$order;}

	$order=date("y").date("m").date("d").$order;
  }
  else{
	$order=date("y").date("m").date("d").'0001';
	$orderST=date("y").date("m").date("d").'0000';
  }

  //--total transaksi--
  $q_ttotal=mysql_query("SELECT SUM(dibayar) AS dibayar,
                              COUNT(nota) AS nota
                               FROM penjualan
                              WHERE tanggal='$ymd'
                           ORDER BY nota");
  if (mysql_num_rows($q_ttotal)>0){
    $q_ttotal = mysql_fetch_array($q_ttotal) ;
	$JumlahTR =($q_ttotal['nota']);
	$TBayar   =($q_ttotal['dibayar']);
  }
  else{
	$JumlahTR=0;
  }
}

function total_tr(){
	global $item,$disc,$disck,$total;
	$q_total=mysql_query("SELECT SUM(total) as total,
                                 SUM(diskon) AS diskon,
                                 SUM(diskonrp) AS diskonrp,
                               COUNT(id_trans) as id_trans
						        FROM transaksi_jual WHERE aktif=1") ;
	$q_total= mysql_fetch_array($q_total) ;
	$total=$q_total['total'];
	$disc=$q_total['diskon'];
	$disck=$q_total['diskonrp'];
	$item=$q_total['id_trans'];
	if ($q_total['total']==0){$total=0;}
}

function cek_transaksi($bcode){
  $q_bcode = mysql_query("SELECT * FROM barang WHERE barcode='$bcode' ORDER BY barcode") ;
  if (mysql_num_rows($q_bcode)>0){
    $q_bcode =mysql_fetch_array($q_bcode) ;
	$bid	 =$q_bcode['id_brg'];
    cek_order();
	transaksi($bid);
?>
	<script language="javascript">
      main_trans();
	</script>
<?php
  }
  else{
?>
	<script language="javascript">
	  alert("Barcode item kosong!!");
	  main_trans();
	</script>
<?php
  }
}

function transaksi($bid){
	global $order;

    //--No. Transaksi--
	$q_NOtr	= mysql_query("SELECT * FROM transaksi_jual where aktif=1 ORDER BY nomor DESC") ;
	if (mysql_num_rows($q_NOtr)>0) {
		$qno	=mysql_fetch_array($q_NOtr) ;
		$pjtno	=$qno['nomor']+1;
		if (strlen($pjtno)==1){
			$tno='0'.$pjtno;
		}
		else {$tno=$pjtno;}
	} else {$tno='01';$pjtno=1;}

    //--cek harga jual--
	$q_bjual = mysql_query("SELECT harga_jual,stock FROM barang WHERE id_brg='$bid'");
	$bjual	 = mysql_fetch_array($q_bjual) ;
	$total	 = $bjual['harga_jual'];

	if (($bjual['stock'])<=0){
?>
      <script language="javascript">
		alert("Maaf!! Stock barang habis");
		main_trans();
      </script>

<?php
	} else {
	//--INPUT--
	$q_stock = mysql_query ("INSERT INTO transaksi_jual (id_trans,
                                                         nota,
                                                         id_brg,
                                                         diskon,
                                                         total,
                                                         nomor,
                                                         aktif)
                                                 VALUES ('$order$tno',
                                                         '$order',
                                                         '$bid',
                                                         '0%',
                                                         '$total',
                                                         '$pjtno',
                                                         '1');"
							);
	//--UPStock--
	$bstock		=$bjual['stock']-1 ;
	$q_upstock  =mysql_query("UPDATE barang SET stock='$bstock' WHERE id_brg='$bid'");
	}
}

function hapus_transaksi(){
  $q_CekNOtr = mysql_query("SELECT transaksi_jual.*, barang.stock
                              FROM transaksi_jual,
                                   barang
                             WHERE transaksi_jual.id_brg=barang.id_brg
                               AND aktif=1
                          ORDER BY nomor DESC");
  if (mysql_num_rows($q_CekNOtr)>0) {
    $q_NOtr = mysql_fetch_array($q_CekNOtr) ;
    //hapus data
	$q_hapus= mysql_query("DELETE FROM transaksi_jual WHERE aktif=1 AND id_trans='$q_NOtr[id_trans]'");
	//update stock
	$bid	   = $q_NOtr['id_brg'];
	$bstock	   = $q_NOtr['stock']+$q_NOtr['qty'];
	$q_upstock = mysql_query("UPDATE barang SET stock='$bstock' WHERE id_brg='$bid'");

?>
    <script language="javascript">
    main_trans();
	</script>
<?php
  }
}

function update_transaksi($bcode){
  $q_CekNOtr = mysql_query("SELECT transaksi_jual.id_trans,
                                   transaksi_jual.diskon,
                                   transaksi_jual.qty,
                                   transaksi_jual.id_brg,
                                   barang.harga_jual,
                                   barang.stock
                              FROM transaksi_jual,
                                   barang
				             WHERE transaksi_jual.id_brg=barang.id_brg
                               AND aktif=1
                          ORDER BY nomor DESC");
  if (mysql_num_rows($q_CekNOtr)>0){
    $q_NOtr = mysql_fetch_array($q_CekNOtr) ;
    //perhitungan diskon
    $diskon	   = $q_NOtr['diskon'];
    $diskon    = str_replace('%', '',$diskon);
    $pjttotal  = (($q_NOtr['harga_jual'])-(($diskon/100)*($q_NOtr['harga_jual'])))*$bcode;
    $pjtrpdisk = (($diskon/100)*($q_NOtr['harga_jual']))*$bcode;

    if (($q_NOtr['stock'])<=0){
?>
      <script language="javascript">
        alert("Maaf!! Stock barang habis");
		main_trans();
      </script>
<?php
	}
	else{
	  //proses update total harga
	  $q_update = mysql_query("UPDATE transaksi_jual
                                  SET qty      = '$bcode',
                                      total    = '$pjttotal'
                                WHERE aktif    = 1
                                  AND id_trans = '$q_NOtr[id_trans]'");
	  //--UPStock--
	  $bid = $q_NOtr['id_brg'];
	  $bstock = $q_NOtr['stock']-$bcode+$q_NOtr['qty'];
	  $q_upstock = mysql_query("UPDATE barang SET stock='$bstock' WHERE id_brg='$bid'");
?>
      <script language="javascript">
 	    main_trans();
	  </script>
<?php
	}
  }
}

function update_diskon($bcode){
  global $diskonrp;
  $q_CekNOtr = mysql_query("SELECT transaksi_jual.id_trans,
                                   transaksi_jual.qty,
                                   barang.harga_jual
                              FROM transaksi_jual,barang
                             WHERE transaksi_jual.id_brg=barang.id_brg
                               AND aktif=1
                          ORDER BY nomor DESC");
  if (mysql_num_rows($q_CekNOtr)>0){
    $q_NOtr = mysql_fetch_array($q_CekNOtr);

	$qty = $q_NOtr['qty'];
	$pjttotal = (($q_NOtr['harga_jual'])-(($bcode/100)*($q_NOtr['harga_jual'])))*$qty;
	$diskonrp = (($bcode/100)*($q_NOtr['harga_jual']));
    //update diskon
    $q_update = mysql_query("UPDATE transaksi_jual
                                SET diskon='$bcode%',
                                    diskonrp='$diskonrp',
                                    total='$pjttotal'
                              WHERE aktif=1
                                AND id_trans='$q_NOtr[id_trans]'");
?>
    <script language="javascript">
 	  main_trans();
    </script>
<?php
  }
}

function simpan_transaksi(){
  global $order,$disc,$total,$diskonrp,$jam;

  $jam_sekarang = date("H").":".date("i").":".date("s");
  // simpan transaksi penjualan
  $q_save = mysql_query ("INSERT INTO penjualan(nota,
                                                tanggal,
                                                jam,
                                                total,
                                                dibayar,
                                                kembali,
                                                id_user)
                                         VALUES('$order',
                                                now(),
                                                '$jam_sekarang',
                                                '$total',
                                                '$_SESSION[bayar]',
                                                '$_SESSION[kembali]',
                                                '$_SESSION[id_user]')");
  //ubah field nomor dan field aktif pada table
  $q_upsave = mysql_query("UPDATE transaksi_jual SET nomor='',
                                                     aktif='0'
                                               WHERE aktif=1");
}
?>
