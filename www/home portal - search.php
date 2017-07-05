<?php
if ($_SERVER['REMOTE_ADDR']=="127.0.0.1")
{
	$isadmin=1;
	Require "data/search.php";
	Require "data/db_config.php";
	Require "data/preferences.php";
	Require "data/unread_bulls.php";

  $mysqlconnection=mysql_connect($db_host,$db_user,$db_password);
  if (mysql_select_db($db_name,$mysqlconnection) && $mysqlconnection)
  {
    $query="select * from language where lang='$language' order by id asc";
    $lanres= mysql_query($query,$mysqlconnection);
  }

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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Portal - search</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script type="text/javascript">

function Search()
{
	search=document.getElementById('search').value;
	window.open("http://www.newgrounds.com/portal/search/title/"+search);
}
</script>

<style type="text/css">
<!--
body {
	background-color: <?php echo $bg_color; ?>;
	background-attachment: fixed;
	background-position: 50% 0%;
	background-image: url(backgrounds/<?php echo $bg_image ?>);
	background-repeat: repeat-y;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size:14px;
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
.ds {
 display: -moz-inline-box;
 }
.ds {
 border-bottom: 1px solid #E7E7E7;
 border-right: 1px solid #E7E7E7;
 display: inline-block;
 margin: 3px 0 4px 4px;
}
.lsbb
{
  background: none repeat scroll 0 0 #EEEEEE;
  border-color: #CCCCCC #999999 #999999 #CCCCCC;
  border-style: solid;
  border-width: 1px;
  display: block;
  height: 30px;
}
.lsb
{
  background: url(img/nav_logo14.png) repeat scroll center bottom transparent;
  border: medium none;
  color: #000000;
  cursor: pointer;
  font: 15px arial,sans-serif;
  height: 30px;
  margin: 0;
  outline: 0 none;
  vertical-align: top;
}
.lsb:active
{
  background: none repeat scroll 0 0 #CCCCCC;
}
#bulletins {
    left:195px;
	position: absolute;
	width:860px;
	margin-right:5px;
}                     
#menu {
	position: absolute;
	background-color: <?php echo $panel_color; ?>;
	opacity: <?php echo $panel_opacity; ?>;
	margin-left:5px;
}
#bulletins iframe {
	border: 3px solid #000;
}
#MenuBar1 a {
	color: #099;
	background-image: url(img/menu.png);
	font-size:15.5px;
}
-->
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
function search($link,$image,$formcode,$allow)
{
if ($allow=="1") echo '<table width="600" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td><a href="'.$link.'"  ><img style="border-style: none;" height="200" src="img/search/'.$image.'"></a></td></tr><tr><td><span style="padding-left:80px;">'.$formcode.'</span><br><hr></td></tr></tbody></table>';
}
$fgoogle='<form   action="http://www.google.gr/search" name="f" id="f"><table border="0" cellpadding="0" cellspacing="0"><tr><td width="25%">&nbsp;</td><td nowrap="nowrap"><input name="hl" value="el" type="hidden" /><input name="source" value="hp" type="hidden" /><div class="ds" style="height: 32px; margin: 4px 0pt;"><div style="position: relative;"><input style="background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;" id="sf" maxlength="2048" name="q" size="40" class="lst"/></div></div><span class="ds"><span class="lsbb"><input class="lsb" value="Αναζήτηση" name="btnG" type="submit"/></span></span><br /><span style="font-family: arial,sans-serif; font-size: 13px">Αναζήτηση:<input id="all" name="meta" value="" checked="checked" type="radio" /><label for="all"> παγκόσμιος ιστός </label><input id="lgr" name="meta" value="lr=lang_el" type="radio" /><label for="lgr"> σελίδες στα Ελληνικά </label><input id="cty" name="meta" value="cr=countryGR" type="radio" /><label for="cty"> σελίδες από Ελλάδα </label></span><font size="-2">&nbsp;<a href="http://www.google.gr/advanced_search?hl=el">Σύνθετη Αναζήτηση</a></font><br /></td><td width="25%">&nbsp;</td></tr></table></form>';

$fyahoo='<form   action="http://www.yahoo.com/_ylt=AgX5rsPgM397e2ukoflq_PabvZx4/SIG=11i8g9dkr/EXP=1288004826/*-http%3A//search.yahoo.com/search" class="" method="get" name="sf1"><input type="hidden" name="toggle" value="1"><input type="hidden" name="cop" value="mss"><input type="hidden" name="ei" value="UTF-8"><input type="hidden" name="fr" value="yfp-t-950"><table cellspacing="0" cellpadding="0"><tbody><tr valign="top"><td width="25%">&nbsp;</td><td nowrap="" align="center"><div style="height: 32px; margin: 4px 0pt;" class="ds"><div style="position: relative;"><input style="background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;" name="p" type="text" class="" title="Web Search" size="40" maxlength="2048" autocomplete="off"></div></div><span class="ds"><span class="lsbb"><input type="submit" class="lsb" value="Αναζητηση"></span></span></td><td width="25%" nowrap="" align="left" class="sblc">&nbsp;</td></tr></tbody></table></form>';

$fyoutube='<form    action=\"http://www.youtube.com/results\"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"search_query\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$fmetacafe='<form    action=\"http://www.metacafe.com/topics//\"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"searchText\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$fyahoo_video='<form    action=\"http://video.yahoo.com/search/\"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"p\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$fmegavideo='<form    action="http://www.megavideo.com"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">\&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"s\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"><input name=\"c\" type=\"hidden\" value=\"search\" /></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$fthe_pirate_bay='<form    method=\"get\" action=\"http://thepiratebay.org/s/\" ><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">\&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"q\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"><input type=\"hidden\" value=\"0\" name=\"page\"><input type=\"hidden\" value=\"7\" name=\"orderby\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$fisohunt='<form    action=\"http://isohunt.com/torrents\"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">\&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"ihq\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$fdemonoid='<form    action=\"http://www.demonoid.com/files"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"query\" maxlength=\"2048\" autocomplete=\"off\" id="search\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$frapidshare='';
$fmegaupload='';
$fnewgrounds='<form action=\"#\" onsubmit=\"Search();\" ><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">\&nbsp;</td><td nowrap=\"\" align=\"center\"><div class=\"ds\" style=\"height: 32px; margin: 4px 0pt;\"><div style=\"position: relative;\"><input id=\"search\" autocomplete=\"off\" maxlength=\"2048\" class=\"lst tiah\" value=\"\" size=\"40\" style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" value=\"Αναζητηση\" class=\"lsb\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$fminiclip='<form   method=\"get\" action=\"http://www.miniclip.com/games/en/search.php\"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">\&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"query\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$fanimefreak='<form   method=\"post\" accept-charset=\"UTF-8\" action=\"http://www.animefreak.tv/search/node\"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">\&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"keys\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"><input type=\"hidden\" value=\"form-c31072af18a43caba25d1702cb655df9\" id=\"form-c31072af18a43caba25d1702cb655df9\" name=\"form_build_id\"><input type=\"hidden\" value=\"search_form\" id=\"edit-search-form\" name=\"form_id\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" name=\"op\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
$fkumby='<form   method=\"get\" action=\"http://www.kumby.com/\"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">\&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"s\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr</tbody></table></form>';
$fmangareader='<form   method=\"get\" action=\"http://www.mangareader.net/index.php\"><table cellspacing=\"0\" cellpadding=\"0\"><tbody><tr valign=\"top\"><td width=\"25%\">\&nbsp;</td><td nowrap=\"\" align=\"center\"><div style=\"height: 32px; margin: 4px 0pt;\" class=\"ds\"><div style=\"position: relative;\"><input style=\"background: none repeat scroll 0% 0% rgb(255, 255, 255); border-width: 1px; border-style: solid; border-color: rgb(204, 204, 204) rgb(153, 153, 153) rgb(153, 153, 153) rgb(204, 204, 204); color: rgb(0, 0, 0); font: 18px arial,sans-serif bold; height: 25px; margin: 0pt; padding: 5px 38px 0pt 6px; vertical-align: top;\" size=\"40\" value=\"\"    class=\"lst tiah\" name=\"w\" maxlength=\"2048\" autocomplete=\"off\" id=\"search\"><input name=\"q\" type=\"hidden\" value=\"search\" /></div></div><span class=\"ds\"><span class=\"lsbb\"><input type=\"submit\" class=\"lsb\" value=\"Αναζητηση\"></span></span></td><td width=\"25%\" nowrap=\"\" align=\"left\" class=\"sblc\">\&nbsp;</td></tr></tbody></table></form>';
?>


<div id="main">
<div id=menu>
 <ul id="MenuBar2" class="MenuBarVertical">
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

  <div id="bulletins">
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <?php
  if ($web=="1")  {
	  echo '<li onClick=view(\'web\')><a href="#">'.mysql_result($lanres,40,"text").'</a></li>';
	  if (!isset($firstin)) $firstin='web';
  }
  if ($videos=="1")  {
	  echo '<li onClick=view(\'videos\')><a href="#">'.mysql_result($lanres,41,"text").'</a></li>';
	  if (!isset($firstin)) $firstin='videos';
  }
  if ($torrents=="1") {
	  echo '<li onClick=view(\'torrents\')><a href="#">'.mysql_result($lanres,43,"text").'</a></li>';
	  if (!isset($firstin)) $firstin='torrents';
  }
  if ($files=="1")  {
	  echo '<li onClick=view(\'files\')><a href="#">'.mysql_result($lanres,38,"text").'</a></li>';
	  if (!isset($firstin)) $firstin='files';
  }
  if ($games=="1")   {
	  echo '<li onClick=view(\'games\')><a href="#">'.mysql_result($lanres,39,"text").'</a></li>';
	  if (!isset($firstin)) $firstin='games';
  }
  if ($anime=="1")  {
	  echo '<li onClick=view(\'anime\')><a href="#">'.mysql_result($lanres,42,"text").'</a></li>';
	  if (!isset($firstin)) $firstin='anime';
  }
  ?>
  </ul>
<span id="preview" ></span></div>
</div>

<script type="text/javascript">
function view(type)
{
  head='<div style=\"width: 840px; top: 36px; position: absolute; background-color: #FFF; padding: 10px;\" ><br />';
  tail='</div>';
  if (type=="web")
     document.getElementById('preview').innerHTML=head+'<?php search('http://www.google.com','google.jpg',$fgoogle,$google); search('http://www.yahoo.com','yahoo.png',$fyahoo,$yahoo); ?>'+tail;

  else if (type=="videos")
     document.getElementById('preview').innerHTML=head+'<?php search('http://www.youtube.com','youtube.jpg',$fyoutube,$youtube); search('http://www.metacafe.com','metacafe.png',$fmetacafe,$metacafe);  search('http://video.yahoo.com','yahoo_video.png',$fyahoo_video,$yahoo);  search('http://www.megavideo.com','megavideo.gif',$fmegavideo,$megavideo); ?>'+tail;

  else if (type=="torrents")
     document.getElementById('preview').innerHTML=head+'<?php search('http://thepiratebay.org','the_pirate_bay.jpg',$fthe_pirate_bay,$piratebay); search('http://isohunt.com','isohunt.png',$fisohunt,$isohunt); search('http://www.demonoid.com','demonoid.jpg',$fdemonoid,$demonoid); ?>'+tail;

  else if (type=="files")
     document.getElementById('preview').innerHTML=head+'<?php search('http://www.rapidshare.com','rapidshare.png',$frapidshare,$rapidshare); search('http://www.megaupload.com','megaupload.gif',$fmegaupload,$megaupload); ?>'+tail;

  else if (type=="games")
     document.getElementById('preview').innerHTML=head+'<?php search('http://www.newgrounds.com','newgrounds.png',$fnewgrounds,$newgrounds); search('http://www.miniclip.com','miniclip.png',$fminiclip,$miniclip); ?>'+tail;

  else if (type=="anime")
     document.getElementById('preview').innerHTML=head+'<?php search('http://www.animefreak.tv','animefreak.png',$fanimefreak,$animefreak); search('http://www.kumby.com','kumby.gif',$fkumby,$kumby); search('http://www.mangareader.net','mangareader.png',$fmangareader,$mangareader); ?>'+tail;
}
view("<?php echo $firstin?>");
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
<?php mysql_close($mysqlconnection); ?>
</html>