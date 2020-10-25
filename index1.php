<?
include "../../mainfile.php"; 
require XOOPS_ROOT_PATH."/header.php";

global $xoopsConfig;$xoopsDB;$xoopsTheme;

/*
By Willy Chestnut
willy@jtlnet.com

This is a simple script that will enable you to check network services of hosts and print out a simple graphical display staiting wether the particular service is running or not.
Use the line below to set up and display the results.
echo lookup("PortNumber","The Name of the Service","your.host.com");

*/ 
function lookup($hport,$Something,$who){

$fp = fsockopen($who, $hport, &$errno, &$errstr, 4);
if (!$fp){
$data = "<tr><td width=\"40%\"><font face=\"Verdana\" color=\"#000000\"><strong>$Something :</td></strong></font><td width=\"60%\"><font color=\"#FF0000\" face=\"Verdana\"><strong>Down</strong><em>($who)</em></font></td></tr>";
} else {
$data = "<tr><td width=\"40%\"><font face=\"Verdana\" color=\"#000000\"><strong>$Something :</strong></td></font><td width=\"60%\"><font face=\"Verdana\"><strong><font color=\"#008000\">Running</font> </strong><em>($who)</em></font></td></tr>";
fclose($fp);
}
return $data;
}

?>
<html>
<head>
<title>Systems Status</title>
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
</head>
<body>
<?php
if(isset($domain)){
echo "<p><small>example: your.hostname.com </small></em></p>";

?>
<form method="POST" action="index1.php">
<p><input type="text" name="domain" size="20"><input type="submit"
value="Check" name="submit"></p>
</form>
<?php
echo "<table border=\"0\" cellpadding=\"0\" width=\"75%\">";
echo lookup("80","Web Server","www.tswn.com");
echo lookup("21","FTP Server","www.tswn.com");
echo lookup("27999","!!=(T.S.W.N. Black Widow)=!! Mechwarrior 4 Server","www.tswn.com");
echo lookup("8888","!!=(T.S.W.N. Black Widow)=!! Unreal Tournament","www.tswn.com");
echo lookup("27999","!!=(T.S.W.N. Wolf Spider)=!! Mechwarrior 4 Server","68.102.62.106");
echo lookup("8766","!!=(T.S.W.N. Wolf Spider)=!! TeamSpeak Chat Server","68.102.62.106");
echo "</table>";
?>

<?
require XOOPS_ROOT_PATH."/footer.php";
?>
</BODY>