define(['handlebars', 'handlebarsHelpers'], function(Handlebars, handlebarHelpers) {
    var notesController = function() {
        var notesCtrl = {
            init: function() {
                this.cacheDom();
                this.ajaxLoadForm();
                this.onFormSubmit();
            },
            cacheDom: function() {
                this.$txtNoteTitle = $('#txtNoteTitle');
                this.$txtNoteText = $('#txtNoteText');
                this.$todo = $('#todos');
                this.$notes = $('#notes');
                this.$form = $('#form-notes');
                this.$formBtn = $('#notes-form #btnSubmit');
                this.$modal = $('#yoyoModal');
                this.$formModal = $('#formNotesModal');
                this.$formNotesModal = $('#form-notes-modal');
                this.$notesTimeline = $('#notes-timeline');
                this.$todoTimeline = $('#todo-timeline');
            },
            loadModalMessage: function(msg) {
                this.$modal.find('.modal-body span').text(msg);
                this.$modal.modal('show');
                this.ajaxLoadForm();
                setTimeout(function() {
                    notesCtrl.$modal.modal('hide');
                }, 2000);
            },
            ajaxLoadForm: function() {
                $.ajax({
                    url: this.$notes.data('ajax-url'),
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function() {
                        notesCtrl.$notesTimeline.html('<p class="text-center">Loading content...</p>');
                    }
                }).done(function(data) {
                    var template = $('#notes-template');
                    var source   = template.html();
                    var template = Handlebars.compile(source);

                    if (typeof data.results  !== 'undefined') {
                        notesCtrl.$notesTimeline.html(template(data));
                        notesCtrl.onConversion();
                        notesCtrl.onDelete();
                        notesCtrl.onUpdate();
                    }
                });
            },
            ajaxLoadTodoForm: function() {
                $.ajax({
                    url: this.$todo.data('ajax-url'),
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function() {
                        notesCtrl.$todoTimeline.html('<p class="text-center">Loading content...</p>');
                    }
                }).done(function(data) {
                    var template = $('#todo-template');
                    var source   = template.html();
                    var template = Handlebars.compile(source);

                    if (typeof data.results  !== 'undefined') {
                        notesCtrl.$todoTimeline.html(template(data));
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
                    var template = $('#notes-template');
                    var source   = template.html();
                    var template = Handlebars.compile(source);

                    if (typeof data.transaction !== 'undefined') {
                        if (data.transaction) {
                            notesCtrl.$txtNoteTitle.val('');
                            notesCtrl.$txtNoteText.val('');
                            notesCtrl.loadModalMessage(data.message);
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
                        notesCtrl.$notesTimeline.html('<p class="text-center">Processing conversion...</p>');
                    }
                }).done(function(data) {
                    if (typeof data.transaction !== 'undefined') {
                        if (data.transaction) {
                            notesCtrl.ajaxLoadTodoForm();
                            notesCtrl.loadModalMessage(data.message);
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
                        notesCtrl.$notesTimeline.html('<p class="text-center">Deleting item...</p>');
                    }
                }).done(function(data) {
                    if (typeof data.transaction !== 'undefined') {
                        if (data.transaction) {
                            notesCtrl.ajaxLoadTodoForm();
                            notesCtrl.loadModalMessage(data.message);
                        }
                    }
                }).error(function() {
                    alert('Error');
                });
            },
            ajaxUpdate: function() {
                $.ajax({
                    url: this.$formNotesModal.attr('action'),
                    dataType: 'json',
                    type: 'post',
                    data: this.$formNotesModal.serialize(),
                }).done(function(data) {
                    if (typeof data.transaction !== 'undefined') {
                        if (data.transaction) {
                            notesCtrl.loadModalMessage(data.message);
                        }
                    }
                }).always(function() {
                    notesCtrl.$formModal.modal('hide');
                }).error(function() {
                    alert('Error');
                });
            },
            onConversion: function() {
                $(document).on('click', 'a.note-to-todo', function(e) {
                    e.stopImmediatePropagation();
                    e.preventDefault();

                    notesCtrl.ajaxConversion($(this));
                });
            },
            onDelete: function() {
                $(document).on('click', 'a.delete-note', function(e) {
                    e.stopImmediatePropagation();
                    e.preventDefault();

                    notesCtrl.ajaxDelete($(this));
                });
            },
            onUpdate: function() {
                var formAction = this.$formNotesModal.attr('action');

                $(document).on('click', 'a.note-title', function(e) {
                    var $this = $(this);
                    var $timelineContainer = $this.parents('.timeline-content');
                    var formActionUpdateUrl = formAction + '/' + $timelineContainer.find('.hfNoteId').val();

                    e.stopImmediatePropagation();
                    e.preventDefault();

                    notesCtrl.$formNotesModal.attr('action', formActionUpdateUrl);
                    notesCtrl.$formNotesModal.find('#txtNoteTitle').val($this.text());
                    notesCtrl.$formNotesModal.find('#txtNoteText').val($timelineContainer.find('.note-text').text());

                    notesCtrl.$formModal.modal('show');
                });
                this.$formNotesModal.submit(function(e){
                    e.preventDefault();
                    notesCtrl.ajaxUpdate();
                });
            },
            onFormSubmit: function() {
                this.$form.submit(function(e){
                    e.preventDefault();
                    notesCtrl.ajaxSubmitForm();
                });
            }
        }

        notesCtrl.init();
    }

    return notesController;
});