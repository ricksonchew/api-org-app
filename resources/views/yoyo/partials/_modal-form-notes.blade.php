<div id="formNotesModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-notes-modal" action="{{route('yoyo.notes.index')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Details</h4>
                </div>
                <div class="modal-body" class="text-center">
                    <section id="modal-form-section">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="_method" value="patch">

                        <div class="form-group {{($errors->has('txtNoteTitle')) ? 'has-error' : ''}}">
                            <label for="txtNoteTitle" class="control-label">Notes Title</label>
                            <input type="text" name="txtNoteTitle" id="txtNoteTitle" class="form-control" placeholder="Title" required maxlength="255" />
                        </div>
                        <div class="form-group {{($errors->has('txtNoteText')) ? 'has-error' : ''}}">
                            <label for="txtNoteText" class="control-label">Notes Text</label>
                            <textarea name="txtNoteText" id="txtNoteText" class="form-control" placeholder="Text" required></textarea>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary pull-right">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>