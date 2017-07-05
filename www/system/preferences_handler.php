<?php
Require "../data/preferences.php";
Require "../data/hostnames.php";

if ($_SERVER['REMOTE_ADDR']=="127.0.0.1") $isadmin=1;
else $isadmin=0;

$refresh = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="REFRESH" content="0;url=../home portal - preferences.php"></HEAD>';

function write($arg1,$arg2)
{
  if ($_REQUEST["$arg1"]) $stringData = "\$$arg1='".$_REQUEST["$arg1"]."';\n";
  else $stringData = "\$$arg1='$arg2';\n";
  return $stringData;
}

if  ($isadmin==1)
{
$myFile = "../data/preferences.php";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "<?php\n";
fwrite($fh, $stringData);
fwrite($fh,write('admin_name',$admin_name));
fwrite($fh,write('pm',$pm));
fwrite($fh,write('language',$language));
fwrite($fh,write('max_bulls',$max_bulls));
fwrite($fh,write('tusername',$tusername));
if ($_REQUEST["tpassword"])
{
  $stringData = '$tpassword=\''.md5($_REQUEST["tpassword"])."';\n";
}
else $stringData = "\$tpassword='$tpassword';\n";
fwrite($fh,$stringData);
if ($_REQUEST["update"]=='yes') {
	//if update was disabled activate!!!
	if ($update=='no') {
		fwrite ($fh,'$update=\'yes\';'."\n");
		//start update init
		$stringData = 'echo "C:\Home Portal\tracker_update\homep_upd" > "C:\Home Portal\tracker_update\init.bat"';
	    exec($stringData);
    	//exec update
	    $stringData = 'echo 8 > "C:\Home Portal\core\notice.txt"';
	    exec($stringData);
	}
	else fwrite ($fh,'$update=\'yes\';'."\n");
}
else {
	//if update was enabled kill :(
	if ($update=='yes') {    
		fwrite ($fh,'$update=\'no\';'."\n");
		//stop update init
		$stringData = 'echo ::"C:\Home Portal\tracker_update\homep_upd" > "C:\Home Portal\tracker_update\init.bat"';
		exec($stringData);
		//kill update
		$stringData = 'taskkill /F /IM "homep_upd.exe"';
		exec($stringData);	
	}
	else fwrite ($fh,'$update=\'no\';'."\n");
}
	
if ($_REQUEST["chat_nickselect"]=='no')
	fwrite ($fh,'$chat_nickselect=\'no\';'."\n");
else
	fwrite ($fh,'$chat_nickselect=\'yes\';'."\n");
fwrite($fh,write('bg_color',$bg_color));
fwrite($fh,write('text_color',$text_color));
fwrite($fh,write('bg_image',$bg_image));
fwrite($fh,write('chat_theme',$chat_theme));
fwrite($fh,write('panel_color',$panel_color));
fwrite($fh,write('panel_opacity',$panel_opacity));
fwrite($fh,write('per_color',$per_color));
fwrite($fh,write('per_size',$per_size));
fwrite($fh,write('per_font',$per_font));
fwrite($fh,write('p_color',$p_color));
fwrite($fh,write('p_size',$p_size));
fwrite($fh,write('p_font',$p_font));
$stringData = "?>";
fwrite($fh, $stringData);
fclose($fh);

if ($_REQUEST["update"]=='yes')
if ($_REQUEST["admin_name"] != $admin_name || $_REQUEST["tusername"] != $tusername || md5($_REQUEST["tpassword"]) != $tpassword)
//oooh smt is changed we must inform
{	
	$admin_name=$_REQUEST["admin_name"];
	$tusername=$_REQUEST["tusername"];
	$tpassword=md5($_REQUEST["tpassword"]);
	
	if ($dyndns=="yes")
    {
 		//update tracker once
		if ($wan_port==80) {
			$stringData = '"C:\Home Portal\tracker_update\HTTPClient" "/H:http://homeportal.php0h.com/hostname3.php?user='.$admin_name.'&usr='.$tusername.'&pwd='.$tpassword.'&domain='.$domain.'"';
			exec($stringData);
		}
		else {
			$stringData = '"C:\Home Portal\tracker_update\HTTPClient" "/H:http://homeportal.php0h.com/hostname3.php?user='.$admin_name.'&usr='.$tusername.'&pwd='.$tpassword.'&domain='.$domain.'&port='.$wan_port.'"';
		  	exec($stringData);
		}
    }
    else
    {
    	if ($wan_port==80) $details= '?user='.$admin_name.'&usr='.$tusername.'&pwd='.$tpassword;
    	else $details= '?user='.$admin_name.'&port='.$wan_port.'&usr='.$tusername.'&pwd='.$tpassword;
		$stringData = 'echo "C:\Home Portal\tracker_update\HTTPClient" "/H:http://homeportal.php0h.com/hostname3.php'.$details.'"  >  "C:\Home Portal\tracker_update\upd_settings.bat"';
		exec($stringData);
	}
}
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
</style>