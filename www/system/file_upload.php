<?php
Require "../data/preferences.php";
Require "../data/file_prefs.php";

//application/zip
//application/x-rar-compressed
//application/x-bittorrent
//audio/mpeg
//text/plain

if ($_REQUEST['save']==1)
if (($file_password_enable=='on' && md5($_REQUEST['password'])==$file_password) || $file_password_enable=='')
if ($_FILES["file"]["size"] <= $file_max_size*1024*1024)
{
 if (($_FILES["file"]["type"]=='application/x-rar-compressed' && $rar=='on') ||
	  ($_FILES["file"]["type"]=='application/zip' && $zip=='on') ||
	  ($_FILES["file"]["type"]=='audio/mpeg' && $mp3=='on') ||
	  ($_FILES["file"]["type"]=='text/plain' && $txt=='on') ||
	  ($_FILES["file"]["type"]=='image/jpeg' && $jpg=='on') || 
	  ($_FILES["file"]["type"]=='application/x-bittorrent' &&  $torrent=='on')) {

		if ($_FILES["file"]["error"] > 0)
   		 {
    		$warning='Αποτυχια αποστολης του αρχειου';
    		}
  		else
    	{
			$info = "<div style=\"padding:10px;margin-top:50px;background-color:#CCC; border:1px solid #000\">
			Αρχειο: " . $_FILES["file"]["name"] . "<br />
    		Τυπος: " . $_FILES["file"]["type"] . "<br />
    		Μεγεθος: " . ($_FILES["file"]["size"] / 1024 /1024) . " ΜΒ<br />
			</div>";
			
			$path="../downloads/".rand(0,9).rand(0,9).rand(0,9).rand(0,9)."_" . $_FILES["file"]["name"];
			if (file_exists($path))
    	    {
      			$info=$info.$_FILES["file"]["name"] . "Αυτο το αρχειο υπαρχει ηδη";
      		}
    		else
      		{				
      			move_uploaded_file($_FILES["file"]["tmp_name"],$path);
	  			$warning='Το αρχειο σταλθηκε επιτυχως';
      		}
    	}
  }

}
else $warning='Το αρχειο ειναι πολυ μεγαλο για αποστολη '.$_FILES["file"]["size"];
else $warning='Λαθος κωδικος προσβασης';
?> 		

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload file</title>
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
</style>
</head>

<body>
<div style=" position:absolute; margin-left:20%; margin-top:5%; width:610px; padding:30px; padding-top:8px; height:190px; background-color:#CCC; border:1px solid #000">
<?php 
if ($file_enable=='on') 
{
	echo '<p>Ανεβασμα αρχειου
      <span style="margin-left:30px">'.$warning.'</span></p>
      <form id="image_upload" enctype="multipart/form-data" action="file_upload.php" method="post">
        <p>
          <input name="file" type="file" size="80" />
          <input type="submit" value="Αποστολη" />
          </p>
        <p>Επιτρεπομενοι τυποι αρχειων:'; 
						
		if ($jpg=='on') echo '.zip ';
		if ($rar=='on') echo '.rar ';	
		if ($txt=='on') echo '.txt ';
		if ($mp3=='on') echo '.mp3 ';
		if ($jpg=='on') echo '.jpg ';
		if ($torrent=='on') echo '.torrent ';
											  
		echo '</p>
        <p>Οριο μεγεθους: '.$file_max_size.' MB';
          
          if ($file_password_enable=='on')
          {
          echo '<span style="margin-left:233px">
          <label> password
            <input type="password" name="password" id="textfield" />
          </label>
          </span>';
          }
          
        echo '</p>
        <a href="/index.php">Πισω</a>
        <input name="save" type="hidden" value="1" />
      </form>'.$info;
}
else echo '<br />
		<br />
Η υπηρεσια αποστολης αρχειων ειναι απενεργοποιημενη απο τον χρηστη<br />
<br />
<br />
<br />
<br />
<br />
<a href="/index.php">Πισω</a>
';
?>
</div>
</body>
</html>