<?php
Require "../data/search.php";
Require "../data/preferences.php";

if ($_SERVER['REMOTE_ADDR']=="127.0.0.1") $isadmin=1;
else $isadmin=0;


function write($var)
{
  if ($_REQUEST[$var]) $stringData = "$".$var."='1';\n";
  else $stringData = "$".$var."='0';\n";
  return $stringData;
}

if  ($isadmin==1)
{
$myFile = "../data/search.php";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "<?php\n";
fwrite($fh, $stringData);
fwrite($fh, write("web"));
fwrite($fh, write("google"));
fwrite($fh, write("yahoo"));
fwrite($fh, write("videos"));
fwrite($fh, write("youtube"));
fwrite($fh, write("metacafe"));
fwrite($fh, write("yahoovid"));
fwrite($fh, write("megavideo"));
fwrite($fh, write("torrents"));
fwrite($fh, write("piratebay"));
fwrite($fh, write("isohunt"));
fwrite($fh, write("demonoid"));
fwrite($fh, write("files"));
fwrite($fh, write("rapidshare"));
fwrite($fh, write("megaupload"));
fwrite($fh, write("games"));
fwrite($fh, write("newgrounds"));
fwrite($fh, write("miniclip"));
fwrite($fh, write("anime"));
fwrite($fh, write("animefreak"));
fwrite($fh, write("kumby"));
fwrite($fh, write("mangareader"));
$stringData = "?>";
fwrite($fh, $stringData);
fclose($fh);
}
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<meta http-equiv=\"REFRESH\" content=\"0; url=../home portal - preferences.php\"></HEAD>";
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