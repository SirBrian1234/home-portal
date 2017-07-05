<?php
//first of all the admin
if ($_SERVER['REMOTE_ADDR']=="127.0.0.1") $isadmin=1;
else $isadmin=0;

//second all the important files
Require "data/db_config.php";
Require "data/preferences.php";
Require "data/unread_bulls.php";
Require "data/hostnames.php";

//the refresh html variable for the preload of the page
$refresh='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="REFRESH" content="0; url=index.php "></HEAD>';

//connecting to the database...
$mysqlconnection=mysql_connect($db_host,$db_user,$db_password);
//init the db if not initialized
if (mysql_select_db($db_name,$mysqlconnection) && $mysqlconnection)
{
	$query="select * from language where lang='$language' order by id asc";
  $lanres= mysql_query($query,$mysqlconnection);

}

//reseting notice counter... you opened the page you saw everything, no excuses
if ($isadmin==1)
{
  $myFile = "data/unread_bulls.php";
  $fh = fopen($myFile, 'w') or die("can't open file");
  $stringData = "<?php\n";
  fwrite($fh, $stringData);
  $stringData = "\$unread_bulls='0';\n";
  fwrite($fh, $stringData);
  $stringData = "?>";
  fwrite($fh, $stringData);
  fclose($fh);
}


//here are all the requests from the page
//admin goes first
if ($isadmin==1)
{
  if ($_REQUEST['pm']) {
  	  $pm=$_REQUEST['pm'];
	  $myFile = "data/preferences.php";
	  $fh = fopen($myFile, 'w') or die("can't open file");
	  $stringData = 
	  	"<?php
		\$admin_name='$admin_name';
		\$pm='$pm';
		\$max_bulls='$max_bulls';
		\$tusername='$tusername';
		\$tpassword='$tpassword';
		\$language='$language';
		\$chat_nickselect='$chat_nickselect';
		\$bg_color='$bg_color';
		\$text_color='$text_color';
		\$bg_image='$bg_image';
		\$chat_theme='$chat_theme';
		\$panel_color='$panel_color';
		\$panel_opacity='$panel_opacity';
		\$per_color='$per_color';
		\$per_size='$per_size';
		\$per_font='$per_font';
		\$p_color='$p_color';
		\$p_size='$p_size';
		\$p_font='$p_font';
		?>";
	  fwrite($fh, $stringData);
	  fclose($fh);
  }
  else if ($_REQUEST['admin_name']) {
  	  $admin_name=$_REQUEST['admin_name'];
	  $myFile = "data/preferences.php";
	  $fh = fopen($myFile, 'w') or die("can't open file");
	  $stringData = 
	    "<?php
		\$admin_name='$admin_name';
		\$pm='$pm';
		\$max_bulls='$max_bulls';
		\$tusername='$tusername';
		\$tpassword='$tpassword';
		\$language='$language';
		\$chat_nickselect='$chat_nickselect';
		\$bg_color='$bg_color';
		\$text_color='$text_color';
		\$bg_image='$bg_image';
		\$chat_theme='$chat_theme';
		\$panel_color='$panel_color';
		\$panel_opacity='$panel_opacity';
		\$per_color='$per_color';
		\$per_size='$per_size';
		\$per_font='$per_font';
		\$p_color='$p_color';
		\$p_size='$p_size';
		\$p_font='$p_font';
		?>";
	  fwrite($fh, $stringData);
	  fclose($fh);
  }
  else if ($_REQUEST["friend"]==1 && $_REQUEST["friend_name"] && $_REQUEST["friend_link"] && $_REQUEST["type"])
  {
    $name=$_REQUEST["friend_name"];
    $link=$_REQUEST["friend_link"];
	$type=$_REQUEST["type"];
    $query="insert into friends values (null,'$name','$link','$type')";
    mysql_query($query,$mysqlconnection);
    echo $refresh;
  }
  else if ($_REQUEST["friend"]==1) echo $refresh;
  else if ($_REQUEST["page"]==1 && $_REQUEST["page_name"] && $_REQUEST["page_link"])
  {
    $name=$_REQUEST["page_name"];
    $link=$_REQUEST["page_link"];
    $query="insert into pages values (null,'$name','$link')";
    mysql_query($query,$mysqlconnection);
    echo $refresh;
  }
  else if ($_REQUEST["page"]==1) echo $refresh;
  else if ($_REQUEST["video"]==1 && $_REQUEST["video_name"] && $_REQUEST["video_link"])
  {
	$name=$_REQUEST["video_name"];
    $link=$_REQUEST["video_link"];
    $query="insert into videos values (null,'$name','$link')";
    mysql_query($query,$mysqlconnection);
    echo $refresh;
  }
  else if ($_REQUEST["video"]==1) echo $refresh;
  else if ($_REQUEST["music"]==1 && $_REQUEST["music_name"] && $_REQUEST["music_link"])
  {
	$name=$_REQUEST["music_name"];
    $link=$_REQUEST["music_link"];
    $query="insert into music values(null,'$name','$link')";
    mysql_query($query,$mysqlconnection);
    echo $refresh;
  }
  else if ($_REQUEST["music"]==1) echo $refresh;
  else if ($_REQUEST["friendsearch"]) $searchurl='http://homeportal.php0h.com/friendsearch.php?friend='.$_REQUEST["friendsearch"];
}

//everyone
//post a notice
if ($_REQUEST["write"]==1 && $_REQUEST["txt_name"] && $_REQUEST["txt_notice"] && $_REQUEST["RadioGroup1"])
{
  $name=$_REQUEST["txt_name"];
  $notice=$_REQUEST["txt_notice"];
  $notice='<div class="notice">
           <div class="notice_text">'.$notice.'</div>
		   <div class="details">
              <span style="margin-left:9px">Από: '.$name.'</span>
   		   </div>
		   </div>';
		   
  if ($_REQUEST["RadioGroup1"]=='public') $private=0;
  else $private=1;
  $query="insert into noticeboard values (null,'$name',null,'$notice', $private)";
  mysql_query($query,$mysqlconnection);
  
  $unread_bulls++;
  $myFile = "data/unread_bulls.php";
  $fh = fopen($myFile, 'w') or die("can't open file");
  $stringData = "<?php\n";
  fwrite($fh, $stringData);
  $stringData = "\$unread_bulls='$unread_bulls';\n";
  fwrite($fh, $stringData);
  $stringData = "?>";
  fwrite($fh, $stringData);
  fclose($fh);
  
  if ($isadmin!=1) {
	  $myFile = 'C:\Home Portal\core\notice.txt';
      $fh = fopen($myFile, 'w') or die("can't open file");
      $stringData = "1";
      fwrite($fh, $stringData);
	  fclose($fh);
	}
	
  echo $refresh;
}
else if ($_REQUEST["write"]==1 && $_REQUEST["txt_notice"])
  $warning=mysql_result($lanres,0,"text");
else if ($_REQUEST["write"]==1) echo $refresh;

//answer a notice
else if ($_REQUEST["answer"] && $_REQUEST["txt_notice"] && $_REQUEST["txt_name"])
{
  $answer=$_REQUEST["answer"];
  $name=$_REQUEST["txt_name"];
  $newtext=$_REQUEST["txt_notice"];
  
  $query="select notice,private from noticeboard where id=$answer";
  $results= mysql_query($query,$mysqlconnection);
  $private = mysql_result($results,$i,"private");
  if ($private!=1)
  {
  $oldtext = mysql_result($results,0,"notice");
  
  //<div style="overflow: auto; width: 677px;">
  $newtext='<div class="inner_notice">
            <div class="inner_notice_text">'.$newtext.'</div>
		    <div class="details">
               <span style="margin-left:9px">'.'Από: '.$name.'</span>
		    </div>
		    </div>';
			
  $rendered_text=$oldtext.$newtext;
  $query="update noticeboard set notice='$rendered_text' where id=$answer";
  mysql_query($query,$mysqlconnection);
  
  $unread_bulls++;
  $myFile = "data/unread_bulls.php";
  $fh = fopen($myFile, 'w') or die("can't open file");
  $stringData = "<?php\n";
  fwrite($fh, $stringData);
  $stringData = "\$unread_bulls='$unread_bulls';\n";
  fwrite($fh, $stringData);
  $stringData = "?>";
  fwrite($fh, $stringData);
  fclose($fh);
  
  if ($isadmin!=1) {
	  $myFile = 'C:\Home Portal\core\notice.txt';
      $fh = fopen($myFile, 'w') or die("can't open file");
      $stringData = "1";
      fwrite($fh, $stringData);
	  fclose($fh);
	}
    echo $refresh;
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Portal - <?php echo $admin_name; ?></title>

<?php
//admin functions
if ($isadmin==1) echo '
<script type="text/javascript">
function open_folder(num)
{
	window.open("/system/folder.php?folder="+num,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, 	scrollbars=no, resizable=no, copyhistory=no, width=350, height=20");
}
cc=0;
function edit_pm()
{
	if (cc==0)
	{
		cc=1;
		document.getElementById(\'pm\').innerHTML=\'<form id=form1 name="pm" method=post 				action="index.php" ><label><input type=text name=pm id=textfield value="'.$pm.'" 				size="90" /></label></form>\';
	}
}

function edit_name()
{
	if (cc==0)
	{
	cc=1;
	document.getElementById(\'name\').innerHTML=\'<form id=form1 name="admin_name" method=post 	action="index.php" ><label><input type=text name=admin_name id=textfield value="'.$admin_name.'" size="30" /></label></form>\';
	}
}

function edit_avatar()
{
	if (cc==0)
	{
	cc=1;
	document.getElementById(\'avatar\').innerHTML=\'<form id=image_upload enctype=multipart/form-data action=system/uploader.php method=POST><input type=hidden name=MAX_FILE_SIZE value=100000 /><input name=uploadedfile type=file size=80 /><input type=submit value='.mysql_result($lanres,17,"text").' /></form>\';
	}
	else
	{
	cc=0;
	document.getElementById(\'avatar\').innerHTML=\' \';
	}
}

function delimage(pre,num)
{
if (cc==0)
 {
  cc=1;
  document.getElementById(\'delete\'+pre+num).src="img/delete_on.gif";
  }
 else
 {
  cc=0;
  document.getElementById(\'delete\'+pre+num).src="img/delete_off.gif";
 }
}
</script>';
?>

<script type="text/javascript">
embed=0;
function RunNoticeCheck() {
	if (embed==1) {
	//check for script and style tabs - clean it - post it
	string = document.getElementById('txt_notice').value;
	string = string.replace(/<script/g, '&lt;script').replace(/<style/g, '&lt;style').replace(/<iframe/g, '&lt;iframe');
	document.getElementById('txt_notice').value=string;
	}
	else {
	//remove embed - check for http, hyperlink it	- post it
	string = document.getElementById('txt_notice').value;
	string = string.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\t/g, '&nbsp;&nbsp;&nbsp;').replace(/\n/g, '<br />').replace(/'/g, '"');
	
	var txt=new RegExp('http://[^ ]+','');
	if (string.search(txt)>0)
	{
	embedlink = string.match(txt);
	embedlink = '<a target="_blank" style="font-size:12px" href="'+embedlink+'">'+embedlink+'</a>';
	string = string.replace(txt,embedlink);
	string='<p>'+string+'</p>';
	document.getElementById('txt_notice').value=string;
	}
	else {
	document.getElementById('txt_notice').value=string;
	}
	}
}
function open_embed_help()
{
window.open("/system/embed_help.php","_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=yes, width=520, height=370");
}
function togglePrefs() {
	if (document.getElementById('prefs').style.visibility=="hidden") document.getElementById('prefs').style.visibility="visible";
	else document.getElementById('prefs').style.visibility="hidden";
}
function toggleEmbedCode() {
	if (embed==0){
		document.getElementById('embedOut').innerHTML="<?php echo mysql_result($lanres,27,"text"); ?>";
		document.getElementById('embedOut').style.color="#C00";
		embed=1;
	}
	else 
	{
		document.getElementById('embedOut').innerHTML="<?php echo mysql_result($lanres,12,"text"); ?>";
		document.getElementById('embedOut').style.color="#000";
		embed=0;
	}
	
}
function reply(id)
{
	document.getElementById('nheader').innerHTML="<?php echo mysql_result($lanres,1,"text");?>";
	document.getElementById('noticeb').action="index.php?answer="+id;
	document.getElementById('canswer').innerHTML=' <a href="#nheader" onclick="newpost()"><?php echo mysql_result($lanres,28,"text"); ?></a>';
}
function newpost()
{
	document.getElementById('nheader').innerHTML="<?php echo mysql_result($lanres,2,"text"); ?>";
	document.getElementById('noticeb').action="index.php?write=1"
	document.getElementById('canswer').innerHTML='';
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
}
ul.MenuBarVertical {
	opacity: <?php echo $panel_opacity; ?>;
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
#leftbar {
	position: absolute;
	width: 170px;
	margin-left:5px;
}
#bulletins {
	background-color: <?php echo $panel_color; ?>;
	opacity: <?php echo $panel_opacity; ?>;
	min-width:680px;
	padding: 20px;
	left:195px;
	right:205px;
	border: 1px solid #000;
	position: absolute;
}
#rightbar {
	position: absolute;
	width: 180px;
	right:0%;
	margin-right:5px;
}
.notice {
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #000;
	font-family: Georgia, "Times New Roman", Times, serif;
	width:100%;

}
.inner_notice {
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #000;
	font-family: Georgia, "Times New Roman", Times, serif;
	margin-top:12px;
	margin-left:30px;
	width:100%;
	max-width:670px;
}
.details {
	font-family: Arial, Helvetica, sans-serif;
	font-style: italic;
	color: #666;
	font-size: 12px;
	font-weight: bold;
	margin-top: 8px;
	margin-bottom: 10px;
}
.notice_text {
	margin: 10px;
	margin-top: 0px;
	max-height:517px;
	overflow:auto;
}
.inner_notice_text {
	margin: 10px;
	margin-top: 0px;
	max-height:450px;
	overflow:auto;
}
.plaisia {
	border: 1px solid #000;
	background-color: <?php echo $panel_color; ?>;
	opacity: <?php echo $panel_opacity; ?>;
	padding: 5px;
}
.plaisia p{
	font-size: 12px;
}
.plaisia li {
	list-style-type: none;
	font-size: 12px;
}
.folderbutton
{
	background-image:url(img/folder2.jpg);
	width:27px;
	height:23px;
}
#alertbutton
{
	background-image:url(img/alert.jpg);
	width:94px;
	height:35px;
}
#form1 {
font-style: italic;
	color: #666;
	font-size: 10px;
}
#form1 input{
font-style: italic;
	font-size: 10px;
}
#image_upload input{
	font-style: italic;
	font-size: 10px;
}
#chat {
	top: 58px;
	position: absolute;
	border: 3px solid #000;
}
#name {
	font-size: <?php echo $per_size; ?>px;
	color: <?php echo $per_color; ?>;
	font-family:<?php echo $per_font; ?>;
	text-decoration:none;
}
#pm
{
	font-size: <?php echo $p_size; ?>px;
	color: <?php echo $p_color; ?>;
	font-family: <?php echo $p_font; ?>;
	text-decoration:none;
}
#nheader {
	font-size: 14px	
}

-->
</style>
</head>

<body>
<?php echo "<!-- ".$_SERVER['REMOTE_ADDR']." -->"; ?>
<div id="main">
<div id="leftbar">

  <ul id="MenuBar1" class="MenuBarVertical">
    <li><a href="#" onclick="chat_to_notice()" ><?php echo mysql_result($lanres,3,"text"); ?></a></li>
    <li><a href="#" onclick="notice_to_chat()" ><?php echo mysql_result($lanres,29,"text"); ?></a></li>
    <?php
	if ($isadmin==1)
	echo "<li><a href=\"home portal - search.php\">".mysql_result($lanres,4,"text")."</a></li>";
    ?>
	<?php
		if ($isadmin==1)
			echo "<li><a href=\"home portal - preferences.php\">".mysql_result($lanres,30,"text")."</a></li>";
	?>
</ul>
  <br />
  <div id="friends" class="plaisia">
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><p><?php echo mysql_result($lanres,34,"text"); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($isadmin==1) echo '<a href="#" onclick="search_for_friend()">'.mysql_result($lanres,4,"text").'</a>';?></p>
      <hr /></td>
  </tr>
  <tr>
    <td><?php

			$query="select*from friends order by id desc";
            $results= mysql_query($query,$mysqlconnection);
			$imax=mysql_num_rows($results);
			for($i=0; $i < $imax; $i++)
			{       $j=$j+1;
                    $name = mysql_result($results,$i,"name");
					$link = mysql_result($results,$i,"link");
					$type[$i] = mysql_result($results,$i,"type");
					$id = mysql_result($results,$i,"id");
					if ($isadmin==1) $del='<a href="system/delete_handler.php?t=fr&id='.$id.'"><img id=deletefr'.$id.' onmouseover="delimage(\'fr\','.$id.')" onmouseout="delimage(\'fr\','.$id.')" src="img/delete_off.gif" width="13" height="14" border="0"></a>';
					$out[$i]='<li>&nbsp;&nbsp'.$del.'&nbsp;&nbsp;<a target="_blank" href="'.$link.'">'.$name.'</a></li>';
			}
?>      <p><?php echo mysql_result($lanres,31,"text"); ?><?php for ($i=0; $i < $imax; $i++)
						{
							if ($type[$i]=="WAN") echo $out[$i];
						}
						?>
                        </p>
        <p><?php echo mysql_result($lanres,32,"text"); ?><?php for ($i=0; $i < $imax; $i++)
						{
							if ($type[$i]=="LAN") echo $out[$i];
						}
						echo '<br />';
                                                ?>
</p></td>
  </tr>
  <tr>
    <td>
  <?php if ($isadmin==1)
echo "<hr /><form id=\"form1\" name=\"form1\" method=\"post\" action=\"index.php?friend=1\">
  <label>".mysql_result($lanres,36,"text")."
    <input name=\"friend_name\" type=\"text\" id=\"textfield\" size=\"25\" />
  </label><br>
  <label>".mysql_result($lanres,35,"text")."&nbsp;&nbsp;
    <input type=\"text\" name=\"friend_link\" id=\"textfield2\" size=\"25\"/>
  </label>
  <label>
        <select name=\"type\" id=\"select\">
          <option value=\"WAN\">".mysql_result($lanres,5,"text")."</option>
          <option value=\"LAN\">".mysql_result($lanres,6,"text")."</option>
        </select>
      </label>
  <label>
  <input type=\"submit\" name=\"Submit\" id=\"button\" value=\"+\" style=\"width: 25px;\" />
  </label>

</form>"; ?></td>
  </tr>
</table>
</div>
  <br />
  <div id="about" class="plaisia">
    <table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><p><?php echo mysql_result($lanres,7,"text"); ?></p><hr /></td>
      </tr>
      <tr>
        <td>
        </td>
      </tr>
      <tr>
        <td><p><?php echo $admin_name.'<br><br>'.mysql_result($lanres,33,"text").'<br><a href="http://'.$lan_hostname.':800">'.$lan_hostname.'</a>'; ?></p>
        </td>
      </tr>
      <tr>
        <td><hr />
        <p><a href="http://homeportal.php0h.com"><?php echo mysql_result($lanres,10,"text");?></a></p></td>
      </tr>
    </table>
  </div>
</div>
<div id="bulletins" >
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td>
        <table width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="150">
            <?php if ($isadmin==1) echo '
            <a href="#"><img onclick="edit_avatar()" src="img/avatar.jpg" width="100" height="100" style="border-style: none" /></a></td>
            <td><p onclick="edit_name()"><a id="name" href="#">'.$admin_name.'</a></p>
              <p onclick="edit_pm()"><a id="pm" href="#">'.$pm.'</a></p>';
			  else echo '
			  <img src="img/avatar.jpg" width="100" height="100" style="border-style: none" /></td>
            <td width="80%"><p  id="name">'.$admin_name.'</p>
              <p id="pm">'.$pm.'</p>';
			  ?>
            
            </td>
          </tr>
        </table>
        <span id="avatar"></span>
        <hr />
      </td>
    </tr>
    <tr>
      <td>
<div style="margin:0 auto;width:700px; margin-top:60px;">

<?php
$query="select*from noticeboard order by id desc";
$results= mysql_query($query,$mysqlconnection);
for($i=0; $i < mysql_num_rows($results) && $j<$max_bulls; $i=$i+1)
{       
	$j=$j+1;
	$name = mysql_result($results,$i,"name");
	$notice = mysql_result($results,$i,"notice");
	$date = mysql_result($results,$i,"date");
    $id = mysql_result($results,$i,"id");
	$private = mysql_result($results,$i,"private");
	if ($isadmin==0 && $private==1) continue;
    if ($isadmin==1) $delimage='<a href="system/delete_handler.php?t=nt&id='.$id.'"><img id=deletent'.$id.' onmouseover="delimage(\'nt\','.$id.')" onmouseout="delimage(\'nt\','.$id.')" src="img/delete_off.gif" width="13" height="14" border="0"></a>';
	echo $notice;
	if($private!=1)
	echo '<span class="details" style=" position:relative; margin-left: 475px; top:-28px">
		  <span>
		  	<a href="#nheader" onclick="reply('.$id.')">'.mysql_result($lanres,8,"text").'</a>
		  </span>
		  <span style="margin-left:10px">'.$date.'</span>
          <span style="margin-left:10px">'.$delimage.'</span>
		  </span>';
	else 
	echo '<span class="details" style="position:relative; margin-left:497px; top:-28px">
	      <span>'.$date.'</span>
          <span style="margin-left:10px;">'.$delimage.'</span>
		  </span>';
} 
?>

<div style="margin-top:50px"><form id="noticeb" name="noticeb" method="post"  onsubmit="return RunNoticeCheck()" action="index.php?write=1"><table width="680" align="center" cellpadding="0" class="formround">
<tr>
<td width="5%"  height="117">&nbsp;</td>
<td width="70%"><p class="padding"><span id="nheader"><?php echo mysql_result($lanres,9,"text"); ?></span><span style="font-size:10px" id="canswer"></span><span style="padding-left:160px; font-size:12px"><a href="javascript:" onclick="togglePrefs()"><?php echo mysql_result($lanres,11,"text"); ?></a></span></p>
                          <p>
                            <textarea name="txt_notice" cols="50" rows="4" id="txt_notice"></textarea>
                          </p>
                        <p> <span class="padding">Απο:</span>
                          <input name="txt_name" type="text" id="txt_name" size="45" value=" <?php if ($isadmin) echo $admin_name; ?>"/>&nbsp;<input type="submit" name="submit" id="submit" value="<?php echo mysql_result($lanres,13,"text"); ?>"/>
</p>
                        <p><?php echo $warning; ?></p></td>
                        <td><div id="prefs" style="position:relative; padding-top:20px; padding-left:-30px; font-size: 12px; visibility:hidden">
                          <p>
                            <label>
                              <input name="RadioGroup1" type="radio" id="RadioGroup1_0" value="public" checked="checked" />
                              <?php echo mysql_result($lanres,14,"text"); ?></label>
                            <br />
                            <label>
                              <input type="radio" name="RadioGroup1" value="private" id="RadioGroup1_1" />
                              Μονο για τον <?php echo $admin_name; ?></label>
                            <br />
                            <label><br />
                            </label>
                            <input type="button" onClick="toggleEmbedCode()" name="embed" id="embed" value="Embed code" />
                            <input type="button" onClick="open_embed_help()" name="button" id="button" value="?" />
                          </p>
<p id="embedOut"><?php echo mysql_result($lanres,12,"text"); ?></p>
                        </div></td>
                  </tr>
          </table></form></div></div>
      </td>
    </tr>
  </table>
</div>
<div id="rightbar">
  <div class=plaisia id="favourite">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td><p><?php echo mysql_result($lanres,40,"text"); ?></p>
      <hr /></td>
    </tr>
    <tr>
      <td><div style="position:relative; width:164px; overflow:auto;"><table>
		    <?php
 			$query="select*from pages order by id desc";
            $results= mysql_query($query,$mysqlconnection);
			for($i=0; $i < mysql_num_rows($results); $i=$i+1)
			{
              $j=$j+1;
              $name = mysql_result($results,$i,"name");
			  $link = mysql_result($results,$i,"link");
			  $id =  mysql_result($results,$i,"id");
			  echo '<tr>';
			  if ($isadmin==1) $del='<td><a target="_blank" href="system/delete_handler.php?t=pg&id='.$id.'"><img id=deletepg'.$id.' onmouseover="delimage(\'pg\','.$id.')" onmouseout="delimage(\'pg\','.$id.')" src="img/delete_off.gif" width="13" height="14" border="0"></a></td>';
			  echo $del.'<td><li>&nbsp;&nbsp;<a target="_blank" href="'.$link.'">'.$name.'</a></li></td></tr>';
			}
          ?>
          </table><br />
</div>
      </td>
    </tr>
    <tr>
      <td><?php if ($isadmin==1)
echo "<hr /><form id=\"form1\" name=\"form1\" method=\"post\" action=\"index.php?page=1\">
  <label>".mysql_result($lanres,37,"text")."
    <input name=\"page_name\" type=\"text\" id=\"textfield\" size=\"26\" />
  </label><br>
  <label>".mysql_result($lanres,35,"text")."&nbsp;&nbsp;
    <input type=\"text\" name=\"page_link\" id=\"textfield2\" size=\"18\" />
    <input type=\"submit\" name=\"Submit\" id=\"button\" value=\"+\" style=\"width: 25px;\" />
  </label>
</form>"; ?></td>
  </tr>
</table>
</div>
<br/>
<div class="plaisia">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td><p><?php echo mysql_result($lanres,16,"text"); ?></p>
      <hr /></td>
    </tr>
    <tr>
      <td><div style="position:relative; width:164px; overflow:auto;"><table><?php

			$query="select*from music order by id desc";
                        $results= mysql_query($query,$mysqlconnection);
			for($i=0; $i < mysql_num_rows($results); $i=$i+1)
			{
                          $j=$j+1;
                          $name = mysql_result($results,$i,"name");
			  $link = mysql_result($results,$i,"link");
			  $id =  mysql_result($results,$i,"id");
			  if ($isadmin==1) $del='<td><a target="_blank" href="system/delete_handler.php?t=ms&id='.$id.'"><img id=deletems'.$id.' onmouseover="delimage(\'ms\','.$id.')" onmouseout="delimage(\'ms\','.$id.')" src="img/delete_off.gif" width="13" height="14" border="0"></a></td>';
			  echo $del.'<td><li>&nbsp;&nbsp;<a target="_blank" href="'.$link.'">'.$name.'</a></li></td></tr>';
			}
          ?>
          </table><br />
</div>
      </td>
    </tr>
    <tr>
      <td><?php if ($isadmin==1)
echo "<hr /><form id=\"form1\" name=\"form1\" method=\"post\" action=\"index.php?music=1\">
  <label>".mysql_result($lanres,37,"text")."
    <input name=\"music_name\" type=\"text\" id=\"textfield\" size=\"26\" />
  </label><br>
  <label>".mysql_result($lanres,35,"text")."&nbsp;&nbsp;
    <input type=\"text\" name=\"music_link\" id=\"textfield2\" size=\"18\" />
    <input type=\"submit\" name=\"Submit\" id=\"button\" value=\"+\" style=\"width: 25px;\" />
  </label>
</form>"; ?></td>
  </tr>
</table>
</div>
<br/>
<div class="plaisia">    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td><p><?php echo mysql_result($lanres,15,"text"); ?></p>
      <hr /></td>
    </tr>
    <tr>
      <td><div style="position:relative; width:164px; overflow:auto;"><table><?php

			$query="select*from videos order by id desc";
                        $results= mysql_query($query,$mysqlconnection);
			for($i=0; $i < mysql_num_rows($results); $i=$i+1)
			{
                          $j=$j+1;
                          $name = mysql_result($results,$i,"name");
			  $link = mysql_result($results,$i,"link");
			  $id =  mysql_result($results,$i,"id");
			  if ($isadmin==1) $del='<td><a target="_blank" href="system/delete_handler.php?t=vd&id='.$id.'"><img id=deletevd'.$id.' onmouseover="delimage(\'vd\','.$id.')" onmouseout="delimage(\'vd\','.$id.')" src="img/delete_off.gif" width="13" height="14" border="0"></a></td>';
			  echo $del.'<td><li>&nbsp;&nbsp;<a target="_blank" href="'.$link.'">'.$name.'</a></li></td></tr>';
			}
          ?>
          </table><br />
</div>
      </td>
    </tr>
    <tr>
      <td><?php if ($isadmin==1)
echo "<hr /><form id=\"form1\" name=\"form1\" method=\"post\" action=\"index.php?video=1\">
  <label>".mysql_result($lanres,37,"text")."
    <input name=\"video_name\" type=\"text\" id=\"textfield\" size=\"26\" />
  </label><br>
  <label>".mysql_result($lanres,35,"text")."&nbsp;&nbsp;
    <input type=\"text\" name=\"video_link\" id=\"textfield2\" size=\"18\" />
    <input type=\"submit\" name=\"Submit\" id=\"button\" value=\"+\" style=\"width: 25px;\" />
  </label>
</form>"; ?></td>
  </tr>
</table>
</div>
<br/>
<div class="plaisia"><table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td>
	  <?php
					    if ($isadmin) 
	  						echo '<tr><td width=100%><p>'.mysql_result($lanres,18,"text").'</p></td><td><input type="button" class="folderbutton" onclick="open_folder(2)"/></td></tr></table><div style="position:relative; width:164px; overflow:auto;">'; 
	  				    else 
							echo '<p>'.mysql_result($lanres,19,"text").'</p><div style="position:relative; width:164px; overflow:auto;">'; 
			            if ($handle = opendir('uploads'))
                        {
                        while (false !== ($file = readdir($handle)))
                        {
        			    if ($file!='.' && $file!='..') echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="uploads/'.$file.'">'.$file.'</a></li>';
        			    $i++;
   			            }
						echo '<br /></div>';
				        closedir($handle);
				        }
						?>                        
                        <?php
                        if ($isadmin) 
							echo '<hr><table><tr><td width=100%><p>'.mysql_result($lanres,20,"text").'</p></td><td><input type="button" class="folderbutton" onclick="open_folder(3)"/></td></tr></table>';
						?>
<hr /></td></tr>

    </tr>
    <tr>
      <td><?php if ($isadmin) {
		  		echo '<table><tr><td><p width=100%>'.mysql_result($lanres,21,"text").'</p></td><td><input type="button" class="folderbutton" onclick="open_folder(4)"/></td></tr></table><div style="position:relative; width:164px; overflow:auto;">';
				if ($handle = opendir('downloads'))
                {
                        while (false !== ($file = readdir($handle)))
                        {
        					if ($file!='index.html' && $file!='.' && $file!='..') echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="downloads/'.$file.'">'.$file.'</a></li>';
        					$i++;
   			 			}
						echo '<br /></div>';
						closedir($handle);
				}	  
	  }
	  else echo'<p><a href="system/file_upload.php">'.mysql_result($lanres,22,"text").'</a></p>'; ?></td>
  </tr>
</table>
</div>
<br />
<br />
</div>
</div>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
<?php
if ($isadmin==1)
{
echo '
<script type="text/javascript">
temp=document.getElementById(\'main\').innerHTML;
function chat_to_notice()
{
  document.getElementById(\'main\').innerHTML=temp;
}
function notice_to_chat()
{
  document.getElementById(\'bulletins\').innerHTML=\'<object width="100%" height="510" type="application/x-shockwave-flash" data="chat/lightIRC.swf" id="lightIRC" style="visibility: visible;"><param name="flashvars" value="host=irc.lightirc.com&amp;language=en&amp;nickselect='.$chat_nickselect.'&amp;nick='.$admin_name.'&amp;autojoin=#home_portal&amp;styleURL=chat/styles/'.$chat_theme.'.swf"></object>\';
    document.getElementById(\'bulletins\').style.padding="0px";
}';

echo "
function search_for_friend()
{
  document.getElementById('bulletins').innerHTML='<h2>".mysql_result($lanres,23,"text")."</h2><p>".mysql_result($lanres,24,"text")."</p><form name=\"form1\" method=\"get\" action=\"index.php\"><label><input name=\"friendsearch\" type=\"text\" id=\"searchfriend\" size=\"60\" /></label><label> <input type=\"submit\" id=\"button\" value=\"Αναζητηση\"  /></label></form><p>Σημειωση: για να μπορεσετε να βρειτε ενα φιλο θα πρεπει να εισαγετε το ακριβες ονομα του (κεφαλαια-μικρα, αριθμους, ειδικους χαρακτηρες). Η αναζητηση μπορει να εμφανισει το μεγιστο ενα ατομο (λογω πολιτικης προστασιας των κομβων).</p><iframe width=\"695\" height=\"400\" frameborder=0 id=\"searchframe\" src=\"".$searchurl."\"></iframe>';
}";

if ($_REQUEST['chat']==1) echo 'notice_to_chat();';
else if ($_REQUEST['friendsearch']) echo 'search_for_friend();';
echo '</script>';
}
else
{
echo '
<script type="text/javascript">
temp=document.getElementById(\'main\').innerHTML;
function chat_to_notice()
{
  document.getElementById(\'main\').innerHTML=temp;
}
function notice_to_chat()
{
  document.getElementById(\'bulletins\').innerHTML=\'<object width="100%" height="510" type="application/x-shockwave-flash" data="chat/lightIRC.swf" id="lightIRC" style="visibility: visible;"><param name="flashvars" value="host=irc.lightirc.com&amp;language=en&amp;nickselect=yes&amp;nick=User&amp;autojoin=#home_portal&amp;styleURL=chat/styles/'.$chat_theme.'.swf"></object><div style=" position:absolute; top:530px"><input type="button" id="alertbutton" onClick="chat_alert()"/></div>\';
  document.getElementById(\'bulletins\').style.padding="0px";
}
function chat_alert()
{
window.open("/system/alert.php","_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=430, height=50");
}';
if ($_REQUEST['chat']==1) echo 'notice_to_chat();';
echo '</script>';
}
?>
<?php mysql_close($mysqlconnection); ?>
</html>