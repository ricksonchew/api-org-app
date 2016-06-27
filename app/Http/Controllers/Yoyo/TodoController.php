<?php

namespace App\Http\Controllers\Yoyo;

use Illuminate\Http\Request;
use App\Http\Controllers\Yoyo\CoreController;
use App\Models\YoyoNotesModel;
use function GuzzleHttp\json_encode;
use App\Models\YoyoTodosModel;
use App\Http\Requests\TodoStoreRequest;

class TodoController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(YoyoTodosModel $todoModel, Request $request)
    {
        $todos = [];

        if ($request->ajax()) {
            $todos = $todoModel->getTodos();
        } else {
            return redirect($this->getBaseUrl());
        }

        return ['results' => $todos];
    }

    /**
     * Conversion of a todo to a note
     * @param string $todoId
     * @param YoyoNotesModel $notesModel
     * @param YoyoTodosModel $todoModel
     * @return string
     */
    public function todoToNote($todoId, YoyoNotesModel $notesModel, YoyoTodosModel $todoModel)
    {
        $transaction = false;
        $message = $this->getCustomMessages()['sysMsgApiError'];

        $todo = $todoModel->getTodos(['todo_id' => $todoId]);
        if (is_array($todo) && !empty($todo)) {
            $todo = current($todo);
            $transaction = $notesModel->insertNotes([
                'note_title' => $todo['todo_title'],
                'note_text' => $todo['todo_text'],
            ]);

            if ($transaction) {
                $transaction = $todoModel->deleteTodos(['todo_id' => $todoId]);
                $message = $this->getCustomMessages()['sysMsgTodoToNoteSuccess'];
            }
        }

        return json_encode([
            'transaction' => $transaction,
            'message'     => $message,
        ]);
    }

    /**
     * Update todo status
     * @param Request $request
     * @param YoyoTodosModel $todoModel
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|string
     */
    public function todoStatus(Request $request, YoyoTodosModel $todoModel)
    {
        $transaction = false;
        $message = $this->getCustomMessages()['sysMsgApiError'];

        if ($request->ajax()) {
            $transaction = $todoModel->updateTodos([
                'todo_id' => $request->get('todo_id'),
                'is_done' => filter_var($request->get('is_done'), FILTER_VALIDATE_BOOLEAN),
            ]);

            $message = $this->getCustomMessages()['sysMsgSaveSuccess'];
        } else {
            return redirect($this->getBaseUrl());
        }

        return json_encode([
            'transaction' => $transaction,
            'message' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoStoreRequest $todoRequest, YoyoTodosModel $todoModel)
    {
        $transaction = $todoModel->insertTodos([
            'todo_title' => $todoRequest->get('txtTodoTitle'),
            'todo_text' => $todoRequest->get('txtTodoText'),
        ]);

        $message = ($transaction) ? $this->getCustomMessages()['sysMsgSaveSuccess'] : $this->getCustomMessages()['sysMsgApiError'];

        return json_encode([
            'transaction' => $transaction,
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $todoId
     * @return \Illuminate\Http\Response
     */
    public function update(TodoStoreRequest $todoRequest, YoyoTodosModel $todoModel, $todoId)
    {
        $transaction = false;
        $message = $this->getCustomMessages()['sysMsgApiError'];

        if ($todoRequest->ajax()) {
            $transaction = $todoModel->updateTodos([
                'todo_id' => $todoId,
                'todo_title' => $todoRequest->get('txtTodoTitle'),
                'todo_text' => $todoRequest->get('txtTodoText'),
            ]);

            $message = ($transaction) ? $this->getCustomMessages()['sysMsgSaveSuccess'] : $this->getCustomMessages()['sysMsgApiError'];
        } else {
            return redirect($this->getBaseUrl());
        }

        return json_encode([
            'transaction' => $transaction,
            'message' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(YoyoTodosModel $todosModel, Request $request, $todoId)
    {
        $transaction = false;
        $message = $this->getCustomMessages()['sysMsgApiError'];

        if ($request->ajax()) {
            $transaction = ['results' => $todosModel->deleteTodos(['todo_id' => $todoId])];
            $message = $this->getCustomMessages()['sysMsgDeleteSuccess'];
        } else {
            return redirect($this->getBaseUrl());
        }

        return json_encode([
            'transaction' => $transaction,
            'message' => $message
        ]);
    }
}
