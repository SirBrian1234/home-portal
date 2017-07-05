<?php
Require "../data/preferences.php";
Require "../data/db_config.php";

if ($_SERVER['REMOTE_ADDR']=="127.0.0.1") $isadmin=1;
else $isadmin=0;

$refresh="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<meta http-equiv=\"REFRESH\" content=\"0; url=/index.php \"></HEAD>";

if ($isadmin==1)
{
if ($_REQUEST['t']=='pg') $table='pages';
else if ($_REQUEST['t']=='fr') $table='friends';
else if ($_REQUEST['t']=='nt') $table='noticeboard';
else if ($_REQUEST['t']=='ms') $table='music';
else if ($_REQUEST['t']=='vd') $table='videos';
else $table='null';

$reqid=$_REQUEST['id'];
$mysqlconnection=mysql_connect($db_host,$db_user,$db_password);
mysql_select_db($db_name,$mysqlconnection);
$query="delete from $table where id='$reqid'";
mysql_query($query,$mysqlconnection);
mysql_close($mysqlconnection);
}
echo $refresh;
?>

<style type="text/css">
<!--
body {
	background-color: <?php echo $bg_color; ?>;
	background-attachment: fixed;
	background-position: 50% 0%;
	background-image: url(../backgrounds/<?php echo $bg_image ?>);
	background-repeat: repeat-y;
	color: <?php echo $text_color; ?>;
}
-->

