<?
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
												$Version="3.1";
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

//  The latest version is always availble at http://basmaaks.xs4all.nl
//  You'll need php version 4.1.0 or above to get it all running.
//  Mail me for any questions at the_gamblers@basmaaks.xs4all.nl or post a message

// Secure this page so you need to login. Value can be true or false

///////////////////////////////////////////////////////////////////////////////////////
//This script was modified by Tim Lunceford, The Spider Web Network.
//For any questions concerning this script modifications, please consult our web site.
//http://www.tswn.com
//
//
//
///////////////////////////////////////////////////////////////////////////////////////
$securesite=false;

$infotext           ="sysinfo "; // The text that's displayed in the logon window
$loginname          ="sysinfo";  // The login name for the secured page
$password           ="admin";    // The password for the secured page

// Check if there's an update available
$updatecheck=true;

// The location of the pagefile.sys. Windowsdefault is c:\
$pagefile = "c:\pagefile.sys";

// The default language and theme for this page
$defaultlang="english"; // The Language
$defaulttheme="default"; // The theme

// Show the hostname of the visitor. Value can be true or false
$show['hostname']    =true;

// Show running servers like Mail, pc anywhere . Value can be true or false.
$show['services']    =true;

// The different servers to choose when the above one is true
///////////////////////////////////change these to what ever servers you plan on monitoring.  The true/false statement defines whether or not that server is monitored./////////////////////////////////////////
$show['fax']         =false;																	     
$show['news']        =false;																	     
$show['mysql']       =true;																	     
$show['ftp']         =true; 																	     																	     /
$show['mail']        =true;
$show['telnet']      =false;
$show['pcanywhere']  =true;
$show['Mechwarrior 4']  =true;
$show['Unreal Tournament']  =true;
$show['Team Speak']  =true;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 
///////////////////////////////////////THIS DEFINES THE PORTS OF THE SERVERS LISTED ABOVE, CHANGE THEM TO WHATEVER PORT CORRESPONDS WITH YOUR SERVER/////////////
$port['fax']         ="25017";
$port['news']        ="119";
$port['mysql']       ="3306";
$port['ftp']         ="21";
$port['mail']        ="25";
$port['telnet']      ="19";
$port['pcanywhere']  ="5631";
$port['Unreal Tournament']  ="8888";
$port['Team Speak']  ="51234";
$port['Mechwarrior 4 Mercs']  ="2300";
$port['Mechwarrior 4 Vengeance']  ="28806"; 
$port['Mechwarrior 4 Black Knight']  ="28805";
$port['Mechwarrior 4 Mercs 2']  ="27999";   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Choose here wich pages will be accesible
$show['pagedisks']   =true; // The page with harddiskdetail
$show['pagetasks']   =true; // The page with listed tasks
$show['pagerserv']   =true; // The page with running services
$show['pagedrivers'] =true; // The page with loaded drivers
$show['network']     =true; // The page with network enviroment
$show['php']		 =true; // The page with the php details
$show['serverstatus']  =true; // The page with apache server status
$show['serverinfo']	 =true; // The page with apache server info
//////////////////////////////////////THESE ARE VARIABLES CARRIED OVER TO YOUR STATUS PAGE//////////////////////////////////////////////////
$ip['teamspeak'] ="68.102.62.106";
$ip['wolfspider mw4'] ="68.102.62.106";
$ip['blackwidow mw4'] ="192.168.1.10";
$ip['blackwidow ut2k3'] ="192.168.1.10";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>