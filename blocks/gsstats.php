<?php
function b_system_stats_show()
{
    global $xoopsDB;
    $block = [];
    $block['title'] = 'Server Stats';
    require XOOPS_ROOT_PATH . '/modules/server_info/gs_stats.php';

    return $block;
}
?>
