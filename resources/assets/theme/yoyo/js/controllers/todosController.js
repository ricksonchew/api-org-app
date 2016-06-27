define(['handlebars', 'handlebarsHelpers'], function(Handlebars, handlebarHelpers) {
    var todoController = function() {
        var todoCtrl = {
            init: function() {
                this.cacheDom();
                this.ajaxLoadForm();
                this.onFormSubmit();
            },
            cacheDom: function() {
                this.$txtTodoTitle = $('#txtTodoTitle');
                this.$txtTodoText = $('#txtTodoText');
                this.$todo = $('#todos');
                this.$notes = $('#notes');
                this.$form = $('#form-todo');
                this.$formBtn = $('#todo-form #btnSubmit');
                this.$modal = $('#yoyoModal');
                this.$formModal = $('#formTodoModal');
                this.$formTodoModal = $('#form-todo-modal');
                this.$todoTimeline = $('#todo-timeline');
                this.$notesTimeline = $('#notes-timeline');
            },
            loadModalMessage: function(msg) {
                this.$modal.find('.modal-body span').text(msg);
                this.$modal.modal('show');
                this.ajaxLoadForm();
                setTimeout(function() {
                    todoCtrl.$modal.modal('hide');
                }, 2000);
            },
            ajaxLoadForm: function() {
                $.ajax({
                    url: this.$todo.data('ajax-url'),
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function() {
                        todoCtrl.$todoTimeline.html('<p class="text-center">Loading content...</p>');
                    }
                }).done(function(data) {
                    var template = $('#todo-template');
                    var source   = template.html();
                    var template = Handlebars.compile(source);

                    if (typeof data.results  !== 'undefined') {
                        todoCtrl.$todoTimeline.html(template(data));
                        todoCtrl.onConversion();
                        todoCtrl.onDelete();
                        todoCtrl.todoAction();
                        todoCtrl.onUpdate();
                    }
                });
            },
            ajaxLoadNotesForm: function() {
                $.ajax({
                    url: this.$notes.data('ajax-url'),
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function() {
                        todoCtrl.$notesTimeline.html('<p class="text-center">Loading content...</p>');
                    }
                }).done(function(data) {
                    var template = $('#notes-template');
                    var source   = template.html();
                    var template = Handlebars.compile(source);

                    if (typeof data.results  !== 'undefined') {
                        todoCtrl.$notesTimeline.html(template(data));
                    }
                });
            },
            ajaxSubmitForm: function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: this.$form.attr('action'),
                    type: 'post',
                    data: this.$form.serialize(),
                    dataType: 'json',
                }).done(function(data) {
                    var template = $('#todo-template');
                    var source   = template.html();
                    var template = Handlebars.compile(source);

                    if (typeof data.transaction !== 'undefined') {
                        if (data.transaction) {
                            todoCtrl.$txtTodoTitle.val('');
                            todoCtrl.$txtTodoText.val('');
                            todoCtrl.$modal.find('.modal-body span').text(data.message);
                            todoCtrl.$modal.modal('show');
                            todoCtrl.ajaxLoadForm();
                            setTimeout(function() {
                                todoCtrl.$modal.modal('hide');
                            }, 2000);
                        }
                    }
                }).error(function() {
                    alert('Error');
                });
            },
            ajaxConversion: function(el) {
                $.ajax({
                    url: el.attr('href'),
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function() {
                        todoCtrl.$todoTimeline.html('<p class="text-center">Processing conversion...</p>');
                    }
                }).done(function(data) {
                    if (typeof data.transaction !== 'undefined') {
                        if (data.transaction) {
                            todoCtrl.$modal.find('.modal-body span').text(data.message);
                            todoCtrl.$modal.modal('show');
                            todoCtrl.ajaxLoadForm();
                            todoCtrl.ajaxLoadNotesForm();
                            setTimeout(function() {
                                todoCtrl.$modal.modal('hide');
                            }, 2000);
                        }
                    }
                }).error(function() {
                    alert('Error');
                });
            },
            ajaxDelete: function(el) {
                $.ajax({
                    url: el.attr('href'),
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function() {
                        todoCtrl.$todoTimeline.html('<p class="text-center">Deleting item...</p>');
                    }
                }).done(function(data) {
                    if (typeof data.transaction !== 'undefined') {
                        if (data.transaction) {
                            todoCtrl.$modal.find('.modal-body span').text(data.message);
                            todoCtrl.$modal.modal('show');
                            todoCtrl.ajaxLoadForm();
                            todoCtrl.ajaxLoadNotesForm();
                            setTimeout(function() {
                                todoCtrl.$modal.modal('hide');
                            }, 2000);
                        }
                    }
                }).error(function() {
                    alert('Error');
                });
            },
            ajaxUpdate: function() {
                $.ajax({
                    url: this.$formTodoModal.attr('action'),
                    dataType: 'json',
                    type: 'post',
                    data: this.$formTodoModal.serialize(),
                }).done(function(data) {
                    if (typeof data.transaction !== 'undefined') {
                        if (data.transaction) {
                            todoCtrl.loadModalMessage(data.message);
                        }
                    }
                }).always(function() {
                    todoCtrl.$formModal.modal('hide');
                }).error(function() {
                    alert('Error');
                });
            },
            onConversion: function() {
                $(document).on('click', 'a.todo-to-note', function(e) {
                    e.stopImmediatePropagation();
                    e.preventDefault();

                    todoCtrl.ajaxConversion($(this));
                });
            },
            onDelete: function() {
                $(document).on('click', 'a.delete-todo', function(e) {
                    e.stopImmediatePropagation();
                    e.preventDefault();

                    todoCtrl.ajaxDelete($(this));
                });
            },
            onUpdate: function() {
                var formAction = this.$formTodoModal.attr('action');

                $(document).on('click', 'a.todo-title', function(e) {
                    var $this = $(this);
                    var $timelineContainer = $this.closest('.todo-container');
                    var formActionUpdateUrl = formAction + '/' + $timelineContainer.find('.hfTodoId').val();

                    e.stopImmediatePropagation();
                    e.preventDefault();

                    todoCtrl.$formTodoModal.attr('action', formActionUpdateUrl);
                    todoCtrl.$formTodoModal.find('#txtTodoTitle').val($this.text());
                    todoCtrl.$formTodoModal.find('#txtTodoText').val($timelineContainer.find('.todo-text').text());

                    todoCtrl.$formModal.modal('show');
                });
                this.$formTodoModal.submit(function(e){
                    e.preventDefault();
                    todoCtrl.ajaxUpdate();
                });
            },
            ajaxTodo: function(el, elVal, elIsChecked, elContainer) {
                $.ajax({
                    url: this.$todoTimeline.data('ajax-url'),
                    dataType: 'json',
                    type: 'post',
                    data: {todo_id: elVal, is_done: elIsChecked},
                }).done(function(data) {
                    if (typeof data.transaction !== 'undefined') {
                        var $todoContainer = el.closest('.todo-container');
                        var $noteTitle = $todoContainer.find('.todo-title');
                        var $noteText = $todoContainer.find('p');

                        if (elIsChecked) {
                            $todoContainer.addClass('bg-success');
                            $noteTitle.wrap('<strike></strike>');
                            $noteText.wrap('<strike></strike>');
                        } else {
                            $todoContainer.removeClass('bg-success');
                            $noteTitle.unwrap();
                            $noteText.unwrap();
                        }
                    }
                }).error(function() {
                    alert('Error;')
                });
            },
            todoAction: function() {
                var el;

                $(document).on('click', '.cbx-is-done', function() {
                    el = $(this);
                    todoCtrl.ajaxTodo(el, el.val(), el.prop('checked'), todoCtrl.$todoTimeline);
                });
            },
            onFormSubmit: function() {
                this.$form.submit(function(e){
                    e.preventDefault();
                    todoCtrl.ajaxSubmitForm();
                });
            }
        }

        todoCtrl.init();
    }

    return todoController;
});