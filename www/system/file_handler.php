<?php
Require "../data/preferences.php";
Require "../data/file_prefs.php";


if ($_SERVER['REMOTE_ADDR']=="127.0.0.1") $isadmin=1;
else $isadmin=0;

$refresh = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="REFRESH" content="0;url=../'.$_REQUEST["src"].' "></HEAD>';

function write($arg1,$arg2)
{
  if ($_REQUEST["$arg1"]) $stringData = "\$$arg1='".$_REQUEST["$arg1"]."';\n";
  else $stringData = "\$$arg1='$arg2';\n";
  return $stringData;
}

function ewrite($arg1,$arg2)
{
  if ($_REQUEST["$arg1"]) $stringData = "\$$arg1='".$_REQUEST["$arg1"]."';\n";
  else $stringData = "\$$arg1='';\n";
  return $stringData;
}

if  ($isadmin==1)
{
$myFile = "../data/file_prefs.php";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "<?php\n";
fwrite($fh, $stringData);

fwrite($fh,write('file_enable',$enable));
fwrite($fh,write('file_password_enable',$password_enable));
fwrite($fh,write('file_max_size',$file_max_size));

if ($_REQUEST["file_password"])
{
  $file_password=md5($_REQUEST["file_password"]);
  $stringData = "\$file_password='$file_password';\n";
}
else $stringData = "\$file_password='$file_password';\n";
fwrite($fh,$stringData);

fwrite($fh,ewrite('rar',$rar));
fwrite($fh,ewrite('zip',$zip));
fwrite($fh,ewrite('jpg',$jpg));
fwrite($fh,ewrite('mp3',$mp3));
fwrite($fh,ewrite('txt',$txt));
fwrite($fh,ewrite('torrent',$torrent));

$stringData = "?>";
fwrite($fh, $stringData);
fclose($fh);
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