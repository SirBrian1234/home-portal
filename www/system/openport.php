<?php
if ($_SERVER['REMOTE_ADDR']=="127.0.0.1")
{
   $isadmin=1;
   Require "../data/preferences.php";
   Require "../data/hostnames.php";
}
else
{
   $isadmin=0;
   echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
   <html>
   <head>
   <meta http-equiv=\"REFRESH\" content=\"0; url=/index.php \"></HEAD>";
}
?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
ini_set("max_execution_time",300);
Require "../data/hostnames.php";

$command="\"C:\Home Portal\UPNP_IGD\upnpc\" -s";
$result = shell_exec($command);

//No IGD UPnP Device found on the network !
if (strlen($result)!=155)
{
    $pattern = '/Local LAN ip address : 192.168.[0-90-90-9].[0-90-90-9]/';
    $matches = array();
    preg_match($pattern, $result, $matches);
    //print_r($matches);
    $addr = substr($matches[0], 23 , 15);
    //print ($addr);
    
    do {
      $command="\"C:\Home Portal\UPNP_IGD\upnpc\" -a $addr 800 $wan_port TCP 0";
      $result = shell_exec($command);
      $pattern = '/failed with code 718/';
      preg_match($pattern, $result, $matches);
      if (!isset($matches[0]))
      {
           print "[*] Η λειτουργία ολοκληρώθηκε Δοκιμαστε τη σελιδα σας με μια σελιδα φιλου για να διαπιστώσετε αν λειτουργει.<br/>";
           $file = fopen("C:\Home Portal\UPNP_IGD\init.bat","w");
           fwrite($file,$command);
           fclose($file);
           break;
      }
      else 
      {
          print "[*] Η θυρα ".$wan_port." είναι δεσμευμένη δοκιμάζεται η επόμενη<br/>";
          $wan_port++;          
      }
    } while (1);
}
else
{
 print "[*] Δεν βρέθηκε συσκευή UPNP IGD στο δικτυό σας<br/>";
 print "[*] Απαιτείται χειροκίνητη ρύθμηση του δρομολογιτή σας (router) για να επιτρέπει την κινηση σε αυτή τη θύρα<br/>";
 $file = fopen("C:\Home Portal\UPNP_IGD\init.bat","w");
 fwrite($file,"::");
 fclose($file);
}


function write($arg1,$arg2)
{
  $stringData = "\$$arg1='$arg2';\n";
  return $stringData;
}
  $myFile = "../data/hostnames.php";
  $fh = fopen($myFile, 'w') or die("can't open file");
  fwrite($fh, "<?php\n");
  fwrite($fh,write('lan_hostname',$lan_hostname));
  fwrite($fh,write('wan_hostname',$wan_hostname));
  fwrite($fh,write('username',$username));
  fwrite($fh,write('password',$password));
  fwrite($fh,write('wan_port',$wan_port));
  fwrite($fh,"?>");
  fclose($fh);

print "[*] Ενημέρωση της διεύθυνσης...<br/>";
?>


<br/>
<?php if ($isadmin==1)			 {			 if ($update=="yes")               {					echo '<iframe width="400" ';			 		if ($dyndns=="yes") echo 'height="150"'; 			 		else echo 'height="108" '; 			 		echo 'frameborder="no" src="http://homeportal.php0h.com/hostname4.php';					if ($dyndns=="yes")                     {                     if ($wan_port==80)echo '?user='.$admin_name.'&domain='.$domain.'&usr='.$tusername.'&pwd='.$tpassword;                     else echo '?user='.$admin_name.'&domain='.$domain.'&port='.$wan_port.'&usr='.$tusername.'&pwd='.$tpassword;                     }                 else                     {                     if ($wan_port==80) echo '?user='.$admin_name.'&usr='.$tusername.'&pwd='.$tpassword;                     else echo '?user='.$admin_name.'&port='.$wan_port.'&usr='.$tusername.'&pwd='.$tpassword;                     }               		 echo '" ></iframe>';			   }         	   else 			   {			   		echo '<p>Η ανανεωση του tracker ειναι απενεργοποιημενη</p>';			   }			  }		 ?>