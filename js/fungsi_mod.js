function beranda(){
   setTimeout(self.location.href="?mod=beranda", 1000);
}
function kat_tb(){
   window.location.href="?mod=kat_tb";
}
function kat_bat(){
   setTimeout(self.location.href="?mod=kat", 1000);
}
function merk_tb(){
   window.location.href="?mod=merk_tb";
}
function merk_bat(){
   setTimeout(self.location.href="?mod=merk", 1000);
}
function sat_tb(){
   window.location.href="?mod=sat_tb";
}
function sat_bat(){
   setTimeout(self.location.href="?mod=sat", 1000);
}
function brg_tb(){
   window.location.href="?mod=brg_tb";
}
function brg_bat(){
   setTimeout(self.location.href="?mod=brg", 1000);
}
function ctk_bar(){
   setTimeout(self.location.href="?mod=ctk_bar", 1000);
}
//--------------- fungsi aksi transaksi ---------------
function id_bar() {
  document.getElementById("barcode").onkeypress=function(e){
    var e=window.event || e
    var keyunicode=e.charCode || e.keyCode
    return ((keyunicode>=48 && keyunicode<=57) || keyunicode==8 || keyunicode==46 || keyunicode==32)? true : false
  }
}
function bar_focus(){
  document.forms[0].barcode.focus();
  setTimeout("bar_focus()", 3000);
}
function main_trans(){
  setTimeout('self.location.href = "?mod=pj"',1);
}
function aksi_trans(){
  document.onkeydown = function(e){
  
    if (e.keyCode==27){
	  var request = confirm("Apakah Anda ingin keluar dari aplikasi ini?");
	  if (request == true){
	    self.location.href ="mod/logout.php";
	  }
	  else{
	    main_trans();
	  }
	}
	
	else if (e.keyCode==13){ document.forms[0].ok.click(); } // enter keyboard
	else if (e.keyCode==113){ document.forms[0].up.click(); } // F2 keyboard
	else if (e.keyCode==115){ document.forms[0].ds.click(); } // F4 keyborad
	else if (e.keyCode==118){ self.location.href ="?mod=bayar"; } // F7 keyboard
  }
}
function nama_focus(){
  document.forms[0].nama_brg.focus();
  setTimeout("nama_focus()", 1000);
}
function bayar_focus(){
  document.forms[0].dibayar.focus();
  setTimeout("bayar_focus()", 1000);
}
function int_bayar() {
  document.getElementById("dibayar").onkeypress=function(e){
    var e=window.event || e
    var keyunicode=e.charCode || e.keyCode
    return ((keyunicode>=48 && keyunicode<=57) || keyunicode==8 || keyunicode==46)? true : false
  }
}
function aksi_bayar(){
  document.onkeydown = function(e){
	if (e.keyCode==27){ main_trans(); }
	else if (e.keyCode==13){ document.forms[0].ok.click(); }
	else {bayar_fokus();} 
  }
}
function cetak_struk() {
  setTimeout("self.location.href ='?mod=ctk_str'",1000);
}
//--------------- end fungsi aksi transaksi ---------------