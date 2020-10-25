<?
include "../../mainfile.php"; 
require XOOPS_ROOT_PATH."/header.php";

global $xoopsConfig;$xoopsDB;$xoopsTheme;
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

//  The latest version is always availble at http://basmaaks.xs4all.nl
//  You'll need php version 4.1.0 or above to get it all running.
//  Mail me for any questions at the_gamblers@basmaaks.xs4all.nl or post a message

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");    

setcookie("template", $template, (time() + 2592000));

// Ask for the config.php file with al the settings
require "config.php";

$config = XOOPS_ROOT_PATH."/modules/server_info/config.php";  //<--------will this allow me to call a global later?


// This routine runs first. If the page is secured you can't pass the routine.
if ($securesite==true){
	function error ($error_message) {
		echo $error_message."<BR>";
		exit;
		}
	if ( (!isset($PHP_AUTH_USER)) || ! (($PHP_AUTH_USER == $loginname) && ( $PHP_AUTH_PW == "$password" )) ) {
		header("WWW-Authenticate: Basic realm=$infotext");
		header("HTTP/1.0 401 Unauthorized");
		error("Unauthorized access...");
	}
}

// reassign HTTP variables (incase register_globals is off)
if (!empty($_GET)) while(list($name, $value) = each($_GET)) $$name = $value;
if (!empty($_POST)) while(list($name, $value) = each($_POST)) $$name = $value;

//check for a theme
if (!(isset($template) && file_exists('themes/' . $template . '.php'))) {
    $template = $defaulttheme;
        if(count($plng) > 0) {
            while(list($k,$v) = each($plng)) {
                $k = split(';', $v, 1);
                $k = split('-', $k[0]);
                if(file_exists('themes/' . $k[0] . '.php')) {
                    $lng = $k[0];
                    break;
                }
            }
        }
    }
require __DIR__ . '/themes/' . $template . '.php';

// Check for a language
if (!(isset($lng) && file_exists('languages/' . $lng . '.php'))) {
    $lng = $defaultlang;
    // see if the browser knows the right languange.
    if(isset($HTTP_ACCEPT_LANGUAGE)) {
        $plng = split(',', $HTTP_ACCEPT_LANGUAGE);
        if(count($plng) > 0) {
            while(list($k,$v) = each($plng)) {
                $k = split(';', $v, 1);
                $k = split('-', $k[0]);
                if(file_exists('languages/' . $k[0] . '.php')) {
                    $lng = $k[0];
                    break;
                }
            }
        }
    }
}
require __DIR__ . '/languages/' . $lng . '.php';

// If this is the first time visiting this page set the jump_var to 0 instead of nothing
if ($jump_var==""){
	$jump_var="0";
}

//disk statistics only needed on 2 pages
if ($jump_var=="0" or $jump_var=="4") {
	$diskfreec = round(diskfreespace("c:")  /  (1048576),2);
	$diskfreed = round(diskfreespace("d:")  /  (1048576),2);
	$diskfreee = round(diskfreespace("e:")  /  (1048576),2);
	$diskfreef = round(diskfreespace("f:")  /  (1048576),2);
	$diskfreeg = round(diskfreespace("g:")  /  (1048576),2);
	$disktotalc = round(disk_total_space("c:") /  (1048576),2);
	$disktotald = round(disk_total_space("d:") /  (1048576),2);
	$disktotale = round(disk_total_space("e:") /  (1048576),2);
	$disktotalf = round(disk_total_space("f:") /  (1048576),2);
	$disktotalg = round(disk_total_space("g:") /  (1048576),2);
	$diskfree = $diskfreec + $diskfreed + $diskfreee + $diskfreef + $diskfreeg;
	$disktotal = $disktotalc + $disktotald + $disktotale + $disktotalf + $disktotalg;
	$diskusage = round(($disktotal-$diskfree),2);
	$diskusagec = round(($disktotalc-$diskfreec),2);
	$diskusedprecent = round((($diskusage/$disktotal ) * 100),2);
	$diskfreeprecent = round((($diskfree/$disktotal ) * 100),2);
	$diskusedprecentc = round((($diskusagec/$disktotalc ) * 100),2);
	if ($disktotald!=""){
		$diskusaged = round(($disktotald-$diskfreed),2);
		$diskusedprecentd = round((($diskusaged/$disktotald ) * 100),2);
	}	
	if ($disktotale!=""){
		$diskusagee = round(($disktotale-$diskfreee),2);
		$diskusedprecente = round((($diskusagee/$disktotale ) * 100),2);
	}
	if ($disktotalf!=""){
		$diskusagef = round(($disktotalf-$diskfreef),2);
		$diskusedprecentf = round((($diskusagef/$disktotalf ) * 100),2);
	}
	if ($disktotalg!=""){
		$diskusageg = round(($disktotalg-$diskfreeg),2);
		$diskusedprecentg = round((($diskusageg/$disktotalg ) * 100),2);
	}
}

// The costum style sheet
//$CSS = "<style type=\"text/css\">table td {background-color:$color_table;color:$font_info;}.head {background-color:$color_header;color:$font_table;}.body {background-color:$color_background;color:$font_text;scrollbar-face-color:$scrollbar_face; scrollbar-highlight-color:$scrollbar_highlight; scrollbar-shadow-color:$scrollbar_shadow; scrollbar-3dlight-color:$scrollbar_3dlight; scrollbar-arrow-color:$scrollbar_arrow; scrollbar-track-color:$scrollbar_track; scrollbar-darkshadow-color:$scrollbar_darkshadow;}.generatedinfo {background-color:$color_table;color:$font_variables;}a:link {font-family:$font_type; //color:$color_link;font-size: 11px; font-style: normal; text-decoration: none}a:active {font-family: $font_type; color:$color_alink; font-size: 11px; font-style: normal; text-decoration: none}a:visited {font-family:$font_type; color:$color_vlink; font-size: 11px; font-style: normal; text-decoration: none}a:hover {font-family:$font_type; color:$color_hlink; font-size: 11px; font-style: normal; text-decoration: underline}.buttons {font-family:$font_type; color:$button_text; font-size: 11px; border: 1px solid #C0C0C0;background-color:$button_color}.fields {border:1px solid #7C8184; font-family:$font_type; font-size: ////11px; ;}.toneborder {border-color:$border_color;	border-width:$border_thick;	border-style:$border_style; }</style>";

// send the header of the page to the browser and begin the body
echo "<head><meta http-equiv=\"Content-Type\" content=\"text/html; $charset\">";        
echo "$CSS<title>Sysinfo $Version for $HTTP_SERVER_VARS[SERVER_NAME]</title></HEAD><BODY class=body>";
if ($usebackground==true){
	echo "<BODY BACKGROUND=\"$imgbackground\">";
}

// Begin the first page with the general info ( just gather the info )
if ($jump_var=="0") {
	$ip='localhost';
	$regels = explode("\n", `memory.exe`);
	$totaal_fysiek = round($regels[2] /1048576);
	$beschikbaar_fysiek = round($regels[3] /1048576);
	$gebruikt_fysiek = $totaal_fysiek - $beschikbaar_fysiek;
	$gebruikt_precent= round ((($gebruikt_fysiek/$totaal_fysiek ) * 100) ,2);
	$beschikbaar_precent = round ((($beschikbaar_fysiek/$totaal_fysiek) *100) ,2);
	$ipadres=gethostbyname($HTTP_SERVER_VARS['SERVER_NAME']);
	$ver = `ver`;
	$date = date('r');

	//Networkstatistics
	$fn = "tmp.txt";
	exec("netstat -e>$fn");
	$fcontents = file($fn);
		while (list ($line_num, $line) = each($fcontents)) {
			if (stristr($line,"bytes")) {
				$line = explode(" ",$line);
				$cnt = 0;
				for ($i=0;$i<count($line);$i++) {
					if ($line[$i]=="") continue;
					if ($cnt==0) $text = ucfirst($line[$i]);
					elseif ($cnt==1) $rec = $line[$i];
					elseif ($cnt==2) $sent = $line[$i];             
					$cnt++;
				}
		}
	}
	$totalrecieve = round($rec  /  (1048576),2);
	$totalsent = round($sent  /  (1048576),2);
	unlink($fn);
	
	// Check for an update
	if($updatecheck==true)
			{
			$filename = "http://www.xs4all.nl/~basmaaks/sysinfo.dat";
  			$fd = fopen ($filename, "r");
  			$contents = fread ($fd, 1024);
  			fclose ($fd);
			}
	
	//uptime
	$uptime = (time() - filemtime($pagefile));
	$days = floor($uptime / (24*3600));
	$uptime = $uptime - ($days * (24*3600));
	$hours = floor($uptime / (3600));
	$uptime = $uptime - ($hours * (3600));
	$minutes = floor($uptime /(60));
	$uptime = $uptime - ($minutes * 60);
	$seconds = $uptime;
	if (!eregi("[0-9]{2}", $seconds)){
		$seconds = "0".$seconds;
	}
	if (!eregi("[0-9]{2}", $minutes)){
		$minutes = "0".$minutes;
	}
	if (!eregi("[0-9]{2}", $hours)){
		$hours = "0".$hours;
	}
	if($days == 1){
		$days = $days ." ".$label['day'];
	}elseif($days == 0){
		$days="";
	}else{
		$days = $days ." ".$label['days'];
	}
	if($hours == 1){
		$hours = $hours ." ".$label['hour'];
	}else{ $hours = $hours ." ".$label['hours'];
	}
	if($minutes == 1){
		$minutes = $minutes ." ".$label['minute'];
	}else{ $minutes = $minutes ." ".$label['minutes'];
	}
	if($seconds == 1){
		$seconds = $seconds ." ".$label['second'];
	}else{ $seconds = $seconds ." ".$label['seconds'];
	}
	$theuptime = "".$days." ".$hours." ".$minutes." ".$seconds;
	
	//cpu information
	$CPUINFO =  "$NUMBER_OF_PROCESSORS Cpu(s) $PROCESSOR_IDENTIFIER";
	
	// Get the size of the swapfile
	$swapfile = round ((filesize($pagefile)) / (1048576),2);
	
	//generate the general first html page and send it to the browser
	echo "<center><table border=0><tr><td valign=top>"
	."<table class=toneborder><tr><td class=head><center><b>".$label['general_info']."</b></center></td></tr>" 
	."<tr><td><table border=0>" 
	."<tr><td>".$label['current_time'].":</td><td><span class=generatedinfo>" 
	.$date ." gmt"
	."</span></td></tr><tr><td>".$label['system_uptime'].":</td><td><span class=generatedinfo>"
	.$theuptime
	."</span></td></tr><tr><td>".$label['server_enviroment'].":</td><td><span class=generatedinfo>"
	.$HTTP_SERVER_VARS['SERVER_SOFTWARE']
	."</span></td></tr><tr><td>".$label['domain_name'].":</td><td><span class=generatedinfo>"
	.$HTTP_SERVER_VARS['SERVER_NAME']
	."</span></td></tr><tr><td>".$label['ip_adres'].":</td><td><span class=generatedinfo>"
	.$ipadres
	."</span></td></tr><tr><td>".$label['server_type'].":</td><td><span class=generatedinfo>"
	.$HTTP_SERVER_VARS['SERVER_PROTOCOL'].$HTTP_SERVER_VARS['GATEWAY_INTERFACE']
	."</span></td></tr><tr><td>".$label['server_operating'].":</td><td><span class=generatedinfo>"
	.$ver
	."</span></td></tr><tr><td>".$label['cpu_info'].":</td><td><span class=generatedinfo>"
	.$CPUINFO
	."</span></td></tr><tr><td>".$label['adres_webmaster'].":</td><td><span class=generatedinfo>"
	.$HTTP_SERVER_VARS['SERVER_ADMIN']
	."</span></td></tr><tr><td>".$label['swapfile'].":</td><td><span class=generatedinfo>"
	.$label['file'] .$pagefile ." is " .$swapfile ." Mb"
	."</span></table></table>";
	If ($show['services']==true) {
		if ($usebackground==true){
		echo "<td valign=top class=body background=$imgbackground>";
		}else{
				echo "<td valign=top class=body>";
		}
		echo "<center><table class=toneborder><tr><td class=head><center><b>".$label['running_services']."</b></center></td></tr>" 
		."<tr><td><table border=0>";
		if($show['mysql']==true){
			echo "<tr><td>My Sql:</td><td>";
			$fp = fsockopen ($ip, $port['mysql'], &$errno, &$errstr, 30); 
			if (!$fp) { 
				echo "<font color=\"#FF0000\">".$label['offline'] ."</font>"; 
			} else { 
				echo "<font color=\"#00FF00\">".$label['online'] ."</font>"; 
			}
			echo "</td></tr>";
		}
		if($show['ftp']==true){
			echo "<tr><td>FTP:</td><td>";
			$fp = fsockopen ($ip, $port['ftp'], &$errno, &$errstr, 30); 
			if (!$fp) { 
				echo "<font color=\"#FF0000\">".$label['offline'] ."</font>"; 
			} else { 
				echo "<font color=\"#00FF00\">".$label['online'] ."</font>"; 
			}
			echo "</td></tr>";
		}
		If($show['mail']==true){
			echo "<tr><td>Mail:</td><td>";
			$fp = fsockopen ($ip, $port['mail'], &$errno, &$errstr, 30); 
			if (!$fp) { 
				echo "<font color=\"#FF0000\">".$label['offline'] ."</font>"; 
			} else { 
				echo "<font color=\"#00FF00\">".$label['online'] ."</font>"; 
			}
			echo "</td></tr>";
		}
		If($show['telnet']==true){
			echo "<tr><td>Telnet:</td><td>";
			$fp = fsockopen ($ip, $port['telnet'], &$errno, &$errstr, 30); 
			if (!$fp) { 
				echo "<font color=\"#FF0000\">".$label['offline'] ."</font>"; 
			} else { 
				echo "<font color=\"#00FF00\">".$label['online'] ."</font>"; 
			}
			echo "</td></tr>";
		}
		If($show['pcanywhere']==true){
			echo "<tr><td>Pc Anywhere:</td><td>";
			$fp = fsockopen ($ip, $port['pcanywhere'], &$errno, &$errstr, 30); 
			if (!$fp) { 
				echo "<font color=\"#FF0000\">".$label['offline'] ."</font>"; 
			} else { 
				echo "<font color=\"#00FF00\">".$label['online'] ."</font>"; 
			}
			echo "</td></tr>";
		}
		If($show['fax']==true){
			echo "<tr><td>Active fax:</td><td>";
			$fp = fsockopen ($ip, $port['fax'], &$errno, &$errstr, 30); 
			if (!$fp) { 
				echo "<font color=\"#FF0000\">".$label['offline'] ."</font>"; 
			} else { 
				echo "<font color=\"#00FF00\">".$label['online'] ."</font>"; 
			}
			echo "</td></tr>";
		}
		If($show['news']==true){
			echo "<tr><td>News:</td><td>";
			$fp = fsockopen ($ip, $port['news'], &$errno, &$errstr, 30); 
			if (!$fp) { 
				echo "<font color=\"#FF0000\">".$label['offline'] ."</font>"; 
			} else { 
				echo "<font color=\"#00FF00\">".$label['online'] ."</font>"; 
			}
			echo "</td></tr>";
		}
		If($show['Unreal Tournament']==true){
			echo "<tr><td>Unreal Tournament:</td><td>";
			$fp = fsockopen ($ip, $port['Unreal Tournament'], &$errno, &$errstr, 30); 
			if (!$fp) { 
				echo "<font color=\"#FF0000\">".$label['offline'] ."</font>"; 
			} else { 
				echo "<a href=http://".$HTTP_SERVER_VARS['SERVER_NAME'].":".$port['Unreal Tournament'].">".$HTTP_SERVER_VARS['SERVER_NAME'].":".$port['Unreal Tournament']."</a> <font color=\"#00FF00\"> ".$label['online'] ." </font>"; 
			}
			echo "</td></tr>";
		}
		echo "</table></table></center>";
	};
	echo "</table><br><table class=toneborder><tr><td class=head><center><b>".$label['total_diskspace']." " 
	.$disktotal ." Mb"
	."</b></center></td><td class=head>" 
	."<center><b>".$label['network_statistics']."</b></center>"
	."</td><td class=head><center><b>".$label['memory']." "
	.$totaal_fysiek ." Mb</b></center>" 
	."</td><tr><td>"
	."<table border=0>"
	."<tr><td></td><td>".$label['total']."</td><td>".$label['Value']."</td><td>%</td></tr>"
	."<tr><td>".$label['free_diskspace'].":</td><td><span class=generatedinfo>"
	.$diskfree ."</span> Mb"
	."</td><td>" 
	."<img src=\"$barimg\" height=13 width=$diskfreeprecent ALT=\"".$label['Value']."\">"
	."</td><td>"
	.$diskfreeprecent
	."<br></td></tr><tr><td>".$label['used_diskspace'].":</td><td><span class=generatedinfo>" 
	.$diskusage ."</span> Mb"
	."</td><td>" 
	."<img src=\"$barimg\" height=13 width=$diskusedprecent ALT=\"".$label['Value']."\">"
	."</td><td>"
	.$diskusedprecent
	."</td></tr>" 
	."</table>"
	."</td><td rowspan=2>" 
	."<table border=0>" 
	."<tr><td>"
	."</td></tr><tr><td>&nbsp</td><td>" 
	."</td></tr><tr><td>".$label['total_recieved'].":</td><td><span class=generatedinfo>"
	.$totalrecieve ."</span> Mb"
	."</td></tr><tr><td>".$label['total_sent'].":</td><td><span class=generatedinfo>"
	.$totalsent ."</span> Mb"
	."</td></tr><tr><td>&nbsp</td><td>"
	."</td></tr></table></td><td rowspan=2><table border=0><tr><td></td></tr><tr>"
	."<td></td><td>".$label['total']."</td><td>".$label['Value']."</td><td>%</td></tr>"
	."<tr><td>".$label['free_memory'].":</td><td><span class=generatedinfo>"
	.$beschikbaar_fysiek ."</span> Mb"
	."</td><td>"
	."<img src=\"$barimg\" height=13 width=$beschikbaar_precent ALT=\"".$label['Value']."\">"
	."</td><td>"
	.$beschikbaar_precent
	."</td><td>"
	."</td></tr><tr><td>".$label['used_memory'].":</td><td><span class=generatedinfo>"
	.$gebruikt_fysiek ."</span> Mb"
	."</td><td>"
	."<img src=\"$barimg\" height=13 width=$gebruikt_precent ALT=\"".$label['Value']."\">"
	."</td><td>"
	.$gebruikt_precent
	."</td><td>"
	."</td></tr></table></td></tr></table><br>"
	."<table class=toneborder><tr><td class=head><center><b>".$label['host_info']."</b></center></td></tr>" 
	."<tr><td><table border=0>"
	. "<tr><td>".$label['browser'].":</td><td><span class=generatedinfo>"
	.$HTTP_SERVER_VARS['HTTP_USER_AGENT'];
	if ($show['hostname']==true){	
		echo "</span><br></td></tr><tr><td>".$label['your_hostname'].":</td><td><span class=generatedinfo>"
		.$REMOTE_HOST;
	}
	echo "</span><br></td></tr><tr><td>".$label['your_ip_adres'].":</td><td><span class=generatedinfo>"
	.$HTTP_SERVER_VARS['REMOTE_ADDR'].":".$HTTP_SERVER_VARS['REMOTE_PORT']
	."</span></td></tr></table></td></tr></table><br></center>";
}

// When this page is selected begins here generate the page with php info
else if ($jump_var=="1"){
	phpinfo();
}

// When this page is selected begin here generate the page with network info
else if ($jump_var=="2"){
	$ipconfig = `ipconfig -all`;
	$connections = `netstat -n`;
	echo "<center><table class=toneborder><tr><td class=head><center><b>".$label['network_enviroment']."</b></center></td></tr>" 
	."<tr><td><table border=0><tr><td><pre class=generatedinfo>" 
	.$ipconfig
	."</pre></td></tr></table></td></tr></table><br></center>"
	."<center><table class=toneborder><tr><td class=head><center><b>".$label['network_connections']."</b></center></td></tr>" 
	."<tr><td><table border=0><tr><td><pre class=generatedinfo>" 
	.$connections
	."</pre></td></tr></table></td></tr></table><br></center>";
}

// when this page is selected begins here generate the page with scheduled tasks
else if ($jump_var=="3"){
	$tasks = `at`;
	echo "<center><table class=toneborder><tr><td class=head><center><b>".$label['scheduled_tasks']."</b></center></td></tr>" 
	."<tr><td><table border=0><tr><td><pre class=generatedinfo>" 
	.$tasks
	."</pre></td></tr></table></td></tr></table><br></center>";
}

// When this page is selected begins here generate the page with harddisk details
else if($jump_var=="4"){
	echo "<center><table class=toneborder><tr><td class=head><center><b>".$label['harddisk_details']."</b></center></td></tr>" 
	."<tr><td><table border=0><tr><td>" ."<center>".$label['partition']."</center></td><td><center>".$label['percent_used']."</center></td><td><center>%</center></td><td><center>".$label['free']."</center></td><td><center>".$label['used']."</center></td><td><center>".$label['size']."</center>"
	."</tr><tr><td>C:</td><td>"
	."<img src=\"$barimg\" height=13 width=$diskusedprecentc ALT=\"".$label['Value']."\">"
	."</td><td><p align=right><span class=generatedinfo>$diskusedprecentc</span> %</p></td><td><P ALIGN=right><span class=generatedinfo>"
	.$diskfreec ."</span> Mb</p>"
	."</td><td><P ALIGN=right><span class=generatedinfo>" 
	.$diskusagec ."</span> Mb"
	."</td><td><P ALIGN=right><span class=generatedinfo>"
	.$disktotalc ."</span> Mb</p>";
	if ($disktotald!=""){
		echo "</tr><tr><td>D:</td><td>"
		."<img src=\"$barimg\" height=13 width=$diskusedprecentd ALT=\"".$label['Value']."\">"
		."</td><td><p align=right><span class=generatedinfo>$diskusedprecentd</span> %</p></td><td><P ALIGN=right><span class=generatedinfo>"
		.$diskfreed ."</span> Mb</p>"
		."</td><td><P ALIGN=right><span class=generatedinfo>" 
		.$diskusaged ."</span> Mb</p>"
		."</td><td><P ALIGN=right><span class=generatedinfo>" 
		.$disktotald ."</span> Mb</p>"
		."</td><td>";
	}
	if ($disktotale!=""){
		echo "<tr><td>E:</td><td>"
		."<img src=\"$barimg\" height=13 width=$diskusedprecente ALT=\"".$label['Value']."\">"
		."</td><td><p align=right><span class=generatedinfo>$diskusedprecente</span> %</p></td><td><P ALIGN=right><span class=generatedinfo>"
		.$diskfreee ."</span> Mb</p>"
		."</td><td><P ALIGN=right><span class=generatedinfo>" 
		.$diskusagee ."</span> Mb</p>"
		."</td><td><P ALIGN=right><span class=generatedinfo>" 
		.$disktotale ."</span> Mb</p>"
		."</td><td>";
	}
	if ($disktotalf!=""){
		echo "<tr><td>F:</td><td>"
		."<img src=\"$barimg\" height=13 width=$diskusedprecentf ALT=\"".$label['Value']."\">"
		."</td><td><p align=right><span class=generatedinfo>$diskusedprecentf</span> %</p></td><td><P ALIGN=right><span class=generatedinfo>"
		.$diskfreef ."</span> Mb</p>"
		."</td><td><P ALIGN=right><span class=generatedinfo>" 
		.$diskusagef ."</span> Mb</p>"
		."</td><td><P ALIGN=right><span class=generatedinfo>" 
		.$disktotalf ."</span> Mb</p>"
		."</td><td>";
	}
	if ($disktotalg!=""){
		echo "</tr><tr><td>G:</td><td>"
		."<img src=\"$barimg\" height=13 width=$diskusedprecentg ALT=\"".$label['Value']."\">"
		."</td><td><p align=right><span class=generatedinfo>$diskusedprecentg</span> %</p></td><td><P ALIGN=right><span class=generatedinfo>"
		.$diskfreeg ."</span> Mb</p>"
		."</td><td><P ALIGN=right><span class=generatedinfo>" 
		.$diskusageg ."</span> Mb</p>"
		."</td><td><P ALIGN=right><span class=generatedinfo>" 
		.$disktotalg ."</span> Mb</p>"
		."</td><td";
	}
	echo "</td></tr>" 
	."<tr><td></td><td><td align=right><font size=-1><i>".$label['total']."</i></font></td><td><span class=generatedinfo>"
	.$diskfree ."</span> Mb"
	."</td><td><span class=generatedinfo>"
	.$diskusage ."</span> Mb"
	."</td><td><span class=generatedinfo>"
	.$disktotal ."</span> Mb"
	."</td></tr></table></table><br></center>";
}

// When this page is selected begins here generate the page with the running services
else if($jump_var=="5"){
	$servers= `net start`;
	echo "<center><table class=toneborder><tr><td class=head><center><b>".$label['running_process']."</b></center></td></tr>" 
	."<tr><td><table border=0><tr><td><pre class=generatedinfo>" 
	.$servers
	."</pre></td></tr></table></td></tr></table><br></center>";
}

// When this page is selected begins here generate the page with the loaded device drivers
else if($jump_var=="6"){
	$drivers= `drivers`;
	echo "<center><table class=toneborder><tr><td class=head><center><b>".$label['drivers']."</b></center></td></tr>" 
	."<tr><td><table border=0><tr><td><pre class=generatedinfo>" 
	.$drivers
	."</pre></td></tr></table></td></tr></table><br></center>";
}

// When this page is selected begins here generate the page with apache status
else if($jump_var=="7"){
	$status= fopen("http://localhost/server-status" ,"r");
	$info = fread($status, 20000);
	echo "<center><table class=toneborder><tr><td class=head><center><b>".$label['server_status']."</b></center></td></tr>" 
	."<tr><td><table border=0><tr><td><pre class=generatedinfo>" 
	.$info
	."</pre></td></tr></table></td></tr></table><br></center>";
}

// When this page is selected begins here generate the page with apache info
else if($jump_var=="8"){
	$info= fopen("http://localhost/server-info" ,"r");
	$status = fread($info, 20000);
	echo "<center><table class=toneborder><tr><td class=head><center><b>".$label['server_info']."</b></center></td></tr>" 
	."<tr><td><table border=0><tr><td><pre class=generatedinfo>" 
	.$status
	."</pre></td></tr></table></td></tr></table><br></center>";
}

// The footer for all the pages
if($updatecheck==true){
	if ($Version<$contents){
		echo "<a href=\"http://basmaaks.xs4all.nl\"><img border=\"0\" src=\"images\update_button.gif\" align=\"right\" alt =\"There's is an update available. Just click to go to my homepage and download the latest version\"></a>"; 
	}
}
$update_form = "<form method=\"POST\" action=\"$PHP_SELF\">\n"
			 . "\t" . $label['theme'] . ":&nbsp;\n"
             . "\t<select name=\"template\" class=fields>\n";

$dir = opendir('themes/');
while (($file = readdir($dir))!=false) {
    if ($file != 'CVS' && $file != '.' && $file != '..') {
		$file = ereg_replace('.php', '', $file);
        $update_form .= "\t\t<option value=\"$file\"";
        if ($template == $file) {
            $update_form .= " SELECTED";
        }
        $update_form .= ">$file</option>\n";
    }
}
closedir($dir);

$update_form .= "\t</select>\n";

$update_form .= "\t" . $label['language'] . ":&nbsp;\n"
             . "\t<select name=\"lng\" class=fields>\n";

$dir = opendir('languages/');
while (($file = readdir($dir)) !== false) {
    if ($file != 'CVS' && $file != '.' && $file != '..') {
        $file = ereg_replace('.php', '', $file);
        if ($lng == $file) {
            $update_form .= "\t\t<option value=\"$file\" SELECTED>$file</option>\n";
        } else {
            $update_form .= "\t\t<option value=\"$file\">$file</option>\n";
        }
    }
}
closedir($dir);

$update_form .= "\t</select>\n";

$update_form .= "\t&nbsp;" . $label['document'] . ":&nbsp;\n"
             . "\t<select name=\"jump_var\" class=fields>\n";

$update_form .= "\t\t<option value=0>".$label['mainpage']."</option>\n";
if ($show['php']==true){
	$update_form .= "\t\t<option value=1>".$label['php_enviroment']."</option>\n";
}
if ($show['network']==true){
	$update_form .= "\t\t<option value=2>".$label['network_connections']."</option>\n";
}
if ($show['pagetasks']==true){
	$update_form .= "\t\t<option value=3>".$label['scheduled_tasks']."</option>\n";
}
if ($show['pagedisks']==true){
	$update_form .= "\t\t<option value=4>".$label['harddisk_details']."</option>\n";
}
if ($show['pagerserv']==true){
	$update_form .= "\t\t<option value=5>".$label['running_process']."</option>\n";
}
if ($show['pagedrivers']==true){
	$update_form .= "\t\t<option value=6>".$label['drivers']."</option>\n";
}
if ($show['serverstatus']==true){
	$update_form .= "\t\t<option value=7>".$label['server_status']."</option>\n";
}
if ($show['serverinfo']==true){
	$update_form .= "\t\t<option value=8>".$label['server_info']."</option>\n";
}

$update_form .= "\t</select>\n"
              . "\t<input type=\"submit\" value=\"" . $label['aply'] . "\" class=buttons>\n"
              . "</form>\n";

echo  "<CENTER> $update_form</CENTER>"

?>
<?
require XOOPS_ROOT_PATH."/footer.php";
?>
</BODY>