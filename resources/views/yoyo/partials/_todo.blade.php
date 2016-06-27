<div class="row">
    <div class="col-md-12">
        <section id="todo-form" class="prepend-top">
            <form id="form-todo" action="{{route('yoyo.todo.store')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="_method" value="post">

                <div class="form-group {{($errors->has('txtTodoTitle')) ? 'has-error' : ''}}">
                    <label for="txtTodoTitle" class="control-label">Todo Title</label>
                    <input type="text" name="txtTodoTitle" id="txtTodoTitle" class="form-control" placeholder="Title" required maxlength="255" value="{{old('txtTodoTitle')}}" />
                </div>
                <div class="form-group {{($errors->has('txtTodoText')) ? 'has-error' : ''}}">
                    <label for="txtTodoText" class="control-label">Todo Text</label>
                    <textarea name="txtTodoText" id="txtTodoText" class="form-control" placeholder="Text" required>{{old('txtTodoText')}}</textarea>
                </div>
                <button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary pull-right">Add Todo</button>
            </form>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <section id="todo-timeline" class="prepend-top" data-ajax-url="{{route('yoyo.todo.todo-status')}}"></section>
    </div>
</div>

<script id="todo-template" type="text/x-handlebars-template">
    @{{#each results}}
        <article>
            <div class="todo-container @{{#if is_done}} bg-success @{{/if}}">
                <input type="checkbox" name="cbxIsDone[]" class="cbx-is-done" value="@{{todo_id}}" @{{#if is_done}} checked @{{/if}} />
                @{{#if is_done}}
                    <strike><a href="/todo/@{{todo_id}}/edit/" class="todo-title">@{{todo_title}}</a></strike>
                    <strike><p class="todo-text">@{{todo_text}}</p></strike>
                @{{else}}
                    <a href="/todo/@{{todo_id}}/edit/" class="todo-title">@{{todo_title}}</a>
                    <p class="todo-text">@{{todo_text}}</p>
                @{{/if}}
                <input type="hidden" name="hfTodoId" class="hfTodoId" value="@{{todo_id}}" />
                <span><small><a href="/todo-to-note/@{{todo_id}}" class="todo-to-note">Convert as Note</a> | <a href="delete-todo/@{{todo_id}}" class="delete-todo">Delete</a></small></p>
            </div>
        </article>
    @{{/each}}
</script>