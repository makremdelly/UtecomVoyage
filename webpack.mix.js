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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .combine([
      'resources/dist/assets/modules/bootstrap/css/bootstrap.min.css',
      'resources/dist/assets/modules/fontawesome/css/all.min.css',
      'resources/dist/assets/css/style.css',
      'resources/dist/assets/css/components.css',  
      'resources/dist/assets/modules/jqvmap/dist/jqvmap.min.css',
      // 'resources/dist/assets/modules/summernote/summernote-bs4.css',
      'resources/dist/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css',
      'resources/dist/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css',
      'resources/dist/assets/modules/chocolat/dist/css/chocolat.css'
 
  ],  'public/css/all.css')
  .combine([
   'resources/dist/assets/css/custom.css'
  ],'public/css/custom.css')

  .combine([
   'resources/dropzone-5.7.0/dist/dropzone.css'
  ],'public/css/dropzone.css')

  
  .combine([
   'resources/dist/assets/modules/jquery.min.js',
   'resources/dist/assets/modules/popper.js',
   'resources/dist/assets/modules/tooltip.js',
   'resources/dist/assets/modules/bootstrap/js/bootstrap.min.js',
   'resources/dist/assets/modules/nicescroll/jquery.nicescroll.min.js',
   'resources/dist/assets/modules/moment.min.js"',
   'resources/dist/assets/js/stisla.js',
   'resources/dist/assets/js/scripts.js',
   'resources/dist/assets/js/custom.js',
   'resources/dist/assets/modules/jquery.sparkline.min.js',
   'resources/dist/assets/modules/chart.min.js',
   'resources/dist/assets/modules/owlcarousel2/dist/owl.carousel.min.js',
   'resources/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js'
  ], 'public/js/all.js')

  .combine([
   'resources/dropzone-5.7.0/dist/dropzone.js'
  ],'public/js/dropzone.js')

  .copyDirectory('resources/dist/assets/img', 'public/img')
  .copyDirectory('resources/dist/assets/fonts', 'public/fonts')
  .copyDirectory('resources/dist/assets/fonts', 'public/webfonts');
  
