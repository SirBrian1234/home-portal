<?php
Require "../data/preferences.php";

if ($_SERVER['REMOTE_ADDR']=="127.0.0.1") $isadmin=1;
else $isadmin=0;

if ($isadmin==1)
{
  if (basename( $_FILES['uploadedfile']['type'])=='jpg' || basename( $_FILES['uploadedfile']['type'])=='jpeg' || basename( $_FILES['uploadedfile']['type'])=='JPEG' || basename( $_FILES['uploadedfile']['type'])=='JPG')
  {
    $target_path = '../img/avatar.jpg';
    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"><html><head><meta http-equiv="REFRESH" content="0;url=../index.php"></HEAD>';
    else echo "There was an error uploading the file!";
  }
  else echo "<h3>Format error, accepted formats are: .jpg .jpeg .JPEG .JPG</h3>";
}
else echo '<h1>You have no buisness here, shoo</h1>';
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


