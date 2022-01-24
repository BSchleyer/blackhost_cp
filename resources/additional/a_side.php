<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a href="<?= env('URL'); ?>" class="brand-logo">
            <?php if($datasavingmode == 0){ ?>

                <!-- DARKMODE -->
            <?php if($user->getDataById($userid,'darkmode')){ ?>
                <img alt="Logo" src="https://cdn.black-host.eu/logo/logo-text-primary.png" width="160">
            <?php } else { ?>
                <img alt="Logo" src="https://cdn.black-host.eu/logo/logo-text-primary.png" width="160">
            <?php } ?>

            <?php } else { ?>
                <?= env('APP_DOMAIN'); ?>
            <?php } ?>
        </a>

        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
					<i class="fa fa-angle-double-left" style="color:#6254FE"></i>
            </span>
        </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">

                <li class="menu-item" aria-haspopup="true"> <!-- menu-item-active -->
                    <a href="<?= env('URL'); ?>dashboard" class="menu-link">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-home" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

				<?php if(!$_COOKIE['session_token']){ ?> 
				
										   
				<?php } else { ?>

                <li class="menu-item" aria-haspopup="true"> <!-- menu-item-active -->
                    <a href="<?= env('URL'); ?>accounting/charge" class="menu-link">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-wallet" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text"><?= $amount; ?>€ Guthaben</span>
                    </a>
                </li>

				<?php } ?>


                <li class="menu-item" aria-haspopup="true"> <!-- menu-item-active -->
                    <a href="<?= env('URL'); ?>support" class="menu-link">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-life-ring" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Hilfe erhalten &nbsp;</span>
                    </a>
                </li>

                <li class="menu-item" aria-haspopup="true"> <!-- menu-item-active -->
                    <a href="<?= env('URL'); ?>aktuelles" class="menu-link">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-rss" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Aktuelles &nbsp;</span>
                    </a>
                </li>

				<?php if(!$_COOKIE['session_token']){ ?> 
				
										   
				<?php } else { ?>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-cubes" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
						</span>
                        <span class="menu-text">Cashbox</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Cashbox</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>d/<?= $userid ?>" target="_blank" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Zur Cashbox</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>profile" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Cashbox anpassen</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

				<?php } ?>

                <li class="menu-section">
                    <h4 class="menu-text">Produkte</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                </li>

				

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-gamepad" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
						</span>
                        <span class="menu-text">Gameserver &nbsp; <span class="badge badge-primary">Beliebt</span></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Gameserver</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>order/gameserver" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bestellen</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>manage/gameserver/mc" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Minecraft Verwaltung</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-cloud" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
						</span>
                        <span class="menu-text">Gamecloud &nbsp; <span class="badge badge-primary">Neu</span></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Gamecloud</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>order/gamecloud" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bestellen</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>manage/gameclouds" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Verwalten</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
				
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-globe" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
						</span>
                        <span class="menu-text">Webserver</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Webspace</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>order/webspace" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bestellen</span>
                                </a>
                            </li>
							
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>manage/webspace" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Verwalten</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>manage/reseller/webspace" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Reseller Verwaltung</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-cloud" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
						</span>
                        <span class="menu-text">Cloudserver</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Cloudserver</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>order/nextcloud" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bestellen</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>manage/nextcloud" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Verwalten</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-server" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
						</span>
                        <span class="menu-text">NLD KVM &nbsp; <span class="badge badge-primary">BETA</span></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">NLD KVM</span>
                                </span>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>order/kvm" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text"> Konfigurator</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>order/kvm-pakete" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text"> Pakete</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>manage/kvms" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text"> Verwalten</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


               <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-robot" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
						</span>
                        <span class="menu-text">SinusBot </span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">SinusBots</span>
                                </span>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>order/sinusbot" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bestellen</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>manage/sinusbot" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Verwalten</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-network-wired" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
						</span>
                        <span class="menu-text">Domains &nbsp; <span class="badge badge-primary">Q1 2022</span></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Domains</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Coming Soon 👷</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>manage/domains" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Verwalten</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
				

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-store" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
						</span>
                        <span class="menu-text">Marktplatz</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Marktplatz</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>order/marktplatz" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bestellen</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>manage/marktplatz" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Verwalten</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

				<?php if(!$_COOKIE['session_token']){ ?> 
				
										   
				<?php } else { ?>

                <li class="menu-section">
                    <h4 class="menu-text">Kundenverwaltung</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">	
							<i class="fa fa-address-card" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text"><?= $username ?></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Profil</span>
                                </span>
                            </li>
							
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>profile" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Profil anpassen</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-book" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Buchhaltung</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
							
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Buchhaltung</span>
                                </span>
                            </li>
							
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>accounting/charge" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Guthaben aufladen</span>
                                </a>
                            </li>
							
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>accounting/transactions" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Transaktionen</span>
                                </a>
                            </li>
							
                        </ul>
                    </div>
                </li>

                <li class="menu-section">
                    <h4 class="menu-text">Sonstiges</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">	
							<i class="fa fa-money-bill-alt" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">€ Verdienen</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Unterseiten</span>
                                </span>
                            </li>
						

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>affiliate/mysite" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Affiliate Verwaltung</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>daily" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Tägl. Belohnungen</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">	
							<i class="fa fa-exclamation-triangle" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Systemstörungen</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Systemstörungen</span>
                                </span>
                            </li>
						

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>getback" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Entschädigungen</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!--<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">	
							<i class="fa fa-snowflake" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Winter Special</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Winter Special</span>
                                </span>
                            </li>
							
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>adventskalender" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Adventskalender</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>-->

				
				<?php } ?>

                <li class="menu-section">
                    <h4 class="menu-text">Hilfe erhalten</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">	
							<i class="fa fa-users" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Community</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Community</span>
                                </span>
                            </li>
							
                            <li class="menu-item" aria-haspopup="true">
                                <a href="https://wiki.black-host.eu/" target="_blank" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Wiki</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">	
							<i class="fa fa-headset" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Kundensupport</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Support</span>
                                </span>
                            </li>
							
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>tickets" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Ticket eröffnen</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="mailto:support@black-host.eu" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">E-Mail schreiben</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="https://dsc.gg/black-host" target="_blank" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Discord Support</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="ts3server://black-host.eu" target="_blank" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Teamspeak Support</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <?php if($user->isInTeam($_COOKIE['session_token'])){ ?>
                    <li class="menu-section">
                        <h4 class="menu-text">Supportcenter</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                    </li>

                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-ticket-alt" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                            <span class="menu-text">Ticketsupport</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">Ticketsupport</span>
                                    </span>
                                </li>
								
								
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= env('URL'); ?>team/tickets" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Tickets</span>
                                    </a>
                                </li>
								
                            </ul>
                        </div>
                    </li>


                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-id-card-alt" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                            <span class="menu-text">Support PIN</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">supportpin</span>
                                    </span>
                                </li>
								
								
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="<?= env('URL'); ?>team/spin_login" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">S-Pin Login</span>
                                    </a>
                                </li>
								
                            </ul>
                        </div>
                    </li>
                <?php } ?>



                <?php if(isset($_COOKIE['old_session_token'])){ ?>
                <li class="menu-section">
                    <h4 class="menu-text">Administration</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md" style="color:<?= env('MAIN_COLOR'); ?>"></i>
                </li>
                <li class="menu-item" aria-haspopup="true"> <!-- menu-item-active -->
                    <a href="<?= env('URL'); ?>team/login_back" class="menu-link">
                    <span class="svg-icon menu-icon">
							<i class="fa fa-crown" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                    </span>
                        <span class="menu-text">Zurück zum ACP</span>
                    </a>
                </li>
                <?php } ?>
				

                <?php if($user->isAdmin($_COOKIE['session_token'])){ ?>
                    <li class="menu-section">
                        <h4 class="menu-text">Administration</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-desktop" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Verwaltung</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Administration</span>
                                </span>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/codes/list" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Codeverwaltung</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/users/transactions" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Alle Transaktionen</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/users" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Kundenverwaltung</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/transactions" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Zahlungsverwaltung</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/system" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Systemverwaltung</span>
                                </a>
                            </li>
							
                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-cog" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Systemsteuerung</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Steuerung</span>
                                </span>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/ipam" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">IPAM</span>
                                </a>
                            </li>

							
                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-cube" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Bestellsystem</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Bestellsystem</span>
                                </span>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/orders" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Offene Bestellungen</span>
                                </a>
                            </li>

							
                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
							<i class="fa fa-server" style="color:<?= env('MAIN_COLOR'); ?>;"></i>
                        </span>
                        <span class="menu-text">Produktverwaltung</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Produktverwaltung</span>
                                </span>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/produkte/webserver" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Webserver</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/produkte/webserver-rs" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Webserver Reseller</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/produkte/sinusbot" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Sinusbot</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/produkte/marktplatz" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Marktplatz</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/produkte/kvm/server" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">KVM-Server</span>
                                </a>
                            </li>
                            
                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/produkte/kvm/ipv6" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">KVM-IPV6</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/produkte/gameserver/mc" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Gameserver MC</span>
                                </a>
                            </li>

                            <li class="menu-item" aria-haspopup="true">
                                <a href="<?= env('URL'); ?>team/produkte/cloudserver" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Cloudserver</span>
                                </a>
                            </li>

							
                        </ul>
                    </div>
                </li>



                <?php } ?>

            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>