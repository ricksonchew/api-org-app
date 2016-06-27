@extends('yoyo.layout.master')

@section('content')
    <div class="prepend-top">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#notes-tab" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
            <li role="presentation"><a href="#todo-tab" aria-controls="todo" role="tab" data-toggle="tab">Todo</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="notes-tab">
                <section id="notes" data-controller="notesController" data-ajax-url="{{route('yoyo.notes.index')}}">
                    @include('yoyo.partials._notes')
                </section>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="todo-tab">
                <section id="todos" data-controller="todosController" data-ajax-url="{{route('yoyo.todo.index')}}">
                    @include('yoyo.partials._todo')
                </section>
            </div>
        </div>
    </div>
@endsection