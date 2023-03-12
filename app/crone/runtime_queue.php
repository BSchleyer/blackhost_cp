<?php
$currPage = 'system_runtime queue';
include BASE_PATH.'app/controller/PageController.php';

//Time now
$date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$dateTimeNow = $date->format('Y-m-d H:i:s');

//Time minus 3 days
$dateMinus = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$dateMinus->modify('-3 day');
$dateTimeMinus3Days = $dateMinus->format('Y-m-d H:i:s');

//Time plus 3 days
$datePlus = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$datePlus->modify('+3 day');
$dateTimePlus3Days = $datePlus->format('Y-m-d H:i:s');

$key = $helper->protect($_GET['key']);
if($key == env('CRONE_KEY')){

    /* ======================================================================================================================================== */
    $vmserversEmail = $db->prepare("SELECT * FROM `vm_servers` WHERE `deleted_at` IS NULL");
    $vmserversEmail->execute();
    if ($vmserversEmail->rowCount() != 0) {
        while ($row = $vmserversEmail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['user_id'],'mail_runtime')) {
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if ($diffInDays != $row['days']) {

                    if ($diffInDays == 3) {
                        $product_name = 'vServer';
                        include BASE_PATH . 'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['user_id'], 'email'), $user->getDataById($row['user_id'], 'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `vm_servers` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $vmserversDB = $db->prepare("SELECT * FROM `vm_servers` WHERE `expire_at` < :dateTimeNow AND `state` = 'ACTIVE' AND `type` = 'LXC'");
    $vmserversDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($vmserversDB->rowCount() != 0) {
        while ($row = $vmserversDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `vm_servers` SET `state`='SUSPENDED' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

            try {
                $lxc->shutdown($row['node_id'], $row['id']);
            }catch (Exception $e){
                //echo $e->getMessage();
            }

            echo 'Suspended vServer #'.$row['id'];

        }
    }
    $vmserversSuspendedDB = $db->prepare("SELECT * FROM `vm_servers` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'SUSPENDED' AND `type` = 'LXC'");
    $vmserversSuspendedDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($vmserversSuspendedDB->rowCount() != 0) {
        while ($row = $vmserversSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `vm_servers` SET `state`='DELETED', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

            $SQL3 = $db->prepare("SELECT * FROM `ip_addresses` WHERE `service_id` = :service_id");
            $SQL3->execute(array(":service_id" => $row['id']));
            if ($SQL3->rowCount() != 0) {
                while ($row3 = $SQL3->fetch(PDO::FETCH_ASSOC)) {

                    $ip_name = str_replace(".", "-", $row3['ip']);
                    $rdns = $ip_name.'ipv4.sedv-route.customer.schleyer.network';
                    $venocix->setRDNS($row3['ip'],$rdns);

                    $SQL4 = $db->prepare("UPDATE `ip_addresses` SET `rdns` = :rdns WHERE `ip` = :ip");
                    $SQL4->execute(array(':rdns' => $rdns, ':ip' => $row3['ip']));

                }
            }
			
			$SQL2 = $db->prepare("UPDATE `ip_addresses` SET `service_id` = NULL, `service_type` = NULL WHERE `service_id` = :id");
            $SQL2->execute(array(":id" => $row['id']));

            try {
               echo $lxc->shutdown($row['node_id'], $row['id']);
            }catch (Exception $e){
                echo $e->getMessage();
            }

            sleep(1);

            try {
                echo $lxc->deleteServer($row['node_id'], $row['id']);
            }catch (Exception $e){
                echo $e->getMessage();
            }

            echo 'Deleted vServer #'.$row['id'];

        }
    }
	
	
    $vmserversDB2 = $db->prepare("SELECT * FROM `vm_servers` WHERE `expire_at` < :dateTimeNow AND `state` = 'ACTIVE' AND `type` = 'KVM'");
    $vmserversDB2->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($vmserversDB2->rowCount() != 0) {
        while ($row = $vmserversDB2->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `vm_servers` SET `state`='SUSPENDED' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

            try {
                $kvm->shutdown($row['node_id'], $row['id']);
            }catch (Exception $e){
                //echo $e->getMessage();
            }

            echo 'Suspended vServer #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    /* ======================================================================================================================================== */
    $webspaceEmail = $db->prepare("SELECT * FROM `webspace` WHERE `deleted_at` IS NULL");
    $webspaceEmail->execute();
    if ($webspaceEmail->rowCount() != 0) {
        while ($row = $webspaceEmail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['user_id'],'mail_runtime')){
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if($diffInDays != $row['days']){

                    if($diffInDays == 3){
                        $product_name = 'Webspace';
                        include BASE_PATH.'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['user_id'],'email'), $user->getDataById($row['user_id'],'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `webspace` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $webspaceDB = $db->prepare("SELECT * FROM `webspace` WHERE `expire_at` < :dateTimeNow AND `state` = 'active'");
    $webspaceDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($webspaceDB->rowCount() != 0) {
        while ($row = $webspaceDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `webspace` SET `state`='suspended' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));


            if($row['ftp_name'] != 'nothing') {
                try {
                    $plesk->suspend($row['webspace_id']);
                } catch (Exception $e){

                }
            } else {
                try {
                    $keyhelp->suspendUser($user->getDataById($row['user_id'], 'keyhelp_uuid'));
                } catch (Exception $e){

                }
            }

			$discord->callWebhook('<@&874784920332017715> Ein Webserver wurde gesperrt! #'.$row['id']);
            echo 'Suspended Webspace #'.$row['id'];

        }
    }

    $webspaceSuspendedDB = $db->prepare("SELECT * FROM `webspace` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'suspended'");
    $webspaceSuspendedDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($webspaceSuspendedDB->rowCount() != 0) {
        while ($row = $webspaceSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `webspace` SET `state`='deleted', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

            if($row['ftp_name'] != 'nothing') {
                try {
                    $plesk->delete($row['webspace_id']);
                } catch (Exception $e){}
            } else {
                try {
                    $keyhelp->deleteUser($user->getDataById($row['user_id'], 'keyhelp_uuid'));
                } catch (Exception $e){}

                $update = $db->prepare("UPDATE `users` SET `keyhelp_uuid` = NULL, `keyhelp_username` = NULL, `keyhelp_password` = NULL WHERE `id` = :id");
                $update->execute(array(":id" => $row['user_id']));
            }

			$discord->callWebhook('<@&874784920332017715> Ein Webserver wurde gelöscht! #'.$row['id']);
            echo 'Deleted Webspace #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    /* ======================================================================================================================================== */

    $mcEmail = $db->prepare("SELECT * FROM `gameserver_mc` WHERE `deleted_at` IS NULL");
    $mcEmail->execute();
    if ($mcEmail->rowCount() != 0) {
        while ($row = $mcEmail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['user_id'],'mail_runtime')){
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if($diffInDays != $row['days']){

                    if($diffInDays == 3){
                        $product_name = 'Gameserver';
                        include BASE_PATH.'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['user_id'],'email'), $user->getDataById($row['user_id'],'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `gameserver_mc` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $mcDB = $db->prepare("SELECT * FROM `gameserver_mc` WHERE `expire_at` < :dateTimeNow AND `state` = 'active'");
    $mcDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($mcDB->rowCount() != 0) {
        while ($row = $mcDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `gameserver_mc` SET `state`='suspended' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Ein Minecraft Server wurde gesperrt! #'.$row['id']);
            echo 'Suspended MC #'.$row['id'];

        }
    }

    $mcSuspendedDB = $db->prepare("SELECT * FROM `gameserver_mc` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'suspended'");
    $mcSuspendedDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($mcSuspendedDB->rowCount() != 0) {
        while ($row = $mcSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `gameserver_mc` SET `state`='deleted', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Ein Minecraft Server wurde gelöscht! #'.$row['id']);
            echo 'Deleted MC #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    /* ======================================================================================================================================== */

    $gcEmail = $db->prepare("SELECT * FROM `gamecloud_clouds` WHERE `deleted_at` IS NULL");
    $gcEmail->execute();
    if ($gcEmail->rowCount() != 0) {
        while ($row = $gcEmail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['user_id'],'mail_runtime')){
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if($diffInDays != $row['days']){

                    if($diffInDays == 3){
                        $product_name = 'Gamecloud';
                        include BASE_PATH.'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['user_id'],'email'), $user->getDataById($row['user_id'],'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `gamecloud_clouds` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $gcDB = $db->prepare("SELECT * FROM `gamecloud_clouds` WHERE `expire_at` < :dateTimeNow AND `state` = 'active'");
    $gcDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($gcDB->rowCount() != 0) {
        while ($row = $gcDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `gamecloud_clouds` SET `state`='suspended' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Eine Gamecloud wurde gesperrt! #'.$row['id']);
            echo 'Suspended GAMECLOUD #'.$row['id'];

        }
    }

    $gcSuspendedDB = $db->prepare("SELECT * FROM `gamecloud_clouds` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'suspended'");
    $gcSuspendedDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($gcSuspendedDB->rowCount() != 0) {
        while ($row = $gcSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `gamecloud_clouds` SET `state`='deleted', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Eine Gamecloud wurde gelöscht! #'.$row['id']);
            echo 'Deleted GAMECLOUD #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    /* ======================================================================================================================================== */

    $sinusMail = $db->prepare("SELECT * FROM `sinusbots` WHERE `deleted_at` IS NULL");
    $sinusMail->execute();
    if ($sinusMail->rowCount() != 0) {
        while ($row = $sinusMail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['user_id'],'mail_runtime')){
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if($diffInDays != $row['days']){

                    if($diffInDays == 3){
                        $product_name = 'SinusBot';
                        include BASE_PATH.'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['user_id'],'email'), $user->getDataById($row['user_id'],'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `sinusbots` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $sinusDB = $db->prepare("SELECT * FROM `sinusbots` WHERE `expire_at` < :dateTimeNow AND `state` = 'active'");
    $sinusDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($sinusDB->rowCount() != 0) {
        while ($row = $sinusDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `sinusbots` SET `state`='suspended' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Ein SinusBot wurde gesperrt! #'.$row['id']);
            echo 'Suspended MC #'.$row['id'];

        }
    }

    $sinusSuspendDB = $db->prepare("SELECT * FROM `sinusbots` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'suspended'");
    $sinusSuspendDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($sinusSuspendDB->rowCount() != 0) {
        while ($row = $sinusSuspendDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `sinusbots` SET `state`='deleted', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Ein SinusBot wurde gelöscht! #'.$row['id']);
            echo 'Deleted MC #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    /* ======================================================================================================================================== */

    $webspaceEmail = $db->prepare("SELECT * FROM `webspace_rs` WHERE `deleted_at` IS NULL");
    $webspaceEmail->execute();
    if ($webspaceEmail->rowCount() != 0) {
        while ($row = $webspaceEmail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['user_id'],'mail_runtime')){
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if($diffInDays != $row['days']){

                    if($diffInDays == 3){
                        $product_name = 'Webspace';
                        include BASE_PATH.'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['user_id'],'email'), $user->getDataById($row['user_id'],'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `webspace_rs` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $webspaceDB = $db->prepare("SELECT * FROM `webspace_rs` WHERE `expire_at` < :dateTimeNow AND `state` = 'active'");
    $webspaceDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($webspaceDB->rowCount() != 0) {
        while ($row = $webspaceDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `webspace_rs` SET `state`='suspended' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Ein Reseller-Webserver wurde gesperrt! #'.$row['id']);
            echo 'Suspended Webspace #'.$row['id'];

        }
    }

    $webspaceSuspendedDB = $db->prepare("SELECT * FROM `webspace_rs` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'suspended'");
    $webspaceSuspendedDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($webspaceSuspendedDB->rowCount() != 0) {
        while ($row = $webspaceSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `webspace_rs` SET `state`='deleted', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Ein Reseller-Webserver wurde gelöscht! #'.$row['id']);
            echo 'Deleted Webspace #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    /* ======================================================================================================================================== */

    $cloudEmail = $db->prepare("SELECT * FROM `cloudserver` WHERE `deleted_at` IS NULL");
    $cloudEmail->execute();
    if ($cloudEmail->rowCount() != 0) {
        while ($row = $cloudEmail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['user_id'],'mail_runtime')){
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if($diffInDays != $row['days']){

                    if($diffInDays == 3){
                        $product_name = 'Cloudserver';
                        include BASE_PATH.'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['user_id'],'email'), $user->getDataById($row['user_id'],'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `cloudserver` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $cloudDB = $db->prepare("SELECT * FROM `cloudserver` WHERE `expire_at` < :dateTimeNow AND `state` = 'active'");
    $cloudDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($cloudDB->rowCount() != 0) {
        while ($row = $cloudDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `cloudserver` SET `state`='suspended' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Eine Nextcloud wurde gesperrt! #'.$row['id']);
            echo 'Suspended Nextcloud #'.$row['id'];

        }
    }

    $cloudSuspendedDB = $db->prepare("SELECT * FROM `cloudserver` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'suspended'");
    $cloudSuspendedDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($cloudSuspendedDB->rowCount() != 0) {
        while ($row = $cloudSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `cloudserver` SET `state`='deleted', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Eine Nextcloud wurde gelöscht! #'.$row['id']);
            echo 'Deleted Nextcloud #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    /* ======================================================================================================================================== */

    $kvmEmail = $db->prepare("SELECT * FROM `kvm` WHERE `deleted_at` IS NULL");
    $kvmEmail->execute();
    if ($kvmEmail->rowCount() != 0) {
        while ($row = $kvmEmail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['vt_ownerid'],'mail_runtime')){
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if($diffInDays != $row['days']){

                    if($diffInDays == 3){
                        $product_name = 'KVM-Server';
                        include BASE_PATH.'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['vt_ownerid'],'email'), $user->getDataById($row['vt_ownerid'],'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `kvm` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $kvmDB = $db->prepare("SELECT * FROM `kvm` WHERE `expire_at` < :dateTimeNow AND `state` = 'active'");
    $kvmDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($kvmDB->rowCount() != 0) {
        while ($row = $kvmDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `kvm` SET `state`='suspended' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Ein KVM-Server wurde gesperrt! #'.$row['id']);
            echo 'Suspended Nextcloud #'.$row['id'];

        }
    }

    $kvmSuspendedDB = $db->prepare("SELECT * FROM `kvm` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'suspended'");
    $kvmSuspendedDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($kvmSuspendedDB->rowCount() != 0) {
        while ($row = $kvmSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `kvm` SET `state`='deleted', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

			$discord->callWebhook('<@&874784920332017715> Ein KVM-Server wurde gelöscht! #'.$row['id']);
            echo 'Deleted Nextcloud #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    /* ======================================================================================================================================== */
    $teamspeakEmail = $db->prepare("SELECT * FROM `teamspeaks` WHERE `deleted_at` IS NULL");
    $teamspeakEmail->execute();
    if ($teamspeakEmail->rowCount() != 0) {
        while ($row = $teamspeakEmail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['user_id'],'mail_runtime')) {
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if ($diffInDays != $row['days']) {

                    if ($diffInDays == 3) {
                        $product_name = 'Teamspeak';
                        include BASE_PATH . 'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['user_id'], 'email'), $user->getDataById($row['user_id'], 'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `teamspeaks` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $teamspeakDB = $db->prepare("SELECT * FROM `teamspeaks` WHERE `expire_at` < :dateTimeNow AND `state` = 'ACTIVE'");
    $teamspeakDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($teamspeakDB->rowCount() != 0) {
        while ($row = $teamspeakDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `teamspeaks` SET `state`='SUSPENDED' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

            try {
                $ts3->stopServer($row['node_id'], $row['teamspeak_port'], $row['sid']);
                $discord->callWebhook('Teamspeak wurde automatisch gestoppt (SUSPEND)');
            } catch (Exception $e){

            }

            echo 'Suspended Teamspeak #'.$row['id'];
        }
    }

    $teamspeakSuspendedDB = $db->prepare("SELECT * FROM `teamspeaks` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'SUSPENDED'");
    $teamspeakSuspendedDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($teamspeakSuspendedDB->rowCount() != 0) {
        while ($row = $teamspeakSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `teamspeaks` SET `state`='DELETED', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

            try {
                $ts3->deleteServer($row['node_id'], $row['sid']);
                $discord->callWebhook('Teamspeak wurde automatisch gestoppt (DELETE)');
            } catch (Exception $e){

            }

            echo 'Deleted Teamspeak #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    /* ======================================================================================================================================== */
    $webspaceEmail = $db->prepare("SELECT * FROM `pterodactyl_servers` WHERE `deleted_at` IS NULL");
    $webspaceEmail->execute();
    if ($webspaceEmail->rowCount() != 0) {
        while ($row = $webspaceEmail->fetch(PDO::FETCH_ASSOC)) {

            if($user->getDataById($row['user_id'],'mail_runtime')){
                $diffInDays = $site->getDiffInDays($row['expire_at']);
                if($diffInDays != $row['days']){

                    if($diffInDays == 3){
                        $product_name = 'Gameserver';
                        include BASE_PATH.'app/notifications/mail_templates/product/runout.php';
                        $mail_state = sendMail($user->getDataById($row['user_id'],'email'), $user->getDataById($row['user_id'],'username'), $mailContent, $mailSubject);
                    }

                    $SQL = $db->prepare("UPDATE `pterodactyl_servers` SET `days` = :days WHERE `id` = :id");
                    $SQL->execute(array(":days" => $diffInDays, ":id" => $row['id']));
                }
            }

        }
    }

    $webspaceDB = $db->prepare("SELECT * FROM `pterodactyl_servers` WHERE `expire_at` < :dateTimeNow AND `state` = 'active'");
    $webspaceDB->execute(array(":dateTimeNow" => $dateTimeNow));
    if ($webspaceDB->rowCount() != 0) {
        while ($row = $webspaceDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `pterodactyl_servers` SET `state`='suspended' WHERE `id` = :id");
            $SQL->execute(array(":id" => $row['id']));

            try {
                $pterodactyl->suspend($row['service_id']);
            } catch (Exception $e){

            }

            echo 'Suspended Gameserver #'.$row['id'];

        }
    }

    $webspaceSuspendedDB = $db->prepare("SELECT * FROM `pterodactyl_servers` WHERE `expire_at` < :dateTimeMinusDays AND `state` = 'suspended'");
    $webspaceSuspendedDB->execute(array(":dateTimeMinusDays" => $dateTimeMinus3Days));
    if ($webspaceSuspendedDB->rowCount() != 0) {
        while ($row = $webspaceSuspendedDB->fetch(PDO::FETCH_ASSOC)) {

            $SQL = $db->prepare("UPDATE `pterodactyl_servers` SET `state`='deleted', `deleted_at` = :deleted_at WHERE `id` = :id");
            $SQL->execute(array(":deleted_at" => $dateTimeNow, ":id" => $row['id']));

            try {
                $pterodactyl->delete($row['service_id']);
            } catch (Exception $e){

            }

            echo 'Deleted Gameserver #'.$row['id'];

        }
    }
    /* ======================================================================================================================================== */

    die('nothing todo');

} else {
    include BASE_PATH.'resources/sites/404.php';
}