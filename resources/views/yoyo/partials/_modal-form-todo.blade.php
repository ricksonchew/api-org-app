<div id="formTodoModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-todo-modal" action="{{route('yoyo.todo.index')}}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Details</h4>
                </div>
                <div class="modal-body" class="text-center">
                    <section id="modal-form-section">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="_method" value="patch">

                        <div class="form-group {{($errors->has('txtTodoTitle')) ? 'has-error' : ''}}">
                            <label for="txtTodoTitle" class="control-label">Todo Title</label>
                            <input type="text" name="txtTodoTitle" id="txtTodoTitle" class="form-control" placeholder="Title" required maxlength="255" />
                        </div>
                        <div class="form-group {{($errors->has('txtTodoText')) ? 'has-error' : ''}}">
                            <label for="txtTodoText" class="control-label">Todo Text</label>
                            <textarea name="txtTodoText" id="txtTodoText" class="form-control" placeholder="Text" required></textarea>
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