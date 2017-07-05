<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>alert box</title>
<style type="text/css">
<!--
h1 {
	font-family: Arial, Helvetica, sans-serif;
	color: #C00;
	margin-left: 20px;
}
body {
	background-color: #000;
}
-->
</style>
</head>

<body>
<?php
	  $myFile = 'C:\Home Portal\core\notice.txt';
      $fh = fopen($myFile, 'w') or die("can't open file");
      $stringData = "2";
      fwrite($fh, $stringData);
	  fclose($fh);
	  echo "<h1>Ο χρηστης ειδοποιηθηκε</h1>";
?>
</body>
</html>