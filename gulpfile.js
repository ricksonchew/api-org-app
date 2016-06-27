var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // LESS
    mix.less([
        '../theme/yoyo/less/style.less'
    ], 'public/assets/theme/yoyo/css/style.min.css');

    // CORE
    mix.scripts([
        '../js/core/jquery.js',
    ], 'public/assets/js/core/jquery.js');

    // PLUGIN CSS
    mix.styles([
        '../css/font-awesome/css/font-awesome.css',
        '../theme/bootstrap/css/bootstrap.css',
        '../theme/bootstrap/css/bootstrap-theme.css',
    ], 'public/assets/css/plugins.min.css');

    // PLUGIN JS
    mix.scripts([
        '../theme/bootstrap/js/bootstrap.min.js'
    ], 'public/assets/theme/bootstrap/js/bootstrap.min.js');

    mix.scripts([
        '../js/plugins/handlebars.js',
    ], 'public/assets/js/plugins/handlebars.min.js');
    mix.scripts([
        '../js/plugins/handlebars-helpers.js',
    ], 'public/assets/js/plugins/handlebars-helpers.min.js');
    mix.scripts([
        '../js/plugins/moment.min.js',
    ], 'public/assets/js/plugins/moment.min.js');
    mix.scripts([
         '../js/plugins/require.min.js',
    ], 'public/assets/js/plugins/require.min.js');

    // YOYO JS
    mix.scripts([
         '../js/plugins/handlebars-helpers.js',
    ], 'public/assets/js/plugins/handlebars-helpers.min.js');
    mix.scripts([
        '../theme/yoyo/js/app.js',
    ], 'public/assets/theme/yoyo/js/app.js');
    mix.scripts([
        '../theme/yoyo/js/main.js',
    ], 'public/assets/theme/yoyo/js/main.js');
    mix.scripts([
        '../theme/yoyo/js/controllers/notesController.js',
    ], 'public/assets/theme/yoyo/js/controllers/notesController.min.js');
    mix.scripts([
        '../theme/yoyo/js/controllers/todosController.js',
    ], 'public/assets/theme/yoyo/js/controllers/todosController.min.js');
});
