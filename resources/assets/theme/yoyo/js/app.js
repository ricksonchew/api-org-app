var assetsUrl     = 'assets/js/',
    baseUrl       = document.getElementById('hfBaseUrl').value,
    jsAssetsUrl   = baseUrl + assetsUrl,
    jsCoreUrl     = jsAssetsUrl + 'core/',
    jsPluginsUrl  = jsAssetsUrl + 'plugins/',
    jsThemeUrl    = jsAssetsUrl + '../theme/',
    jsControllers = jsAssetsUrl + 'controllers/';

requirejs.config({
    'baseUrl': 'assets/js/core', // Place all js core dependencies.
    'paths': { // Path where this file is located
        'jquery' : jsCoreUrl + 'jquery',

        // single JS plugin
        'bootstrap'  : jsThemeUrl + 'bootstrap/js/bootstrap.min',
        'handlebars' : jsPluginsUrl + 'handlebars.min',
        'handlebarsHelpers' : jsPluginsUrl + 'handlebars-helpers.min',
        'moment' : jsPluginsUrl + 'moment.min',

        // multiple JS depency plugin
        'main' : jsThemeUrl + 'yoyo/js/main',

        // controllers
        'notesController' : jsThemeUrl + 'yoyo/js/controllers/notesController.min',
        'todosController' : jsThemeUrl + 'yoyo/js/controllers/todosController.min',
    },
    'shim' : {
        'bootstrap': {
            deps: ['jquery']
        },
        'main': {
            deps: [
                'jquery'
            ]
        }
    }
});

// Load the main script. Path is relative to the path specified on the 'paths/app' config above.
requirejs([
    'bootstrap',
    'main',
]);