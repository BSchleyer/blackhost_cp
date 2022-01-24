<script src="https://yd6sxh5j0p7q.statuspage.io/embed/script.js"></script>

<div id="kt_header" class="header header-fixed">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
		
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="header-menu header-menu-mobile  header-menu-layout-default ">
                <ul class="menu-nav ">
                    <li class="menu-item menu-item-submenu menu-item-rel menu-item-active" data-menu-toggle="click" aria-haspopup="true">
                        <font size="3">
                            <!--<b><?= $site->getWelcomeText(date('H')); ?></b>-->
							Willkommen bei Black-Host.eu <u style="color:<?= env('MAIN_COLOR'); ?>"><b style="color:<?= env('MAIN_COLOR'); ?>">
							<?= $username ?></b></u>.
							<br>
                            
                            <h6>


                            </h6>
						
							
							<small> 
								<!--<i class="fa fa-exclamation-circle" style="color:<?= env('MAIN_COLOR'); ?>"></i>
								Es steht eine Wartung für den <b>09.12.2021</b> an. 
								<a href="https://status.black-host.eu/" target="_blank">Mehr erfahren</a>-->
							</small>

							<!--<div class="alert alert-primary col-md-12" role="alert">
								Aktuell kannst du bis zu <b>50%</b> auf die Bestellung eines Jahres Webserver sparen.
							</div>-->


                        </font>
                    </li>
                </ul>
            </div>
        </div>

        <div class="topbar">
            <div class="dropdown">

                <?php
                $SQL = $db -> prepare("SELECT * FROM `tickets` WHERE `user_id` = :user_id AND `state` = 'OPEN' AND `last_msg` = 'SUPPORT'");
                $SQL->execute(array(":user_id" => $userid));
                if ($SQL->rowCount() != 0) {
                ?>

                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" onclick="window.open('<?= env('URL'); ?>tickets');">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary" 
						 data-toggle="tooltip" title="Neue Ticketantwort">
                        <i class="fa fa-exclamation-circle" style="color:orange;"></i>
                    </div>
                </div>

                <?php } ?>


                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" onclick="window.open('https://status.black-host.eu');">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary" 
						 data-toggle="tooltip" title="Zum Serverstatus">
                        <i class="fas fa-server" style="color:#6254FE;"></i>
                    </div>
                </div>
			
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" onclick="window.open('https://twitter.com/BlackHostEU');">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary"
						 data-toggle="tooltip" title="Unser Twitter Account">
                        <i class="fab fa-twitter" style="color:#6254FE;"></i>
                    </div>
                </div>

                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" onclick="window.open('ts3server://ts.black-host.eu');">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary"
						 data-toggle="tooltip" title="Unser Teamspeak Server">
                        <i class="fab fa-teamspeak" style="color:#6254FE;"></i>
                    </div>	
                </div>

                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" onclick="window.open('https://dsc.gg/black-host');">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary"
						 data-toggle="tooltip" title="Unser Discord Server">
                        <i class="fab fa-discord" style="color:#6254FE;"></i>
                        <!--<span class="pulse-ring"></span>-->
                    </div>	
                </div>
				
            </div>

            <?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://status.black-host.eu/api/v1/alerts',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response, true);

// view result
?>

            <div class="topbar-item">
                <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <!--<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= $username; ?></span>-->
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary"
						 data-toggle="tooltip" title="Es gibt eine Statusmeldung">


                        <?php if($result !== NULL) { ?>
                                <i class="fa fa-exclamation-circle text-warning"></i>
                        <?php } ?>



                        </div>
                </div>
            </div>
        </div>

    </div>
</div>
