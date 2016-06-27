require([
    'jquery',
    'notesController',
    'todosController'
],  function (
    $,
    notesController,
    todosController
) {
    $('[data-controller]').each(function(e, t) {
        var dataControllers = $(t).attr('data-controller').split('|');
        $.each(dataControllers, function(index, value) {
            if (value == 'notesController') {
                notesController();
            } else if (value == 'todosController') {
                todosController();
            }
        });
    });
});