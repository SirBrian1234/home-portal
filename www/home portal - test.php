<?php
Require "data/db_config.php";
Require "data/preferences.php";
Require "data/unread_bulls.php";
Require "data/hostnames.php";

if ($_SERVER['REMOTE_ADDR']=="127.0.0.1") $isadmin=1;
else $isadmin=0;

$mysqlconnection=mysql_connect($db_host,$db_user,$db_password);
if (mysql_select_db($db_name,$mysqlconnection) && $mysqlconnection)
{
  $query="select * from language where lang='$language' order by id asc";
  $lanres= mysql_query($query,$mysqlconnection);
  
  $query="select * from langtext where lang='$language' order by id asc";
  $lanrest= mysql_query($query,$mysqlconnection);
}
   
if ($_REQUEST['request']==1)
{
 $request=1;
 $host=$_REQUEST['host'];
 $port=$_REQUEST['port'];
}
if ($_REQUEST['net'] && $_REQUEST['friendurl'])
{
 $net=$_REQUEST['net'];
 $url=$_REQUEST['friendurl'];
 if ($net=="LAN")
 echo"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
      <html>
      <head>
      <meta http-equiv=\"REFRESH\" content=\"0; url=".$url."/home portal - test.php?request=1&host=".$lan_hostname."&port=80 \"></HEAD>";
 else if ($net=="WAN")
 echo"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
      <html>
      <head>
      <meta http-equiv=\"REFRESH\" content=\"0; url=".$url."/home portal - test.php?request=1&host=".$wan_hostname."&port=".$wan_port." \"></HEAD>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>home portal - test friend page</title>

<style type="text/css">
<!--
body {
	background-color: <?php echo $bg_color; ?>;
	background-attachment: fixed;
	background-position: 50% 0%;
	background-image: url(backgrounds/<?php echo $bg_image ?>);
	background-repeat: repeat-y;
	color: <?php echo $text_color; ?>;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 14px;
}
#main {
	position:absolute;
	width:95%;
	min-width:1140px;
	max-width:1500px;
	margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
	top:58px;
}
#menu {
	position: absolute;
	background-color: <?php echo $panel_color; ?>;
	opacity: <?php echo $panel_opacity; ?>;
	margin-left:5px;
}
#bulletins {
	background-color: <?php echo $panel_color; ?>;
	opacity: <?php echo $panel_opacity; ?>;
	width:725px;
    left:195px;
	border: 1px solid #000;
	position: absolute;
	margin-right:5px;
	padding:10px;
}
.notice {
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #000;
	font-family: Georgia, "Times New Roman", Times, serif;
}
.details {
	font-family: Arial, Helvetica, sans-serif;
	font-style: italic;
	color: #666;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
</head>


<body>
<div id="main">
  <div id="menu">
 <ul id="MenuBar1" class="MenuBarVertical">
    <li><a href="index.php"><?php echo mysql_result($lanres,3,"text"); ?><?php if ($unread_bulls!=0) echo ' //'.$unread_bulls.'//'; ?></a></li>
    <li><a href="index.php?chat=1"><?php echo mysql_result($lanres,29,"text"); ?></a></li>
    <?php
	if ($isadmin==1)
	echo "<li><a href=\"home portal - search.php\">".mysql_result($lanres,4,"text")."</a></li>";
    ?>
	<?php
		if ($isadmin==1)
			echo "<li><a href=\"home portal - preferences.php\">".mysql_result($lanres,30,"text")."</a></li>";
	?>
</ul>
  </div>
  <div id="bulletins" >
    <?php if (!$request && $isadmin==1) 
   			echo '<table width="725" cellpadding="0" cellspacing="0">
					 <tr>
					   <td width="9">&nbsp;</td>
					   <td width="691"><p>'.mysql_result($lanres,87,"text").' - '.$_REQUEST['net'].'</p>
						 <hr />
						 '.mysql_result($lanrest,0,"text").'
						 <p>'.mysql_result($lanres,90,"text").'</p>
						 <form id="form1" name="form1" method="post" action="home portal - test.php?net='.$_REQUEST['net'].'">
						   <label>
							 '.mysql_result($lanres,88,"text").'&nbsp;&nbsp;&nbsp;&nbsp;</label>
						   <label>
							   <input name="friendurl" type="text" id="friendpage" size="60" />&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type="submit" name="button" id="button" value="'.mysql_result($lanres,89,"text").'" />
						   </label>
						 </form>
						 <p>&nbsp;</p></td><td width="9">&nbsp;</td>
					 </tr>
				   </table>';
         else if ($request)
         {
           echo '<table width="725" cellpadding="0" cellspacing="0">
		   <tr>
		   <td width="9">&nbsp;</td>
           <td width="691"><p><br />';
           error_reporting(0);
           echo 'making tests on: <strong>'.$host.':'.$port.'</strong> ...<br /><br />';
           $fp = fsockopen($host,$port,$errno,$errstr,10);
           if(!$fp)
           {
           echo 'Αδυνατη η συνδεση στη σελιδα σας.<br>Σε περιπτωση που προσπαθειτε να κανετε τη σελιδα λειτουργει στο internet θα πρεπει να επιτρεψετε στο router σας μια θυρα για χρηση. Δειτε περισσοτερα <a href="http://127.0.0.1/home portal - wan help.php">εδω</a>.<br>Σε περιπτωση οπου προσπαθειτε να συνδεθειτε με ενα υπολογιστη στο τοπικο δικτυο LAN στραφειτε προς το firewall του υπολογιστη.';
           }
           else
           {
           echo "Socket open was successful<br />Streaming Data: ";
           fclose($fp);
           $arg1="tcp://".$host.":".$port;
           $fp = stream_socket_client($arg1, $errno, $errstr, 30);
           if (!$fp) {
           echo "$errstr ($errno)<br />\n";
           } else {
           fwrite($fp, "GET /system/stream_test.php HTTP/1.0\r\nHost: ".$host." \r\nAccept: */*\r\n\r\n");
           while (!feof($fp)) {
           echo fgets($fp, 1024);
           }
           fclose($fp);
           }
           }
           echo '<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="font-size:20px" href="http://127.0.0.1/home portal - preferences.php" >Πισω</a><br /><br /><br /></p></td><td width="9">&nbsp;</td>
           </tr>
           </table>';
         }
		 else echo '<table width="725" cellpadding="0" cellspacing="0">
		   <tr>
		   <td width="9">&nbsp;</td>
           <td width="691"><br /><h3>ksouksou!!!!!</h3><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="font-size:20px" href="http://127.0.0.1/home portal - preferences.php" >Πισω</a><br /><br /><br /></p></td><td width="9">&nbsp;</td>
					 </tr>
				   </table>';
		 ?>
  </div>
</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>