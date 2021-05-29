<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Login Administrator ::</title>

<link rel="stylesheet" type="text/css" href="css/style_login.css" />

<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />

<script language="javascript">
function validasi(form){
if (form.username.value==""){
	alert("Username masih kosong");
	form.username.focus();
	return (false);
	}
if (form.password.value==""){
	alert("Password masih kosong");
	form.password.focus();
	return (false);
	}
	
	return (true);
}
</script>
</head>

<body onload="document.login.username.focus();">

<div id="wrapper"><!-- Awal id wrapper -->
   <div id="login" class="kotak"><!-- Awal id login awal class kotak -->
   
      <div id="atas"><h2>Login Administrator</h2><!-- Awal id atas -->
         <div id="kiri"></div>
         <div id="kanan"><!-- Awal id kanan -->
         
            <div class="main"><!-- Awal class main -->
            <form name="login" method="post" action="cek_login.php" onsubmit="return validasi(this)">
               <dl>
                  <dt><label>Username :</label></dt>
                  <dd><input type="text" name="username" id="username" /></dd>
                  <dt><label>Password :</label></dt>
                  <dd><input type="password" name="password" id="adminpassword" /></dd>
               </dl>
          	   <p>
               <input type="submit" class="button" value="Login" />
               <input type="reset" class="button" value="Reset" />
               </p>   
   			</form>
            </div><!-- Akhir class main -->
            
         </div><!-- Akhir id kanan -->
      </div><!-- Akhir id atas -->
      
      <div id="bawah"></div>

   </div><!-- Akhir id login akhir class kotak -->
</div><!-- Akhir id wrapper -->
</body>
</html>
