<?php


    $id = $helper->protect($_GET['id']);
    
    $SQLGetServerInfos = $db->prepare("SELECT * FROM `gamecloud_clouds` WHERE `id` = :id");
    $SQLGetServerInfos -> execute(array(":id" => $id));
    $serverInfos = $SQLGetServerInfos -> fetch(PDO::FETCH_ASSOC);
    
    if(!is_null($serverInfos['locked'])){
        $_SESSION['product_locked_msg'] = $serverInfos['locked'];
        header('Location: '.env('URL').'manage/gameclouds');
        die();
    }
    
    if(!($serverInfos['deleted_at'] == NULL)){
        header('Location: '.$helper->url().'order/gamecloud');
        die();
    }
    
    if($serverInfos['state'] == 'suspended'){
        $suspended = true;
        die(header('Location: '.$helper->url().'renew/gamecloudc/'.$id));
    } else {
        $suspended = false;
    }
    
    
    if($userid != $serverInfos['user_id']){
        die(header('Location: '.$helper->url().'dashboard'));
    }
    
    if($serverInfos['state'] == 'active'){
        $state = '<span class="badge badge-success">Aktiv</span>';
    } elseif($serverInfos['state'] == 'suspended') {
        $state = '<span class="badge badge-warning">Gesperrt</span>';
    }else {
        $state = '<span class="badge badge-danger">Unbekannt</span>';
    }


    $count = 0;

    $SQL = $db->prepare("SELECT SUM(`gs_ram`) AS `gs_ram` FROM `gamecloud_server` WHERE `cloud_id` = :id");
    $SQL->execute(array(":id" => $id));
    $ramrow = $SQL->fetch(PDO::FETCH_ASSOC);
    $ramcount = $count + $ramrow['gs_ram'] / 1000;

    $SQL2 = $db->prepare("SELECT SUM(`gs_cpu`) AS `gs_cpu` FROM `gamecloud_server` WHERE `cloud_id` = :id");
    $SQL2->execute(array(":id" => $id));
    $cpurow = $SQL2->fetch(PDO::FETCH_ASSOC);
    $cpucount = $count + $cpurow['gs_cpu'] / 100;

    $SQL3 = $db->prepare("SELECT SUM(`gs_disk`) AS `gs_disk` FROM `gamecloud_server` WHERE `cloud_id` = :id");
    $SQL3->execute(array(":id" => $id));
    $diskrow = $SQL3->fetch(PDO::FETCH_ASSOC);
    $diskcount = $count + $diskrow['gs_disk'] / 1000;

    $SQL4 = $db->prepare("SELECT SUM(`gs_datenbanken`) AS `gs_datenbanken` FROM `gamecloud_server` WHERE `cloud_id` = :id");
    $SQL4->execute(array(":id" => $id));
    $dbrow = $SQL4->fetch(PDO::FETCH_ASSOC);
    $dbcount = $count + $dbrow['gs_datenbanken'];


    if(isset($_POST['delServ'])){

        $pterodactyl->delete($_POST['wisp_id']);

        $wisp_id = $_POST['wisp_id'];
    
        $SQLDEL = $db -> prepare("DELETE FROM `gamecloud_server` WHERE `wisp_id` = :wisp_id");
        $SQLDEL->execute(array(":wisp_id" => $wisp_id));

        $_SESSION['success_msg'] = 'Die Instanz wurde erfolgreich gelöscht.';
        header('Location: '.env('URL').'manage/gamecloud/'.$id);

    }