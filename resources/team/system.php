<?php
$currPage = 'team_Systemverwaltung_admin';
include BASE_PATH.'app/controller/PageController.php';

if(isset($_POST['updateLegal'])){

    $SQL = $db->prepare("UPDATE `users` SET `legal_accepted` = '0'");
    $SQL->execute();

    echo sendSuccess('Alle Benutzer müssen nun die neuen AGBs & Datenschutzerklärungen akzeptieren');
}

if(isset($_POST['activateLogin'])){
    $SQL = $db->prepare("UPDATE `settings` SET `login` = '1'");
    $SQL->execute();

    echo sendSuccess('Der Login wurde aktiviert');
}
if(isset($_POST['deactivateLogin'])){
    $SQL = $db->prepare("UPDATE `settings` SET `login` = '0'");
    $SQL->execute();

    echo sendSuccess('Der Login wurde deaktiviert');
}

if(isset($_POST['activateRegister'])){
    $SQL = $db->prepare("UPDATE `settings` SET `register` = '1'");
    $SQL->execute();

    echo sendSuccess('Der Register wurde aktiviert');
}
if(isset($_POST['deactivateRegister'])){
    $SQL = $db->prepare("UPDATE `settings` SET `register` = '0'");
    $SQL->execute();

    echo sendSuccess('Der Register wurde deaktiviert');
}

if(isset($_POST['activateWebspace'])){
    $SQL = $db->prepare("UPDATE `settings` SET `webspace` = '1'");
    $SQL->execute();

    echo sendSuccess('Die Webspace bestellung wurde aktiviert');
}
if(isset($_POST['deactivateWebspace'])){
    $SQL = $db->prepare("UPDATE `settings` SET `webspace` = '0'");
    $SQL->execute();

    echo sendSuccess('Die Webspace bestellung wurde deaktiviert');
}

if(isset($_POST['activateVPS'])){
    $SQL = $db->prepare("UPDATE `settings` SET `vps` = '1'");
    $SQL->execute();

    echo sendSuccess('Die VPS bestellung wurde aktiviert');
}
if(isset($_POST['deactivateVPS'])){
    $SQL = $db->prepare("UPDATE `settings` SET `vps` = '0'");
    $SQL->execute();

    echo sendSuccess('Die VPS bestellung wurde deaktiviert');
}

if(isset($_POST['activateTeamspeak'])){
    $SQL = $db->prepare("UPDATE `settings` SET `teamspeak` = '1'");
    $SQL->execute();

    echo sendSuccess('Die Teamspeak bestellung wurde aktiviert');
}
if(isset($_POST['deactivateTeamspeak'])){
    $SQL = $db->prepare("UPDATE `settings` SET `teamspeak` = '0'");
    $SQL->execute();

    echo sendSuccess('Die Teamspeak bestellung wurde deaktiviert');
}

if(isset($_POST['setPaymentFees'])){
    $SQL = $db->prepare("UPDATE `settings` SET `psc_fees` = :psc_fees");
    $SQL->execute(array(":psc_fees" => $_POST['psc_fees']));

    echo sendSuccess('Die Zahlungsgebühren wurden gespeichert');
}

if(isset($_POST['setTrafficLimit'])){
    $SQL = $db->prepare("UPDATE `settings` SET `default_traffic_limit` = :default_traffic_limit");
    $SQL->execute(array(":default_traffic_limit" => $_POST['default_traffic_limit']));

    echo sendSuccess('Das Traffic Limit wurde gespeichert');
}

if(isset($_POST['activateCloud'])){
    $SQL = $db->prepare("UPDATE `settings` SET `rootserver` = :rootserver");
    $SQL->execute(array(":rootserver" => 'venocix'));

    echo sendSuccess('Die Venocix api wurde aktiviert');
}
if(isset($_POST['activateManual'])){
    $SQL = $db->prepare("UPDATE `settings` SET `rootserver` = :rootserver");
    $SQL->execute(array(":rootserver" => 'own'));

    echo sendSuccess('Die Manuelle Bestellung wurde aktiviert');
}

if(isset($_POST['setCaptchaType'])) {
    $SQL = $db->prepare("UPDATE `settings` SET `captcha` = :captcha");
    $SQL->execute(array(":captcha" => $_POST['captcha']));

    echo sendSuccess('Der Captcha-Typ wurde geändert.');
}

if(isset($_POST['setWebspaceType'])) {
    $SQL = $db->prepare("UPDATE `settings` SET `webspace_type` = :webspace_type");
    $SQL->execute(array(":webspace_type" => $_POST['webspace_type']));

    echo sendSuccess('Der Webspace-Typ wurde geändert.');
}

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex flex-column">

                            <form method="post">
                                <label>AGBs & Datenschutzerklärung zurücksetzen</label><br><br>
                                <button type="submit" class="btn btn-outline-success btn-block btn-sm" name="updateLegal"><b>Jetzt zurücksetzen</b></button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex flex-column">

                            <form method="post">
                                <?php if($helper->getSetting('login') == 0){ ?>
                                <button type="submit" class="btn btn-outline-success btn-block btn-sm" name="activateLogin"><b>Login aktivieren</b></button>
                                <?php } else { ?>
                                <button type="submit" class="btn btn-outline-danger btn-block btn-sm" name="deactivateLogin"><b>Login deaktivieren</b></button>
                                <?php } ?>

                                <?php if($helper->getSetting('register') == 0){ ?>
                                    <button type="submit" class="btn btn-outline-success btn-block btn-sm" name="activateRegister"><b>Register aktivieren</b></button>
                                <?php } else { ?>
                                    <button type="submit" class="btn btn-outline-danger btn-block btn-sm" name="deactivateRegister"><b>Register deaktivieren</b></button>
                                <?php } ?>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex flex-column">

                            <form method="post">
                                <?php if($helper->getSetting('webspace') == 0){ ?>
                                    <button type="submit" class="btn btn-outline-success btn-block btn-sm" name="activateWebspace"><b>Webspace bestellung aktivieren</b></button>
                                <?php } else { ?>
                                    <button type="submit" class="btn btn-outline-danger btn-block btn-sm" name="deactivateWebspace"><b>Webspace bestellung deaktivieren</b></button>
                                <?php } ?>

                                <?php if($helper->getSetting('vps') == 0){ ?>
                                    <button type="submit" class="btn btn-outline-success btn-block btn-sm" name="activateVPS"><b>VPS bestellung aktivieren</b></button>
                                <?php } else { ?>
                                    <button type="submit" class="btn btn-outline-danger btn-block btn-sm" name="deactivateVPS"><b>VPS bestellung deaktivieren</b></button>
                                <?php } ?>

                                <?php if($helper->getSetting('teamspeak') == 0){ ?>
                                    <button type="submit" class="btn btn-outline-success btn-block btn-sm" name="activateTeamspeak"><b>Teamspeak bestellung aktivieren</b></button>
                                <?php } else { ?>
                                    <button type="submit" class="btn btn-outline-danger btn-block btn-sm" name="deactivateTeamspeak"><b>Teamspeak bestellung deaktivieren</b></button>
                                <?php } ?>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex flex-column">

                            <form method="post">
                                <label>PSC Zahlungsgebühren</label>
                                <input class="form-control" required type="number" name="psc_fees" value="<?= $helper->getSetting('psc_fees'); ?>">
                                <br>
                                <button type="submit" class="btn btn-outline-warning btn-block btn-sm" name="setPaymentFees"><b>Speichern</b></button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex flex-column">

                            <form method="post">
                                <label>Standard Traffic Limit</label>
                                <input class="form-control" required type="number" name="default_traffic_limit" value="<?= $helper->getSetting('default_traffic_limit'); ?>">
                                <br>
                                <button type="submit" class="btn btn-outline-warning btn-block btn-sm" name="setTrafficLimit"><b>Speichern</b></button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex flex-column">

                            <form method="post">
                                <label>Captcha-Typ</label>
                                <select class="form-control" required name="captcha">
                                    <option <?php if($helper->getSetting('captcha') == 'google'){ echo 'selected'; } ?> value="google">Google reCAPTCHA v2</option>
                                    <option <?php if($helper->getSetting('captcha') == 'hcaptcha'){ echo 'selected'; } ?> value="hcaptcha">hCaptcha</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-outline-warning btn-block btn-sm" name="setCaptchaType"><b>Speichern</b></button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex flex-column">

                            <form method="post">
                                <label>Webspace-Typ</label>
                                <select class="form-control" required name="webspace_type">
                                    <option <?php if($helper->getSetting('webspace_type') == 'plesk'){ echo 'selected'; } ?> value="plesk">Plesk</option>
                                    <option <?php if($helper->getSetting('webspace_type') == 'keyhelp'){ echo 'selected'; } ?> value="keyhelp">KeyHelp</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-outline-warning btn-block btn-sm" name="setWebspaceType"><b>Speichern</b></button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-body d-flex flex-column">

                            <form method="post">
                                <?php if($helper->getSetting('rootserver') == 'own'){ ?>
                                    <button type="submit" class="btn btn-outline-success btn-block btn-sm" name="activateCloud"><b>Venocix Cloud aktivieren</b></button>
                                <?php } else { ?>
                                    <button type="submit" class="btn btn-outline-danger btn-block btn-sm" name="activateManual"><b>Manuelle Bestellung aktivieren</b></button>
                                <?php } ?>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>