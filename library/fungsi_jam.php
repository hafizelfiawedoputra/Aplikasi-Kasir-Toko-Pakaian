<?php
ob_start();
?>
<span id="jam">
  <script language="javascript">
  jam();
  function jam(){
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds()
    var timeValue = "" + ((hours >23) ? hours -24 :hours)
    timeValue = ((hours <10) ? "0" : "") + hours
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds
    document.getElementById("jam").innerHTML = " "+timeValue;
	setTimeout("jam()", 1000);
  }
  </script>
</span>
<?php
$jam = ob_get_contents();
ob_end_clean();
?>

