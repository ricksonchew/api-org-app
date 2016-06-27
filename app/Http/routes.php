<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function() {
    Route::get('/', 'Yoyo\HomeController@index');
    Route::get('/api', 'Api\ApiController@index');

    // NOTES
    $namePrefix = 'yoyo.notes';
    Route::resource('notes', 'Yoyo\NotesController', [
        'except' => [
            'show',
            'create',
            'destroy',
            'edit',
        ],
        'names' => [
            'index'   => $namePrefix . '.index',
            'store'   => $namePrefix . '.store',
            'update'  => $namePrefix . '.update',
        ]
    ]);
    Route::get('delete-note/{id}', ['as' => $namePrefix . '.destroy', 'uses' => 'Yoyo\NotesController@destroy']);
    Route::get('note-to-todo/{id}', 'Yoyo\NotesController@noteToTodo');

    // TODO
    $namePrefix = 'yoyo.todo';
    Route::resource('todo', 'Yoyo\TodoController', [
        'except' => [
            'show',
            'create',
            'destroy',
            'edit',
        ],
        'names' => [
            'index'   => $namePrefix . '.index',
            'store'   => $namePrefix . '.store',
            'update'  => $namePrefix . '.update',
        ]
    ]);
    Route::get('delete-todo/{id}', ['as' => $namePrefix . '.destroy', 'uses' => 'Yoyo\TodoController@destroy']);
    Route::get('todo-to-note/{id}', 'Yoyo\TodoController@todoToNote');
    Route::post('todo-status/', ['as' => $namePrefix . '.todo-status', 'uses' => 'Yoyo\TodoController@todoStatus']);

    // API - YOYO_NOTES - CRUD
    Route::get('api/yoyo/api-yoyo-notes/yoyo-notes', 'Api\YoyoNotesController@getYoyoNotes');
    Route::put('api/yoyo/api-yoyo-notes/yoyo-notes', 'Api\YoyoNotesController@updateYoyoNotes');
    Route::post('api/yoyo/api-yoyo-notes/yoyo-notes', 'Api\YoyoNotesController@insertYoyoNotes');
    Route::delete('api/yoyo/api-yoyo-notes/yoyo-notes', 'Api\YoyoNotesController@deleteYoyoNotes');

    // API - YOYO_TODOS - CRUD
    Route::get('api/yoyo/api-yoyo-todos/yoyo-todos', 'Api\YoyoTodosController@getYoyoTodos');
    Route::put('api/yoyo/api-yoyo-todos/yoyo-todos', 'Api\YoyoTodosController@updateYoyoTodos');
    Route::post('api/yoyo/api-yoyo-todos/yoyo-todos', 'Api\YoyoTodosController@insertYoyoTodos');
    Route::delete('api/yoyo/api-yoyo-todos/yoyo-todos', 'Api\YoyoTodosController@deleteYoyoTodos');
});