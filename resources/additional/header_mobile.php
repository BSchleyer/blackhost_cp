<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <a href="<?= env('URL'); ?>">
        <img alt="Logo" src="https://cdn.black-host.eu/logo/logo-text-primary.png" width="125" />
    </a>

    <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle" style="color:<?= env('MAIN_COLOR'); ?>">
            <span style="color:<?= env('MAIN_COLOR'); ?>"></span>
        </button>

        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
            <span class="svg-icon svg-icon-xl">
				<i class="fa fa-user" style="color:<?= env('MAIN_COLOR'); ?>"></i>
            </span>
        </button>
    </div>
</div>