require('dotenv').config();

const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .sass('resources/sass/adm-template.scss', 'public/css/adm.css')
    .sass('resources/sass/web-template.scss', 'public/css/web.css')
    .sass('resources/sass/logged-out.scss', 'public/css/logged-out.css')

    .scripts([
        //To build the theme (jquery first)
        'resources/vendor/adm-template/js/jquery.js'
        ,'resources/vendor/adm-template/js/bootstrap.js'
        ,'resources/vendor/adm-template/js/scripts.js'

    ], 'public/js/essentials.js')

    // .vue().js('resources/js/bolao-app.js', 'public/js/bolao.js')

    //Superhero Theme (ADM)
    .scripts([

        //To build the theme (jquery first)
        'resources/vendor/adm-template/js/jquery.js'
        ,'resources/vendor/adm-template/js/flot/jquery.flot.js'
        ,'resources/vendor/adm-template/js/jquery.knob.js'
        ,'resources/vendor/adm-template/js/jquery.mask.js'
        ,'resources/vendor/adm-template/js/jquery.nestable.js'
        ,'resources/vendor/adm-template/js/jquery-jvectormap-1.2.2.min.js'
        ,'resources/vendor/adm-template/js/jquery-jvectormap-world-merc-en.js'
        ,'resources/vendor/adm-template/js/jquery.nouislider.js'
        ,'resources/vendor/adm-template/js/jquery.slimscroll.js'
        ,'resources/vendor/adm-template/js/jquery.pwstrength.js'
        ,'resources/vendor/adm-template/js/jquery-ui.custom.js'
        ,'resources/vendor/adm-template/js/jquery-ui.custom.min_BAK.js'

        ,'resources/vendor/adm-template/js/ckeditor.js'
        ,'resources/vendor/adm-template/js/bootstrap.js'
        ,'resources/vendor/adm-template/js/bootstrap-datepicker.js'
        // ,'resources/vendor/adm-template/js/daterangepic/**/ker.js'
        ,'resources/vendor/adm-template/js/dropzone.js'
        // ,'resources/vendor/adm-template/js/fullcalendar.js'
        ,'resources/vendor/adm-template/js/gdp-data.js'
        ,'resources/vendor/adm-template/js/hogan.js'
        ,'resources/vendor/adm-template/js/jquery.mask.js'
        ,'resources/vendor/adm-template/js/jquery.maskMoney.min.js'
        ,'resources/vendor/adm-template/js/moment.js'
        ,'resources/vendor/adm-template/js/morris.js'
        ,'resources/vendor/adm-template/js/rainbow.min.js'
        ,'resources/vendor/adm-template/js/raphael-min.js'
        ,'resources/vendor/adm-template/js/scripts.js'
        ,'resources/vendor/adm-template/js/select2.min.js'
        ,'resources/vendor/adm-template/js/wizard.js'
        // ,'resources/vendor/adm-template/js/xcharts.js'

        ,'resources/js/adm-general.js'

    ], 'public/js/adm.js')

    //Metronic theme
    .scripts([
        //Layout
        'resources/vendor/adm-template/js/jquery.js'
        ,'resources/vendor/adm-template/js/jquery-debounce.js'
        ,'resources/vendor/adm-template/js/jquery.mask.js'
        ,'resources/vendor/adm-template/js/popper.js'
        ,'resources/vendor/metronic-template/theme-2/js/vendors/plugins/bootstrap.js'
        ,'resources/vendor/metronic-template/theme-2/js/components/util.js'
        ,'resources/vendor/metronic-template/theme-2/js/components/header.js'
        ,'resources/vendor/metronic-template/theme-2/js/layout/base/header.js'
        ,'resources/vendor/metronic-template/theme-2/js/components/offcanvas.js'
        ,'resources/vendor/metronic-template/theme-2/js/components/menu.js'
        ,'resources/vendor/metronic-template/theme-2/js/components/toggle.js'
        ,'resources/vendor/metronic-template/theme-2/js/layout/base/header-menu.js'
        ,'resources/vendor/metronic-template/theme-2/js/layout/base/header-topbar.js'
        ,'resources/vendor/metronic-template/theme-2/js/layout/base/content.js'
        ,'resources/vendor/metronic-template/theme-2/js/layout/base/footer.js'
        ,'resources/vendor/metronic-template/theme-2/js/layout/initialize.js'
        ,'resources/vendor/metronic-template/theme-2/js/components/image-input.js'
        ,'resources/vendor/adm-template/js/jquery.print.js'
        ,'resources/vendor/adm-template/js/jquery.maskMoney.min.js'
        ,'resources/vendor/metronic-template/theme-2/js/vendors/plugins/jquery.unveil.js'

        //Custom
        ,'resources/js/bolaoBuilder.js'
        ,'resources/js/util.js'
    ], 'public/js/web.js')

    .scripts([
        'resources/js/card.js',
        'resources/js/pagseguro-v2.js',
        'resources/js/checkout.js',
    ], 'public/js/checkout.js')

    //Customers Page

    .sass('resources/sass/customers.scss', 'public/css/customers.css')
    .scripts([
        'resources/vendor/adm-template/js/jquery.js',
        'resources/vendor/metronic-template/theme-2/js/pages/custom/user/add-user.js',
    ], 'public/js/customers.js')

    //To IE 9
    .copy('resources/vendor/adm-template/js/html5shiv.js', 'public/js/html5shiv.js')
    .copy('resources/vendor/adm-template/js/respond.min.js', 'public/js/respond.min.js')

    .copyDirectory('resources/img', 'public/img')
    // .copyDirectory('resources/vendor/adm-template/fonts', 'public/fonts')

    .version()
;
