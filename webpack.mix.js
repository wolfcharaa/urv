let mix = require('laravel-mix');
mix.js('resources/js/app.js', 'js')
    .js('resources/js/bootstrap.js', 'js')
    .js('resources/js/jquery.min.js', 'js')
    .js('resources/js/main.js', 'js')
    .js('resources/js/popper.js', 'js')
    .css('resources/css/style.css', 'css')
    .css('resources/css/app.css', 'css');
