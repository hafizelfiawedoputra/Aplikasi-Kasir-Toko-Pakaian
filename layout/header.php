<?php  
include "library/koneksi.php";

if ($_SESSION){
  $query     = mysql_query("SELECT * FROM toko LIMIT 1");
  $jml_field = mysql_num_rows($query);
  if ($jml_field == 1){
    $y       = mysql_fetch_array($query);  
    echo "<h3>$y[nama]</h3>
  	  	  <h4>$y[alamat] <br />Telp. $y[telp] Email : $y[email]</h4>";
  }
}
?>
