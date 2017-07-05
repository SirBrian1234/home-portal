<?php
if ($_SERVER['REMOTE_ADDR']=="127.0.0.1")
{
   $isadmin=1;
   Require "data/preferences.php";
   Require "data/search.php";
   Require "data/hostnames.php";
   Require "data/file_prefs.php";
   Require "data/db_config.php";
   
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

if ($isadmin==1 && $_REQUEST['wanport'])
{
	$wan_port=$_REQUEST['wanport'];
	$myFile = "data/hostnames.php";
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
	
	if ($update=="yes")
	{
		if ($dyndns=="yes")
    	{
    		if ($wan_port==80)$details= '?user='.$admin_name.'&domain='.$domain.'&usr='.$tusername.'&pwd='.$tpassword;
        	else $details= '?user='.$admin_name.'&domain='.$domain.'&port='.$wan_port.'&usr='.$tusername.'&pwd='.$tpassword;
    	}
    	else
    	{
    		if ($wan_port==80) $details= '?user='.$admin_name.'&usr='.$tusername.'&pwd='.$tpassword;
    		else $details= '?user='.$admin_name.'&port='.$wan_port.'&usr='.$tusername.'&pwd='.$tpassword;
    	}
	}
	$stringData = 'echo "C:\Home Portal\tracker_update\HTTPClient" "/H:http://homeportal.php0h.com/hostname3.php'.$details.'"  >  "C:\Home Portal\tracker_update\upd_settings.bat"';
	exec($stringData);
	
	echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
	<html>
	<head>
	<meta http-equiv=\"REFRESH\" content=\"0; url=home portal - preferences.php \"></HEAD>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Portal - preferences</title>

<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script type="text/javascript">


prefs='<form id="form1" name="form1" method="post" action="system/preferences_handler.php?src=home portal - preferences.php">       <p><?php echo mysql_result($lanres,44,"text"); ?></p><hr/>          <p>            <label><?php echo mysql_result($lanres,50,"text"); ?>            <input name="admin_name" type="text" id="admin_name" value="<?php echo $admin_name; ?>" />            </label>          </p>          <p>            <label><?php echo mysql_result($lanres,51,"text"); ?>              <input name="pm" type="text" id="pm" value="<?php echo $pm; ?>" size="80" />            </label>          </p>      <p>            <label><?php echo mysql_result($lanres,52,"text"); ?><select name="language" id="language">          <?php if ($language=='en')  echo '<option value="en">english</option><option value="gr">ελληνικά</option>';  else if  ($language=='gr')  echo '<option value="gr">ελληνικά</option><option value="en">english</option>';   ?>   </select></label></p>    <p>            <label><?php echo mysql_result($lanres,53,"text"); ?> <input name="max_bulls" type="text" id="max_bulls" value="<?php echo $max_bulls; ?>" size="5" /> <?php echo mysql_result($lanres,54,"text"); ?></label>          </p>          <p> <label><?php echo mysql_result($lanres,55,"text"); ?><input name="update" type="checkbox" value="yes" <?php check2($update); ?> /></label></p>             <label><?php echo mysql_result($lanres,56,"text"); ?><input type="text" name="tusername" id="textfield" /></label><label><?php echo mysql_result($lanres,57,"text"); ?><input type="password" name="tpassword" id="textfield3" /></label>                <p style="font-size:9px"><?php echo mysql_result($lanres,58,"text"); ?></p>          <p><label><?php echo mysql_result($lanres,86,"text"); ?><input name="chat_nickselect" type="checkbox" value="no" <?php check3($chat_nickselect); ?> /> </label></p>  <p><label>  <input type="submit" name="button" id="button" value="<?php echo mysql_result($lanres,59,"text"); ?>" /></label></p>        </form>';

conn='<p><?php echo mysql_result($lanres,60,"text"); ?> - <?php echo mysql_result($lanres,61,"text"); ?> </p><hr/>    <div style="position:absolute; width450px;left:10px">      <?php if ($isadmin==1)			 {			 if ($update=="yes")               {					echo '<iframe width="400" ';			 		if ($dyndns=="yes") echo 'height="150"'; 			 		else echo 'height="108" '; 			 		echo 'frameborder="no" src="http://homeportal.php0h.com/hostname4.php';					if ($dyndns=="yes")                     {                     if ($wan_port==80)echo '&lang='.$language.'&user='.$admin_name.'&domain='.$domain.'&usr='.$tusername.'&pwd='.$tpassword;                     else echo '&lang='.$language.'&user='.$admin_name.'&domain='.$domain.'&port='.$wan_port.'&usr='.$tusername.'&pwd='.$tpassword;                     }                 else                     {                     if ($wan_port==80) echo '?user='.$admin_name.'&usr='.$tusername.'&pwd='.$tpassword;                     else echo '?user='.$admin_name.'&port='.$wan_port.'&usr='.$tusername.'&pwd='.$tpassword;                     }               		 echo '" ></iframe>';			   }         	   else 			   {			   		echo '<p>'.mysql_result($lanres,91,"text").'</p>';			   }			  }		 ?>    </div>    <div style="width:232px;position:absolute;right:60px">      <form id="form4" name="form3" method="post" action="home portal - preferences.php">        <label><?php echo mysql_result($lanres,65,"text"); ?>        <input name="wanport" type="text" id="textfield7" size="7" value="<?php echo $wan_port; ?>"/>        </label>        <label>          <input type="submit" name="button3" id="button3" value="<?php echo mysql_result($lanres,66,"text"); ?>" onclick="open_win()" />        </label>      </form>      <br />      </div>    <p>&nbsp;</p>    <p>&nbsp;</p>    <p>&nbsp;</p>    <p>&nbsp;</p>    <p>&nbsp;</p>    <p><a href="home portal - test.php?net=WAN"><?php echo mysql_result($lanres,63,"text"); ?></a><br /><br />    </p>        <p><?php echo mysql_result($lanres,60,"text"); ?> - <?php echo mysql_result($lanres,62,"text"); ?></p><hr>        <?php if ($isadmin==1) echo '<iframe width="700" height="108" frameborder="no" src="http://127.0.0.1:800/system/hostname.php"> </iframe>'; ?>        <p><a href="home portal - test.php?net=LAN"><?php echo mysql_result($lanres,64,"text"); ?></a></p>        <br /></div>';

files='<form id="form3" name="form3" method="post"  action="system/file_handler.php?src=home portal - preferences.php">          <p><?php echo mysql_result($lanres,67,"text"); ?></p>          <p><hr/>            <label><?php echo mysql_result($lanres,68,"text"); ?><input name="file_enable" type="checkbox" id="checkbox22" <?php if ($file_enable=='on') echo 'checked="checked"';?>" />            </label>          </p>          <p><?php echo mysql_result($lanres,69,"text"); ?><label> <br />              .zip              <input type="checkbox" name="zip" id="checkbox23" <?php if ($zip=='on') echo 'checked="checked"';?>/>              .rar</label>            <label>              <input type="checkbox" name="rar" id="checkbox24" <?php if ($rar=='on') echo 'checked="checked"';?>/>            </label>            <label>.txt</label>            <label>              <input type="checkbox" name="txt" id="checkbox26" <?php if ($txt=='on') echo 'checked="checked"';?>/>            </label>            <label>.mp3</label>            <label>              <input type="checkbox" name="mp3" id="checkbox26" <?php if ($mp3=='on') echo 'checked="checked"';?>/>            </label>            <label>.jpg</label>            <label>              <input type="checkbox" name="jpg" id="checkbox26" <?php if ($jpg=='on') echo 'checked="checked"';?>/>            </label>            <label>.torrent</label>            <label>              <input type="checkbox" name="torrent" id="checkbox26" <?php if ($torrent=='on') echo 'checked="checked"';?>/>            </label>          </p>          <p><?php echo mysql_result($lanres,70,"text"); ?><label>              <input type="checkbox" name="file_password_enable" id="checkbox26" <?php if ($file_password_enable=='on') echo 'checked="checked"';?>/>            </label>            <label><?php echo mysql_result($lanres,71,"text"); ?><input type="password" name="file_password" id="file_password" />            </label>          </p>          <p><?php echo mysql_result($lanres,71,"text"); ?><label>              <input name="file_max_size" type="text" id="textfield4" size="10" value="<?php echo $file_max_size ?>"/>            </label>            MB </p>          <p>            <input type="submit" name="button4" id="button4" value="<?php echo mysql_result($lanres,59,"text"); ?>" />          </p>        </form>';

appear='<form id="form1" name="form1" method="post" action="system/preferences_handler.php?src=home portal - preferences.php">         <p><?php echo mysql_result($lanres,73,"text"); ?></p><hr/>          <p>            <label><?php echo mysql_result($lanres,74,"text"); ?><input class="colorbutton" type="button" value=" " onclick="popupcolor(\'bg_color\')"/>            </label>            <label>              <input name="bg_color" type="text" id="bg_color" size="7" maxlength="7" value="<?php echo $bg_color; ?>" />            </label>          </p>          <p>            <label><?php echo mysql_result($lanres,75,"text"); ?><input type="text" name="bg_image" id="bg_image" value="<?php echo $bg_image; ?>"/>            </label>            <label>              <input type="button" class="folderbutton" onclick="open_folder(1)"/>            </label>          </p>          <p>            <label><?php echo mysql_result($lanres,76,"text"); ?><input class="colorbutton" type="button" value=" " onclick="popupcolor(\'panel_color\')"/>            </label>            <input name="panel_color" type="text" id="panel_color" size="7" maxlength="7" value="<?php echo $panel_color; ?>" />          </p>          <p><?php echo mysql_result($lanres,77,"text"); ?><input class="colorbutton" type="button" value=" " onclick="popupcolor(\'text_color\')"/>            <input name="text_color" type="text" id="text_color" size="7" maxlength="7" value="<?php echo $text_color; ?>" />          </p>          <p>            <label><?php echo mysql_result($lanres,78,"text"); ?></label>            <select name="chat_theme" id="select" >              <option value="<?php echo $chat_theme; ?>"><?php echo $chat_theme; ?></option>              <option value="">default</option>              <option value="aeon">aeon</option>              <option value="bluetan">bluetan</option>              <option value="brownie">brownie</option>              <option value="butterfly">butterfly</option>              <option value="darkstyle">darkstyle</option>              <option value="moxy">moxy</option>              <option value="schlumpfi">schlumpfi</option>              <option value="virtualife">virtualife</option>              <option value="yahoo">yahoo</option>            </select>          </p>          <p>            <label><?php echo mysql_result($lanres,79,"text"); ?><input name="panel_opacity" type="text" id="panel_opacity" value="<?php echo $panel_opacity; ?>" size="6" />            </label>          </p>          <p><?php echo mysql_result($lanres,80,"text"); ?></p>          <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo mysql_result($lanres,81,"text"); ?>            <label>              <select name="per_font" >                <option value="<?php echo $per_font; ?>"><?php echo $per_font; ?></option>                <option value="sans-serif">sans-serif</option>                <option value="Courier New"> Courier New</option>                <option value="Arial">Arial</option>                <option value="Arial Black">Arial Black</option>                <option value="Georgia">Georgia</option>                <option value="Times New Roman">Times New Roman</option>                <option value="Arial, Helvetica, sans-serif">Arial, Helvetica, sans-serif</option>                <option value="Arial Black, Gadget, sans-serif">Arial Black, Gadget, sans-serif</option>                <option value="Comic Sans MS, cursive, sans-serif">Comic Sans MS, cursive, sans-serif</option>                <option value="Impact, Charcoal, sans-serif">Impact, Charcoal, sans-serif</option>                <option value="Tahoma, Geneva, sans-serif">Tahoma, Geneva, sans-serif</option>                <option value="Trebuchet MS, Helvetica, sans-serif">Trebuchet MS, Helvetica, sans-serif</option>              </select>            </label>            <label>       <?php echo mysql_result($lanres,82,"text"); ?>       <input name="per_color"  type="text" id="per_color" size="7" value="<?php echo $per_color; ?>"/></label><label><input class="colorbutton" type="button" value=" " onclick="popupcolor(\'per_color\')"/></label>           <label>        <?php echo mysql_result($lanres,83,"text"); ?>      <input name="per_size" type="text" id="textfield5" size="3" value="<?php echo $per_size; ?>"/>            </label>          </p>          <p><?php echo mysql_result($lanres,84,"text"); ?></p>          <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo mysql_result($lanres,81,"text"); ?><label>              <select name="p_font" >                <option value="<?php echo $p_font; ?>"><?php echo $p_font; ?></option>                <option value="sans-serif">sans-serif</option>                <option value="Courier New"> Courier New</option>                <option value="Arial">Arial</option>                <option value="Arial Black">Arial Black</option>                <option value="Georgia">Georgia</option>                <option value="Times New Roman">Times New Roman</option>                <option value="Arial, Helvetica, sans-serif">Arial, Helvetica, sans-serif</option>                <option value="Arial Black, Gadget, sans-serif">Arial Black, Gadget, sans-serif</option>                <option value="Comic Sans MS, cursive, sans-serif">Comic Sans MS, cursive, sans-serif</option>                <option value="Impact, Charcoal, sans-serif">Impact, Charcoal, sans-serif</option>                <option value="Tahoma, Geneva, sans-serif">Tahoma, Geneva, sans-serif</option>                <option value="Trebuchet MS, Helvetica, sans-serif">Trebuchet MS, Helvetica, sans-serif</option>              </select>            </label>            <label></label><label>      <?php echo mysql_result($lanres,82,"text"); ?><input name="p_color" type="text" id="p_color" size="7" value="<?php echo $p_color; ?>"/></label><label><input class="colorbutton" type="button" value=" " onclick="popupcolor(\'p_color\')"/></label>   <label> <?php echo mysql_result($lanres,83,"text"); ?><input name="p_size" type="text" id="textfield2" size="3" value="<?php echo $p_size; ?>"/>            </label>          </p><p><input type="submit" name="button" id="button" value="<?php echo mysql_result($lanres,59,"text"); ?>" /></p></form>';

search=' <p><?php echo mysql_result($lanres,8,"text"); ?></p><hr/><form id="form2" name="form2" method="post"  action="system/search_handler.php?src=home portal - preferences.php">          <div style="position:relative; width:100%; height:135px;overflow:auto;">            <table width="835" cellspacing="0" cellpadding="0">              <?php               function check($var)               {                 if ($var=="1")                 echo 'checked="checked"';               }			   function check2($var)               {                 if ($var=="yes")                 echo 'checked';               }			   function check3($var)               {                 if ($var=="no")                 echo 'checked';               }               ?>              <tr>                <td width="70">Web                  <input name="web" type="checkbox" id="checkbox5" value="1" <?php check($web) ?> /></td>                <td width="54">&nbsp;</td>                <td width="83">Videos                  <input name="videos" type="checkbox" id="checkbox5" value="1" <?php check($videos) ?> /></td>                <td width="54">&nbsp;</td>                <td width="93">Torrents                  <input name="torrents" type="checkbox" id="checkbox13" value="1" <?php check($torrents) ?> /></td>                <td width="57">&nbsp;</td>                <td width="78">Files                  <input name="files" type="checkbox" id="checkbox16" value="1" <?php check($files) ?> /></td>                <td width="54">&nbsp;</td>                <td width="78">Games                  <input name="games" type="checkbox" id="checkbox17" value="1" <?php check($games) ?> /></td>                <td width="52">&nbsp;</td>                <td width="128">Anime &amp; manga                  <input name="anime" type="checkbox" id="checkbox21" value="1" <?php check($anime) ?> /></td>                <td width="21">&nbsp;</td>              </tr>              <tr>                <td>Google</td>                <td><input name="google" type="checkbox" id="checkbox3" value="1" <?php check($google) ?> /></td>                <td>Youtube </td>                <td><input name="youtube" type="checkbox" id="checkbox6" value="1" <?php check($youtube) ?> /></td>                <td>The Pirate Bay</td>                <td><input name="piratebay" type="checkbox" id="checkbox10" value="1" <?php check($piratebay) ?> /></td>                <td>Rapidshare</td>                <td><input name="rapidshare" type="checkbox" id="checkbox14" value="1" <?php check($rapidshare) ?> /></td>                <td>Newgrounds</td>                <td><input name="newgrounds" type="checkbox" id="checkbox" value="1" <?php check($newgrounds) ?> /></td>                <td>Animefreak</td>                <td><input name="animefreak" type="checkbox" id="checkbox2" value="1" <?php check($animefreak) ?> /></td>              </tr>              <tr>                <td>Yahoo</td>                <td><input name="yahoo" type="checkbox" id="checkbox4" value="1" <?php check($yahoo) ?> /></td>                <td>Metacafe</td>                <td><input name="metacafe" type="checkbox" id="checkbox7" value="1" <?php check($metacafe) ?> /></td>                <td>Isohunt</td>                <td><input name="isohunt" type="checkbox" id="checkbox11" value="1" <?php check($isohunt) ?> /></td>                <td>Megaupload</td>                <td><input name="megaupload" type="checkbox" id="checkbox15" value="1" <?php check($megaupload) ?> /></td>                <td>Miniclip</td>                <td><input name="miniclip" type="checkbox" id="checkbox18" value="1" <?php check($miniclip) ?> /></td>                <td>Kumby</td>                <td><input name="kumby" type="checkbox" id="checkbox19" value="1" <?php check($kumby) ?> /></td>              </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>Yahoo Video</td>                <td><input name="yahoovid" type="checkbox" id="checkbox8" value="1" <?php check($yahoovid) ?> /></td>                <td>Demonoid</td>                <td><input name="demonoid" type="checkbox" id="checkbox12" value="1" <?php check($demonoid) ?> /></td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>Mangareader</td>                <td><input name="mangareader" type="checkbox" id="checkbox20" value="1" <?php check($mangareader) ?> /></td>              </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>Megavideo</td>                <td><input name="megavideo" type="checkbox" id="checkbox9" value="1" <?php check($megavideo) ?> /></td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>              </tr>            </table>          </div>          <p>            <input type="submit" name="button2" id="button2" value="<?php echo mysql_result($lanres,59,"text"); ?>" />          </p>        </form>';

panels='';

function view(type)
{
  if (type=="prefs")
     document.getElementById('bulletins').innerHTML=prefs;
  else if (type=="conn")
     document.getElementById('bulletins').innerHTML=conn;
  else if (type=="files")
     document.getElementById('bulletins').innerHTML=files;
  else if (type=="appear")
     document.getElementById('bulletins').innerHTML=appear;
  else if (type=="panels")
     document.getElementById('bulletins').innerHTML=2;
  else if (type=="search")
     document.getElementById('bulletins').innerHTML=search;		
}

function open_win()
{
window.open("/system/upnp_update.php","_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=yes, width=433, height=290");
}

<?php if 	($trigger_open=="yes") echo 'open_win()'; ?> 

function open_folder(num)
{
window.open("/system/folder.php?folder="+num,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=350, height=20");
}

var colorid;
function color(cvalue)
{
document.getElementById("colorview").value=cvalue;
document.getElementById("colorprev").style.backgroundColor=cvalue;
document.getElementById(colorid).value=cvalue;
}

var openw;

function popupcolor(a)
{
if (openw==0)
{
   colorid=a;
   document.getElementById('colorpanel').style.visibility='visible';
   openw=1;
}
else
{
   document.getElementById('colorpanel').style.visibility='hidden';
   openw=0;
}
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
	color: <?php echo $text_color; ?>;
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
.colorbutton
{
	background-image:url(img/pick.png);
}
.folderbutton
{
	background-image:url(img/folder.jpg);
	width:30px;
	height:26px;
}
#menu {
	position: absolute;
	opacity: <?php echo $panel_opacity; ?>;
	margin-left:5px;
}
#bulletins {
	background-color: <?php echo $panel_color; ?>;
	opacity: <?php echo $panel_opacity; ?>;
	min-width:684px;
	max-width:850px;
	padding: 10px;
	left:195px;
	right:0px;
	margin-right:5px;
	border: 1px solid #000;
	position: absolute;
}
#colorpanel {
	background-color: #999;
	position: relative;
	width:400px;
	padding:30px;
	top: 77px;
	margin: 0 auto;
	border: 1px solid #000;
}
-->
</style>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
</head>

<body>



<div id="colorpanel" style="visibility:hidden; z-index:1" ><table cellspacing="0" cellpadding="0"  border="0" align="center" style="border-collapse: collapse; background-color:#000"><tbody><tr><td>
<table width="375" cellspacing="1" cellpadding="0" border="0" align="center">
	<tbody><tr height="24">
		<td bgcolor="#190707" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2a0a0a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#3b0b0b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#610b0b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#8a0808" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#b40404" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#df0101" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#ff0000" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fe2e2e" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fa5858" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f78181" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f5a9a9" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f6cece" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f8e0e0" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fbefef" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#191007" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2a1b0a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#3b240b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#61380b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#8a4b08" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#b45f04" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#df7401" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#ff8000" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fe9a2e" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#faac58" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f7be81" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f5d0a9" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f6e3ce" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f8ece0" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fbf5ef" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#181907" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#292a0a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#393b0b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#5e610b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#868a08" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#aeb404" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#d7df01" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#ffff00" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f7fe2e" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f4fa58" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f3f781" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f2f5a9" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f5f6ce" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f7f8e0" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fbfbef" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#101907" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#1b2a0a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#243b0b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#38610b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#4b8a08" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#5fb404" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#74df00" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#80ff00" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#9afe2e" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#acfa58" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#bef781" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#d0f5a9" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#e3f6ce" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#ecf8e0" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f5fbef" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#071907" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0a2a0a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b3b0b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b610b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#088a08" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#04b404" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#01df01" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#00ff00" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2efe2e" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#58fa58" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#81f781" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#a9f5a9" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#cef6ce" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#e0f8e0" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#effbef" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#071910" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0a2a1b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b3b24" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b6138" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#088a4b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#04b45f" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#01df74" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#00ff80" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2efe9a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#58faac" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#81f7be" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#a9f5d0" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#cef6e3" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#e0f8ec" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#effbf5" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#071918" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0a2a29" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b3b39" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b615e" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#088a85" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#04b4ae" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#01dfd7" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#00ffff" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2efef7" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#58faf4" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#81f7f3" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#a9f5f2" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#cef6f5" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#e0f8f7" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#effbfb" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#071019" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0a1b2a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b243b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b3861" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#084b8a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#045fb4" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0174df" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0080ff" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2e9afe" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#58acfa" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#81bef7" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#a9d0f5" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#cee3f6" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#e0ecf8" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#eff5fb" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#070719" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0a0a2a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b0b3b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b0b61" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#08088a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0404b4" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0101df" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0000ff" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2e2efe" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#5858fa" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#8181f7" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#a9a9f5" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#cecef6" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#e0e0f8" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#efeffb" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#100719" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#1b0a2a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#240b3b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#380b61" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#4b088a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#5f04b4" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#7401df" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#8000ff" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#9a2efe" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#ac58fa" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#be81f7" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#d0a9f5" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#e3cef6" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#ece0f8" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f5effb" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#190718" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2a0a29" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#3b0b39" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#610b5e" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#8a0886" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#b404ae" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#df01d7" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#ff00ff" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fe2ef7" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fa58f4" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f781f3" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f5a9f2" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f6cef5" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f8e0f7" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fbeffb" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="24">
		<td bgcolor="#190710" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2a0a1b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#3b0b24" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#610b38" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#8a084b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#b4045f" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#df0174" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#ff0080" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fe2e9a" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fa58ac" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f781be" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f5a9d0" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f6cee3" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f8e0ec" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#fbeff5" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	<tr height="10">
		<td></td>
	</tr>
	<tr height="24">
		<td bgcolor="#000000" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#0b0b0b" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#151515" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#1c1c1c" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#2e2e2e" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#424242" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#585858" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#6e6e6e" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#848484" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#a4a4a4" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#bdbdbd" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#d8d8d8" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#e6e6e6" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#f2f2f2" onclick="color(this.bgColor)">&nbsp;</td>
		<td bgcolor="#ffffff" onclick="color(this.bgColor)">&nbsp;</td>
	</tr>
	</tbody></table>
	</td></tr></tbody></table><br />
    <table width="375" cellspacing="0" cellpadding="0" border="0" align="center">
  <tr>
    <td width="60">&nbsp;</td>
    <td width="71"><div id="colorprev" style="position:relative; width:45px; height: 38px; background-color:#FFF; border: 1px solid #000"></div></td><td width="140" ><input type="text" size="9" maxlength="7" style="font-family: Verdana; height: 30px; width: 115px; font-size: 22px; border: 1px solid #000" id="colorview" value="">&nbsp;</td>
    <td><input type="button" value="OK" onclick="popupcolor()" style=" height:38px; width:50px; border-bottom: solid 2px #CCC; border-right: solid 2px #CCC" /></td>
  </tr>
    </table>
</div>
<div id="main">
<div id=menu>
<ul id="MenuBar1" class="MenuBarVertical">
    <li><a href="index.php"><?php echo mysql_result($lanres,3,"text"); ?><?php if ($unread_bulls!=0) echo ' //'.$unread_bulls.'//'; ?></a></li>
    <li><a href="index.php?chat=1"><?php echo mysql_result($lanres,29,"text"); ?></a></li>
    <li><a href="home portal - search.php"><?php echo mysql_result($lanres,4,"text"); ?></a></li>
	<li><a href="home portal - preferences.php"><?php echo mysql_result($lanres,30,"text"); ?></a></li>
</ul>
<br/>
<ul id="MenuBar2" class="MenuBarVertical">
  <li><a href="#" onclick="view('prefs')"><?php echo mysql_result($lanres,45,"text"); ?></a></li>
  <li><a href="#" onclick="view('conn')" ><?php echo mysql_result($lanres,46,"text"); ?></a></li>
  <li><a href="#" onclick="view('files')"><?php echo mysql_result($lanres,49,"text"); ?></a>  </li>
  <li><a href="#" onclick="view('appear')"><?php echo mysql_result($lanres,48,"text"); ?></a></li>
<li><a href="#" onclick="view('search')"><?php echo mysql_result($lanres,47,"text"); ?></a></li>
</ul>
</div>
<div id="bulletins" >
 <p><br />
</p>
</div>

</div>
<script type="text/javascript">
view("prefs");
openw=0;
var MenuBar2 = new Spry.Widget.MenuBar("MenuBar2", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
