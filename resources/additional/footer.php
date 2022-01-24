<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark order-2 order-md-1">
			<font style="font-size: 110%;"> Made with <i class="fa fa-heart" style="color:red;"></i> by
            <a href="" class="text-dark-75 text-hover-primary">Black-Host.eu</a></font>
        </div>
        <div class="nav nav-dark">
            <a target="_blank" href="https://black-host.eu/agb" class="nav-link pl-0 pr-5">AGB</a>
			<a target="_blank" href="https://black-host.eu/datenschutz" class="nav-link pl-0 pr-5">Datenschutz</a>
            <a target="_blank" href="https://black-host.eu/impressum" class="nav-link pl-0 pr-0">Impressum</a>
        </div>

					<small>* Mit einem Klick auf "Kostenpflichtig bestellen" wird die entsprechende Dienstleistung direkt bestellt und du stimmst
						den AGB und Datenschutzrichtlienen zu.</small>

        <!--NaN-->

        <!-- TrustBox widget - Micro Review Count --><!--
        <?php if($user->getDataById($userid,'darkmode')){ ?>

            <div class="trustpilot-widget" data-locale="de-DE" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="5ebbe8488b381c000123ca58" data-style-height="24px" data-style-width="110%" data-theme="dark">
                <a href="https://de.trustpilot.com/review/red-host.eu" target="_blank" rel="noopener" class="nav-link pl-0 pr-0">Trustpilot</a>
            </div>

        <?php } else { ?>
            
            <div class="trustpilot-widget" data-locale="de-DE" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="5ebbe8488b381c000123ca58" data-style-height="24px" data-style-width="115%" data-theme="light">
                <a href="https://de.trustpilot.com/review/red-host.eu" target="_blank" rel="noopener" class="nav-link pl-0 pr-0">Trustpilot</a>
            </div>

        <link href="<?= $helper->cdnUrl(); ?>assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
	    <?php } ?>
        -->
        <!-- End TrustBox widget -->

    </div>
</div>
</div>
</div>
</div>

<div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
            </g>
        </svg>
        <!--end::Svg Icon-->
    </span>
</div>

<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">Statusmeldungen</h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <div class="offcanvas-content pr-5 mr-n5">

        <form method="post">
            <div class="row noselect">

                <label class="col-9 col-form-label" align="center">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">

                    </span>

                    <center>
                    <i class="fa fa-exclamation-circle text-warning"></i> <?php echo($result["data"][0]["title"]); ?> |
                   </center>
                </label>

                <hr>


                <div class="col-12">
                    <a href="https://status.black-host.eu/" target="_blank" class="btn btn-transparent-primary btn-block btn-sm"><b>Zum Serverstatus</b></a>
                </div>

            </div>
        </form>


    </div>
</div>

<script>var HOST_URL = "<?= env('URL'); ?>";</script>
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>

<script src="<?= $helper->cdnUrl(); ?>assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.4"></script>
<script src="<?= $helper->cdnUrl(); ?>assets/js/scripts.bundle.js?v=7.0.4"></script>
<script src="<?= $helper->cdnUrl(); ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.4"></script>
<script src="<?= $helper->cdnUrl(); ?>assets/js/pages/widgets.js?v=7.0.4"></script>

<?php if($vmsoftware->getOpenInstalls($serverInfos['id'])) { ?>
<script>
    function blockpageload(){
        KTApp.block('#kt_blockui_card', {
            overlayColor: '#000000',
            state: 'primary',
            message: 'Bitte warten...'
        });

        setTimeout(function() {
            KTApp.unblock('#kt_blockui_card');
        }, 120000);
    }

    blockpageload();
</script>
<?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('.copy-btn');
    clipboard.on('success', function(e){
        toastr.options = { 
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false, 
            "onclick": null, 
            "showDuration": "300", 
            "hideDuration": "1000", 
            "timeOut": "5000", 
            "extendedTimeOut": "1000", 
            "showEasing": "swing", 
            "hideEasing": "linear", 
            "showMethod": "fadeIn", 
            "hideMethod": "fadeOut" 
        };
        toastr.success(
            "Wurde Kopiert",    //Message
            "Erfolgreich"       //Titel
        );
    });
</script>

<!-- Preloader -->
<script src="<?= $helper->cdnUrl(); ?>assets/js/app.js"></script>
<!-- Preloader END -->


<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTableLoad').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/German.json"
            }
        });
    } );

    function humanFileSize(bytes, si) {
        var thresh = si ? 1000 : 1024;
        if(Math.abs(bytes) < thresh) {
            return bytes + ' B';
        }
        var units = si
            ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
            : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
        var u = -1;
        do {
            bytes /= thresh;
            ++u;
        } while(Math.abs(bytes) >= thresh && u < units.length - 1);
        return bytes.toFixed(2)+' '+units[u];
    }

    function number_format (number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

</script>

<script src="https://black-host.ehu/snow.js" type="c5d42eb47e5fb45d7001b71c-text/javascript"></script>
<script type="c5d42eb47e5fb45d7001b71c-text/javascript">snowStorm.snowColor='#99ccff';snowStorm.flakesMaxActive=100;snowStorm.useTwinkleEffect=true;snowStorm.followMouse=false;snowStorm.flakesMax=128;snowStorm.freezeOnBlur=false;</script>


<?php

if(isset($_SESSION['success_sweet_msg']) && !empty($_SESSION['success_sweet_msg'])){
    echo sendSweetSuccess($_SESSION['success_sweet_msg']);
    $_SESSION['success_sweet_msg'] = '';
    unset($_SESSION['success_sweet_msg']);
}

if(isset($_SESSION['product_locked_msg']) && !empty($_SESSION['product_locked_msg'])){
    echo sendSweetError($_SESSION['product_locked_msg'],'Dein Produkt ist gesperrt');
    $_SESSION['product_locked_msg'] = '';
    unset($_SESSION['product_locked_msg']);
}

?>

<?php if($user->getDataById($userid,'livechat')){ ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60b4c68fde99a4282a1a8701/1f712f8gc';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


<!-- Smartsupp Live Chat script -->
<!--<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'b489ff22a3619fa8735f55afefa34c605402b739';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>-->
<?php } ?>

</body>
</html>