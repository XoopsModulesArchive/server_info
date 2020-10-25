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





		If($show['Mechwarrior 4']==true){
			echo "<tr><td>Mechwarrior 4:</td><td>";
			$fp = fsockopen ($ip, $port['Mechwarrior 4'], &$errno, &$errstr, 30); 
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
?>