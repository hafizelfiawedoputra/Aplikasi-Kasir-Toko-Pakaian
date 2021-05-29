$(document).ready(function(){
  
  //fokuskan kurson pada textbox yang mempunyai elemen id nota
  $("#nota").focus();
  
  //buat agar karakter yang diinputkan hanya angka
  $("#nota").keypress(function (data){ 
    if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)){
	  return false;
	}	
  });
  
  $("#rinci").load('mod/laporan/rincian_penjualan/rincian_barang.php');
  
  $("#nota").keyup(function(){
    var cari = $("#nota").val();
	cariNota(cari);
	cariJual(cari);
  });
  
  function cariNota(e){
    var cari = e;
	$.ajax({
	  type	   : "POST",
	  url	   : "mod/laporan/rincian_penjualan/rincian_barang.php",
	  data	   : "cari="+cari,
	  success  : function(data){
		$(".rinci_brg").html(data);
	  }
	});
  }
  
  function cariJual(y){
    var cari = y;
	$.ajax({
	  type     : "POST",
	  url	   : "mod/laporan/rincian_penjualan/cari_penjualan.php",
	  data	   : "cari="+cari,
	  dataType : "json",
	  success  : function(data){
	    $("#tgl").val(data.tanggal);
		$("#kasir").val(data.nama_lengkap);
	  }
	});
  }
	
});