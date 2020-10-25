<?
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


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//This script was modified by Tim Lunceford, The Spider Web Network.  If you have any questions concerning this module, please consult our forum for help
//http://www.tswn.com
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");    

setcookie("template", $template, (time() + 2592000));

// Ask for the config.php file with al the settings
require "config.php";


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
	
	//generate the general first html page and send it to the browser
///////////////////////////////////////////////////////////////////////This area defines the server online script for your web page.  
///////////////////////////////////////////////////////////////////////Change the settings below to your ip address' and port numbers if required.//////
	If ($show['services']==true) {
		if ($usebackground==true){
		}else{
		}
		echo "<b><center>Servers Online</center></b><p>";
		
		If($show['Mechwarrior 4']==true){
			echo "<center><small>!!=(T.S.W.N. Black Widow)=!!  </center></small>\n";//Change this title to whatever you want.  Do this on any of the following server instances.
                  echo "<small><center>Mechwarrior 4 Vengeance</center></small>\n";
			$fp = fsockopen ($ip="192.168.1.10", $port['Mechwarrior 4 Vengeance'], &$errno, &$errstr, 30);// Change this to your server's ip address, or if the server is hosted on the same machine as this script, you can substite it with localhost
			if (!$fp) { 
				echo "<center><img src=../server_info/bw_offline.gif></center>"; //Modify this with whatever image you want displayed for the server online graphic that is displayed.  A good rule of thumb is to make it 120px wide.
			} else { 
				echo "<center><img src=../server_info/bw_online.gif></center>"; //Modify this with whatever image you want displayed for the server offline graphic that is displayed.  A good rule of thumb is to make it 120px wide.

			}
			echo "<p>";
                  //echo "</table></table></center>";
		}
		If($show['Mechwarrior 4']==true){
			echo "<center><small>!!=(T.S.W.N. Black Widow)=!!  </center></small>\n";
                  echo "<small><center>Mechwarrior 4 Black Knight</center></small>\n";
			$fp = fsockopen ($ip="192.168.1.10", $port['Mechwarrior 4 Black Knight'], &$errno, &$errstr, 30);
			if (!$fp) { 
				echo "<center><img src=../server_info/bw_offline.gif></center>"; 
			} else { 
				echo "<center><img src=../server_info/bw_online.gif></center>"; 
			}
			echo "<p>";
                  //echo "</table></table></center>";
		}
		If($show['Mechwarrior 4']==true){
			echo "<center><small>!!=(T.S.W.N. Black Widow)=!!  </center></small>\n";
                  echo "<small><center>Mechwarrior 4 Mercs</center></small>\n";
			$fp = fsockopen ($ip="192.168.1.10", $port['Mechwarrior 4 Mercs'], &$errno, &$errstr, 30);
			if (!$fp) { 
				echo "<center><img src=../server_info/bw_offline.gif></center>"; 
			} else { 
				echo "<center><img src=../server_info/bw_online.gif></center>"; 
			}
			echo "<p>";
                  //echo "</table></table></center>";
		}
		If($show['Mechwarrior 4']==true){
			echo "<center><small>!!=(T.S.W.N. Wolf Spider)=!!  </center></small>\n";
                  echo "<small><center>Mechwarrior 4</center></small>\n";
			$fp = fsockopen ($ip="68.102.62.106", $port['Mechwarrior 4 Vengeance'], &$errno, &$errstr, 30);
			if (!$fp) { 
				echo "<center><img src=../server_info/ws_offline.gif></center>"; 
			} else { 
				echo "<center><img src=../server_info/ws_online.gif></center>"; 
			}
			echo "<p>";
                  //echo "</table></table></center>";
		}
		If($show['Mechwarrior 4']==true){
			echo "<center><small>!!=(T.S.W.N. Wolf Spider)=!!  </center></small>\n";
                  echo "<small><center>Mechwarrior 4 Black Knight</center></small>\n";
			$fp = fsockopen ($ip="68.102.62.106", $port['Mechwarrior 4 Black Knight'], &$errno, &$errstr, 30);
			if (!$fp) { 
				echo "<center><img src=../server_info/ws_offline.gif></center>"; 
			} else { 
				echo "<center><img src=../server_info/ws_online.gif></center>"; 
			}
			echo "<p>";
                  //echo "</table></table></center>";
		}
		If($show['Mechwarrior 4']==true){
			echo "<center><small>!!=(T.S.W.N. Wolf Spider)=!!  </center></small>\n";
                  echo "<small><center>Mechwarrior 4 Mercs</center></small>\n";
			$fp = fsockopen ($ip="68.102.62.106", $port['Mechwarrior 4 Mercs'], &$errno, &$errstr, 30);
			if (!$fp) { 
				echo "<center><img src=../server_info/ws_offline.gif></center>"; 
			} else { 
				echo "<center><img src=../server_info/ws_online.gif></center>"; 
			}
			echo "<p>";
                  //echo "</table></table></center>";
		}
		If($show['Unreal Tournament']==true){
			echo "<center><small>!!=(T.S.W.N. Black Widow)=!!  </center></small>\n";
                  echo "<small><center>Unreal Tournament 2003  </center></small>\n";
			$fp = fsockopen ($ip="192.168.1.10", $port['Unreal Tournament'], &$errno, &$errstr, 30);
			if (!$fp) { 
				echo "<font color=\"999999\"><b>".$label['offline'] ."</font></b>\n";
			} else { 
				echo "<img src=../server_info/server_online.gif>"; 
			}
			echo "<p>";
                  //echo "</table></table></center>";
		}
            If($show['Team Speak']==true){
                  echo "<center><small>!!=(T.S.W.N. Wolf Spider)=!!  </center></small>\n";
			echo "<center><small>Teamspeak Chat Server  </center></small>\n";
			$fp = fsockopen ($ip="68.102.62.106", $port['Team Speak'], &$errno, &$errstr, 30);
			if (!$fp) { 
				echo "<center><img src=../server_info/ts_server_offline.gif></center>"; 
			} else { 
				echo "<center><a href=http://www.tswn.com/modules/teamspeak/listing.php><img src=../server_info/ts_server_online.gif></a></center>";
                        echo "<center><br><small>Click Image</small></center>\n"; 
			}
			echo "<p>";
                  //echo "</table></table></center>";
		}

            If($show['Team Speak']==true){
                  echo "<center><small>!!=(T.S.W.N. Black Widow)=!!  </center></small>\n";
			echo "<center><small>Teamspeak Chat Server  </center></small>\n";
			$fp = fsockopen ($ip="192.168.1.11", $port['Team Speak'], &$errno, &$errstr, 30);
			if (!$fp) { 
				echo "<center><img src=../server_info/ts_server_offline.gif></center>"; 
			} else { 
				echo "<center><a href=http://www.tswn.com/modules/teamspeak/listing.php><img src=../server_info/ts_server_online.gif></a></center>";
                        echo "<center><br><small>Click Image</small></center>\n"; 
			}
			echo "<p>";
                  //echo "</table></table></center>";
		}

		
	};
	
	}


?>