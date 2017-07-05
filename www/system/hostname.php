<?php
Require "../data/hostnames.php";
Require "../data/preferences.php";
?>

<style type="text/css">
<!--
body {
   background-color: <?php echo $panel_color; ?>;
   color: <?php echo $text_color; ?>;
}
-->
</style>

<?php
if(!$_REQUEST['hostname'])
{
 $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
 echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
      <html>
      <head>
      <meta http-equiv="REFRESH" content="0; url=http://127.0.0.1:800/system/hostname.php?lan=1&hostname='.$hostname.' "></HEAD>';
}
 else
{
 if ($_REQUEST['lan'])
 echo 'Your address is: '.$_REQUEST['hostname'].':800<br />other people can find you on: <br><h3>http://'.$_REQUEST['hostname'].':800</h3>';
 else
 {
  if ($wan_port==80) echo 'Your address is: '.$_REQUEST['hostname'].'<br />other people can find you on: <br><h3>http://'.$_REQUEST['hostname'].'</h3>';
  else echo 'Your address is: '.$_REQUEST['hostname'].'<br />other people can find you on: <br><h3>http://'.$_REQUEST['hostname'].':'.$wan_port.'</h3>';
  if ($dyndns=="yes")
  {
    if ($wan_port==80) echo '<h3>http://'.$domain.'</h3>';
    else echo '<h3>http://'.$domain.':'.$wan_port.'</h3>';
  }
 }
 if ($_REQUEST['lan']) $lan_hostname=$_REQUEST['hostname'];
 else
     {
     if ($wan_hostname==$_REQUEST['hostname']) $dynamic="no";
     else $dynamic="yes";
     $wan_hostname=$_REQUEST['hostname'];
     }

	$myFile = "../data/hostnames.php";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$stringData = "<?php\n";
	fwrite($fh, $stringData);
	$stringData = "\$lan_hostname='$lan_hostname';\n";
	fwrite($fh, $stringData);
	$stringData = "\$wan_hostname='$wan_hostname';\n";
	fwrite($fh, $stringData);
	$stringData = "\$dynamic='$dynamic';\n";
	fwrite($fh, $stringData);
	$stringData = "\$wan_port='$wan_port';\n";
	fwrite($fh, $stringData);
	$stringData = "\$dyndns='$dyndns';\n";
	fwrite($fh, $stringData);
	$stringData = "\$username='$username';\n";
	fwrite($fh, $stringData);
	$stringData = "\$password='$password';\n";
	fwrite($fh, $stringData);
	$stringData = "\$domain='$domain';\n";
	fwrite($fh, $stringData);
	$stringData = "?>";
	fwrite($fh, $stringData);
	fclose($fh);
	}
?>
