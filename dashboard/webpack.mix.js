let mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css')
   .js('resources/js/app.js', 'public/js')
   .js('node_modules/sweetalert2/src/sweetalert2.js', 'public/js');
