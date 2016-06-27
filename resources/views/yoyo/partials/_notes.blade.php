<div class="row">
    <div class="col-md-12">
        <section id="notes-form" class="prepend-top">
            <form id="form-notes" action="{{route('yoyo.notes.store')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="_method" value="post">

                <div class="form-group {{($errors->has('txtNoteTitle')) ? 'has-error' : ''}}">
                    <label for="txtNoteTitle" class="control-label">Notes Title</label>
                    <input type="text" name="txtNoteTitle" id="txtNoteTitle" class="form-control" placeholder="Title" required maxlength="255" value="{{old('txtNoteTitle')}}" />
                </div>
                <div class="form-group {{($errors->has('txtNoteText')) ? 'has-error' : ''}}">
                    <label for="txtNoteText" class="control-label">Notes Text</label>
                    <textarea name="txtNoteText" id="txtNoteText" class="form-control" placeholder="Text" required>{{old('txtNoteText')}}</textarea>
                </div>
                <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary pull-right">Add Note</button>
            </form>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <section id="notes-timeline" class="prepend-top"></section>
    </div>
</div>

<script id="notes-template" type="text/x-handlebars-template">
    @{{#each results}}
        <article>
            <span class="date">@{{helperFormatDate created_date "YYYY-MM-DD" "MM/DD/YYYY"}}</span>
            <span class="time">@{{helperFormatDate created_date "HH:mm:ss" "hh:mm A"}}</span>
            <div class="timeline-content">
                <i class="fa fa-clock-o"></i>
                <p><strong><a href="/notes/@{{note_id}}/edit/" class="note-title">@{{note_title}}</a></strong></p>
                <p class="note-text">@{{note_text}}</p>
                <p><small><a href="/note-to-todo/@{{note_id}}" class="note-to-todo">Convert as Todo</a> | <a href="delete-note/@{{note_id}}" class="delete-note">Delete</a></small></p>
                <input type="hidden" name="hfNoteId" class="hfNoteId" value="@{{note_id}}" />
            </div>
        </article>
    @{{/each}}
</script>