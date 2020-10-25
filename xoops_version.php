<?php
$modversion['name'] = "Server Info";
$modversion['version'] = "2.1x";
$modversion['description'] = "Server Information";
$modversion['credits'] = "";
$modversion['author'] = "Widowmaker (http://www.tswn.com)";
$modversion['help'] = "manual.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "sysinfo_slogo.gif";
$modversion['dirname'] = "server_info";

//Admin things
$modversion['hasAdmin'] = 0;
$modversion['adminpath'] = "";

// Menu
$modversion['hasMain'] = 1;
// Blocks
$modversion['blocks'][1]['file'] = "gsstats.php";
$modversion['blocks'][1]['name'] = "Server Status";
$modversion['blocks'][1]['description'] = "Shows Server Status";
$modversion['blocks'][1]['show_func'] = "b_server_status_show";

?>