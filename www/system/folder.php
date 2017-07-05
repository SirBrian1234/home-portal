<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>open folder</title>
<style type="text/css">
<!--
h1 {
	font-family: Arial, Helvetica, sans-serif;
	margin-left: 20px;
}
-->
</style>
</head>

<body>
<?php
	  if ($_SERVER['REMOTE_ADDR']=="127.0.0.1") $isadmin=1;
	  else $isadmin=0;
	  
	  if ($isadmin==1) {
	  
	  if ($_REQUEST['folder']==1)
	  	$num='3';
	  else if ($_REQUEST['folder']==2)
	  	$num='4';
	  else if ($_REQUEST['folder']==3)
	    $num='5';
	  else if ($_REQUEST['folder']==4)
	    $num='6';
		
	  $myFile = 'C:\Home Portal\core\notice.txt';
      $fh = fopen($myFile, 'w') or die("can't open file");
      $stringData = $num;
      fwrite($fh, $stringData);
	  fclose($fh);
	  echo "<h1>Ανοιγμα φακελου...</h1>";
	  }
?>
</body>
</html>