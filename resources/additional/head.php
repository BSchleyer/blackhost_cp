<?php

$datasavingmode = $user->getDataById($userid,'datasavingmode');
$darkmode = $user->getDataById($userid,'darkmode');

if(isset($_POST['saveSettings'])){
    if(isset($_POST['datasavingmode'])){
        $datasavingmode = true;
    } else {
        $datasavingmode = false;
    }

    if(isset($_POST['darkmode'])){
        $darkmode = true;
    } else {
        $darkmode = false;
    }

    if(isset($_POST['livechat'])){
        $livechat = true;
    } else {
        $livechat = false;
    }

    if(isset($_POST['preloader'])){
        $preloader = true;
    } else {
        $preloader = false;
    }

    $SQL = $db->prepare("UPDATE `users` SET `datasavingmode` = :datasavingmode, `darkmode` = :darkmode, `livechat` = :livechat, `preloader` = :preloader WHERE `id` = :id");
    $SQL->execute(array(":datasavingmode" => $datasavingmode, ":darkmode" => $darkmode, ":livechat" => $livechat, ":preloader" => $preloader, ":id" => $userid));

    $_SESSION['success_msg'] = 'Daten wurden gespeichert';
//    echo sendSuccess('Daten wurden gespeichert');
}

?>

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head><base href="">
    <meta charset="utf-8" />
    <title><?= $currPageName; ?> - <?= $helper->siteName(); ?></title>
	
        <meta name="description" content="Black-Host.eu - Server aus der Zukunft">

        <meta property="og:title" content="Black-Host.eu - Server aus der Zukunft">
        <meta property="og:description" content="Black-Host.eu ist dein Hosting Unternehmen mit leistungsstarken und trotzdem günstigen Servern. Wir existieren seit dem 08.07.2020 und konnten in dieser Zeit schon über 1.000 Kunden von unseren Angeboten faszinieren. Worauf wartest du also noch?">
        <meta property="og:site_name" content="Black-Host.eu">
        <meta property="og:type" content="website">
        <meta property="og:image" content="/">
        <meta property="fb:app_id" content="">

        <meta name="theme-color" content="#6254FF">
	
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <?php if($datasavingmode == 0){ ?>
    <link href="<?= $helper->cdnUrl(); ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.4" rel="stylesheet" type="text/css" />
    <?php } ?>
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= $helper->cdnUrl(); ?>assets/plugins/global/plugins.bundle.css?v=7.0.4" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.4" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <?php if($currPage == 'front_Login_auth'){ ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <?php } ?>

    <script src="<?= $helper->cdnUrl(); ?>assets/plugins/global/plugins.bundle.js?v=7.0.4"></script>

    <!-- DARKMODE -->
	<?php if($darkmode){ ?>
    <link href="<?= $helper->cdnUrl(); ?>assets/css/style_dark.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/header/base/light_dark.css" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/brand/dark_dark.css" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/aside/dark_dark.css" rel="stylesheet" type="text/css" />
    <?php } else { ?>
    <link href="<?= $helper->cdnUrl(); ?>assets/css/style_dark.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/header/base/light_dark.css" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/brand/dark_dark.css" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/aside/dark_dark.css" rel="stylesheet" type="text/css" />

    <!--<link href="<?= $helper->cdnUrl(); ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />-->
    <?php } ?>
    <!-- DARKMODE END -->

    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
    <link href="<?= $helper->cdnUrl(); ?>assets/css/global.css" rel="stylesheet" type="text/css" />

    <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/header/menu/light.css?v=7.0.4" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="/" />
    
    <!-- Fontawesome Stuff -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.3.0/font-awesome-animation.min.css" integrity="sha512-Po8rrCwchD03Wo+2ibHFielZ8luDAVoCyE9i6iFMPyn9+V1tIhGk5wl8iKC9/JfDah5Oe9nV8QzE8HHgjgzp3g==" crossorigin="anonymous" />



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>

	<!-- Cookie popup -->

    <!-- Cookie popup END -->
    
    <!-- Rotating Icon -->
    <style>
    .icon-rotate:hover {
        animation: fas-spin 2s infinite linear;
    }
    @-webkit-keyframes fas-spin{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}
    @keyframes fas-spin{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}
    </style>
    <!-- Rotating Icon END -->

    
    <!-- Preloader -->
    <link href="<?= $helper->cdnUrl(); ?>assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <!-- Preloader END -->

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->


<!-- Preloader -->
<?php if($user->getDataById($userid,'preloader')){ ?>

    <?php if($currPage == 'back_Rechnung_hidelayout' || $currPage == 'back_Spenden_hidelayout'){ } else { ?>
        <?php if($user->getDataById($userid,'preloader')){ ?>
            <div id="preloader">
                <div id="status">
                    <div class="red-spinner">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>

<?php } else { ?>

    <!-- Nichts -->
    
<?php } ?>
<!-- Preloader END -->