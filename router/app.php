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
        case "_wartung": include($sites . "_wartung.php");  break;
        case "404": include($sites . "404.php");  break;

        //auth
        case "auth_login": include($auth . "login.php");  break;
        case "auth_register": include($auth . "register.php"); break;
        case "auth_logout": setcookie('session_token', null, time(),'/'); header('Location: '.$helper->url().'login'); break;
        case "auth_activate": include($auth . "activate.php"); break;
        case "auth_forgot_password": include($auth . "forgot_password.php"); break;

        //index
        case "dashboard": include($customer . "dashboard.php");  break;
        case "profile": include($customer . "profile.php");  break;
        case "aff_site": include($customer . "aff/site.php");  break;
        case "aff_share": include($customer . "aff/share.php");  break;
        case "daily": include($customer . "daily.php");  break;
        case "getback": include($customer . "getback.php");  break;
        case "aktuelles": include($customer . "aktuelles.php");  break;

        case "server_vweb01": include($sites . "server/vweb01.php");  break;

        case "adventskalender": include($customer . "winter/adventskalender.php");  break;
        case "adventskalender_open": include($customer . "winter/adventskalender_open.php");  break;

        // errors
        case "produkt_ausverkauft": include($sites . "_errors/produkt_ausverkauft.php");  break;
        case "produkt_wartung": include($sites . "_errors/produkt_wartung.php");  break;

        //wiki
        case "wiki_index": include($wiki . "index.php");  break;
        case "wiki_read": include($wiki . "read.php");  break;

        //accounting
        case "accounting_charge": include($customer . "accounting/charge.php");  break;
        case "accounting_donate": include($customer . "accounting/donate.php");  break;
        case "accounting_transactions": include($customer . "accounting/transactions.php");  break;
        case "accounting_invoice": include($customer . "accounting/invoice.php");  break;

        //support
        case "tickets": include($customer . "support/tickets.php");  break;
        case "ticket": include($customer . "support/ticket.php");  break;
        case "support": include($customer . "support/index.php");  break;

        //webspace
        case "order_webspace": include($customer . "webspace/order.php");  break;
        case "order_webspace_nld": include($customer . "webspace/order_nld.php");  break;
        case "order_webspace_nld_bw": include($customer . "webspace/order_nld_bw.php");  break;
        case "manage_webspaces": include($customer . "webspace/index.php");  break;
        case "manage_webspace": include($customer . "webspace/manage.php");  break;
        case "renew_webspace": include($customer . "webspace/renew.php");  break;

        case "order_webspace_nld_jahr": include($customer . "webspace/order_nld_jahr.php");  break;
        case "renew_webspace_jahr": include($customer . "webspace/renew_jahr.php");  break;

        case "order_webspace_resellernld": include($customer . "webspace/order_resellernld.php");  break;
        case "manage_rs_webspaces": include($customer . "webspace/index_rs.php");  break;
        case "manage_rs_webspace": include($customer . "webspace/manage_rs.php");  break;
        case "renew_rs_webspace": include($customer . "webspace/renew_rs.php");  break;

        //domains
        case "order_domain": include($customer . "domain/order.php");  break;
        case "manage_domains": include($customer . "domain/index.php");  break;
        case "manage_domain": include($customer . "domain/manage.php");  break;
        case "renew_domain": include($customer . "domain/renew.php");  break;
        case "domain_marktplatz": include($customer . "domain/domain-marktplatz.php");  break;

        //KVM
        //case "order_kvmipv6": include($customer . "kvm-ipv6/order.php");  break;
        //case "manage_kvmipv6s": include($customer . "kvm-ipv6/index.php");  break;
        //case "manage_kvmipv6": include($customer . "kvm-ipv6/manage.php");  break;
        //case "renew_kvmipv6": include($customer . "kvm-ipv6/renew.php");  break;

        case "order_kvm": include($customer . "kvm/order.php");  break;
        case "order_kvm_pakete": include($customer . "kvm/order_pakete.php");  break;
        case "manage_kvms": include($customer . "kvm/index.php");  break;
        case "manage_kvm": include($customer . "kvm/manage.php");  break;
        case "renew_kvm": include($customer . "kvm/renew.php");  break;

        //SINUSBOT
        case "order_sinusbot": include($customer . "sinusbot/order.php");  break;
        case "manage_sinusbots": include($customer . "sinusbot/index.php");  break;
        case "manage_sinusbot": include($customer . "sinusbot/manage.php");  break;
        case "renew_sinusbot": include($customer . "sinusbot/renew.php");  break;

        //gameserver
        case "order_gameserver": include($customer . "gameserver/order.php");  break;

        case "order_gameserver_mc": include($customer . "gameserver/minecraft/order.php");  break;
        case "manage_gameservers_mc": include($customer . "gameserver/minecraft/index.php");  break;
        case "manage_gameserver_mc": include($customer . "gameserver/minecraft/manage.php");  break;
        case "renew_gameserver_mc": include($customer . "gameserver/minecraft/renew.php");  break;

        case "order_gameserver_csgo": include($customer . "gameserver/csgo/order.php");  break;
        case "manage_gameservers_csgo": include($customer . "gameserver/csgo/index.php");  break;
        case "manage_gameserver_csgo": include($customer . "gameserver/csgo/manage.php");  break;
        case "renew_gameserver_csgo": include($customer . "gameserver/csgo/renew.php");  break;

        case "order_gamecloud": include($customer . "gamecloud/order.php");  break;
        case "manage_gameclouds": include($customer . "gamecloud/index.php");  break;
        case "manage_gamecloud": include($customer . "gamecloud/manage.php");  break;
        case "renew_gamecloud": include($customer . "gamecloud/renew.php");  break;

        //nextcloud
        case "order_nextcloud": include($customer . "nextcloud/order.php");  break;
        case "order_nextcloud_pakete": include($customer . "nextcloud/order_pakete.php");  break;
        case "order_nextcloud_konfigurator": include($customer . "nextcloud/order_konfigurator.php");  break;
        case "manage_nextcloud": include($customer . "nextcloud/manage.php");  break;
        case "manage_nextclouds": include($customer . "nextcloud/index.php");  break;
        case "renew_nextcloud": include($customer . "nextcloud/renew.php");  break;

        //marktplatz
        case "order_marktplatz": include($customer . "marktplatz/order.php");  break;
        case "order_marktplatz_dedicated": include($customer . "marktplatz/order_dedicated.php");  break;
        case "order_marktplatz_dedicated_upgrades": include($customer . "marktplatz/order_dedicated_upgrades.php");  break;
        case "order_marktplatz_kvm": include($customer . "marktplatz/order_kvm.php");  break;
        case "manage_marktplatz": include($customer . "marktplatz/manage.php");  break;
        case "manage_marktplatzs": include($customer . "marktplatz/index.php");  break;
        case "renew_marktplatz": include($customer . "marktplatz/renew.php");  break;
        case "zusatz_marktplatz": include($customer . "marktplatz/zusatzpakete.php");  break;

        //system
        case "worker_queue": include(BASE_PATH . "app/crone/work_queue.php");  break;
        case "runtime_queue": include(BASE_PATH . "app/crone/runtime_queue.php");  break;
        case "get_load": include(BASE_PATH . "app/ajax/get_load.php");  break;
        case "traffic_queue": include(BASE_PATH . "app/crone/traffic_queue.php");  break;
        case "dsgvo": include($resources . "customer/dsgvo.php");  break;
        case "crone_daily": include(BASE_PATH . "app/crone/daily.php");  break;

        //debug
        case "DEBUG": include(BASE_PATH . "DEBUG/index.php");  break;

        //
        case "impressum": include($sites."impressum.php");  break;
        case "datenschutz": include($sites."datenschutz.php");  break;
        case "agb": include($sites."agb.php");  break;

        //api
        case "api_v1_discord": include(BASE_PATH."resources/api/index_discord.php");  break;

        //team
        case "team_tickets": include($team."support/tickets.php");  break;
        case "team_ticket": include($team."support/ticket.php");  break;
        case "team_users": include($team."user/users.php");  break;
        case "team_user": include($team."user/user.php");  break;
        case "team_spin_login": include($team."user/s_pin_login.php");  break;
        case "team_login_back": include($team."login_back.php");  break;
        case "team_transactions": include($team."transactions.php");  break;
        case "team_user_transactions": include($team."user_transactions.php");  break;
        case "team_system": include($team."system.php");  break;
        case "team_ipam": include($team."ip_manager.php");  break;
        case "team_orders": include($team."orders/list.php");  break;
        case "team_order": include($team."orders/manage.php");  break;
        case "team_code_list": include($team."codes/list.php");  break;

        case "team_produkte_webserver": include($team."produkte/webserver.php");  break;
        case "team_produkte_webserver_rs": include($team."produkte/webserver-reseller.php");  break;
        case "team_produkte_marktplatz": include($team."produkte/marktplatz.php");  break;
        case "team_produkte_cloudserver": include($team."produkte/cloudserver.php");  break;
        case "team_produkte_gameservermc": include($team."produkte/gameserver_mc.php");  break;
        case "team_produkte_kvmipv6": include($team."produkte/kvm-ipv6.php");  break;
        case "team_produkte_kvmserver": include($team."produkte/kvm-server.php");  break;
        case "team_produkte_sinusbot": include($team."produkte/sinusbot.php");  break;

    }

    if(strpos($currPage,'system_') !== false || strpos($currPage,'_hidelayout') !== false) {} else {
        include BASE_PATH.'/resources/additional/footer.php';
    }

} else {
    die('please enable .htaccess on your server');
}