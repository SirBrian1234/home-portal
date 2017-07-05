<?php
if ($_SERVER['REMOTE_ADDR']=="127.0.0.1")
{
   $isadmin=1;
}
else
{
   $isadmin=0;
   echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
   <html>
   <head>
   <meta http-equiv=\"REFRESH\" content=\"0; url=/index.php \"></HEAD>";
}
?>

<script type="text/javascript">
function swap()
{
	document.getElementById('swappoint').innerHTML=' ';
}
</script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
  <div id=swappoint>
    <p><img src="../img/loading.gif" height="150" style="padding-left:100px"/></p>
    <p><span>Ενημερωση router</span></p>
    <p><span>Το Home Portal ενημεωνει το router σας. Μην κλεισετε αυτο το παραθυρο μεχρι να ολοκληρωθει η λειτουργια.</span></p>
  </div>
  <iframe src="openport.php" frameborder="0" width="428" height="600" onload="swap()" id="frame" ></iframe>
</body>

</html>