<?php

/*
 * page manager
 */
$resources = BASE_PATH.'resources/';
$sites = $resources.'sites/';
$wiki = $resources.'sites/wiki/';
$auth = $resources.'auth/';
$customer = $resources.'customer/';
$team = $resources.'team/';
$page = $helper->protect($_GET['page']);

if(isset($_GET['page'])) {
    switch ($page) {

        default: include($sites . "404.php");  break;
        case $page: include($sites . "404.php");  break;

    }

    if(strpos($currPage,'system_') !== false || strpos($currPage,'_hidelayout') !== false) {} else {
        include BASE_PATH.'/resources/additional/footer.php';
    }

} else {
    die('please enable .htaccess on your server');
}