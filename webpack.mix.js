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



// mix.js('resources/js/app.js', 'public/js')
//     .react()
//     .sass('resources/sass/app.scss', 'public/css');

//**************** CSS ********************
//css
mix.copy('node_modules/@coreui/chartjs/dist/css/coreui-chartjs.css', 'public/css');
mix.copy('node_modules/cropperjs/dist/cropper.css', 'public/css');
mix.copy('node_modules/jstree/dist/themes/default', 'public/css/jstree');
mix.copy('node_modules/@yaireo/tagify/dist/tagify.css', 'public/css');
mix.copy('node_modules/@yaireo/dragsort/dist/dragsort.css', 'public/css');
mix.copy('node_modules/lightbox2/dist/css/lightbox.css', 'public/css');
mix.copy('node_modules/font-awesome/css/font-awesome.css', 'public/css');
mix.copy('node_modules/cropperjs/dist/cropper.css', 'public/css');
mix.copy('node_modules/sweetalert2/dist/sweetalert2.css', 'public/css');
mix.copy('resources/css/scrollbar.css','public/css');
mix.copy('resources/js/custom.js','public/js');
mix.copy('resources/css/select2-bootstrap4.min.css','public/css');
mix.copy('resources/css/select2.min.css','public/css');
mix.copy('resources/css/datatables.min.css','public/css');
mix.styles([
    'resources/css/loading_icon.css',
],'public/css/main.css')

//main css
mix.sass('resources/sass/style.scss', 'public/css');

//************** SCRIPTS ******************
// general scripts
mix.copy('node_modules/@coreui/utils/dist/coreui-utils.js', 'public/js');
mix.copy('node_modules/axios/dist/axios.min.js', 'public/js');
mix.copy('node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js', 'public/js');
mix.copy('node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js.map', 'public/js');
mix.copy('node_modules/jstree/dist/jstree.min.js', 'public/js');
mix.copy('node_modules/@yaireo/tagify/dist/tagify.min.js','public/js');
mix.copy('node_modules/@yaireo/dragsort/dist/dragsort.js', 'public/js');
mix.copy('node_modules/lightbox2/dist/js/lightbox.js', 'public/js');
mix.copy('node_modules/jquery/dist/jquery.js', 'public/js');
mix.copy('node_modules/jquery-mousewheel/jquery.mousewheel.js', 'public/js');
mix.copy('node_modules/jquery-ui-dist/jquery-ui.min.js', 'public/js');
mix.copy('node_modules/@popperjs/core/dist/umd/popper.js', 'public/js');

mix.js('resources/js/sweetalert.js','public/js');

// views scripts

// details scripts

//*************** OTHER ******************
//fonts
mix.copy('node_modules/@coreui/icons/fonts', 'public/fonts');
//icons
mix.copy('node_modules/@coreui/icons/css/free.min.css', 'public/css');
mix.copy('node_modules/@coreui/icons/css/free.min.css.map', 'public/css');
mix.copy('node_modules/@coreui/icons/css/brand.min.css', 'public/css');
mix.copy('node_modules/@coreui/icons/css/flag.min.css', 'public/css');
mix.copy('node_modules/@coreui/icons/css/flag.min.css.map', 'public/css');
mix.copy('node_modules/@coreui/icons/svg/flag', 'public/svg/flag');
mix.copy('node_modules/@coreui/icons/sprites/', 'public/icons/sprites');
//images
mix.copy('resources/assets', 'public/assets');
