<?php

namespace App\Http\Controllers\Yoyo;

use Illuminate\Http\Request;
use App\Http\Controllers\Yoyo\CoreController;
use App\Models\YoyoNotesModel;
use App\Http\Requests\NotesStoreRequest;
use function GuzzleHttp\json_encode;
use App\Models\YoyoTodosModel;

class NotesController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(YoyoNotesModel $notesModel, Request $request)
    {
        if ($request->ajax()) {
            $notes = ['results' => $notesModel->getNotes()];
        } else {
            return redirect($this->getBaseUrl());
        }

        return $notes;
    }

    /**
     * Conversion of a note to a todo
     * @param string $noteId
     * @param YoyoNotesModel $notesModel
     * @param YoyoTodosModel $todoModel
     * @return string
     */
    public function noteToTodo($noteId, YoyoNotesModel $notesModel, YoyoTodosModel $todoModel)
    {
        $transaction = false;
        $message = $this->getCustomMessages()['sysMsgApiError'];

        $note = $notesModel->getNotes(['note_id' => $noteId]);
        if (is_array($note) && !empty($note)) {
            $note = current($note);
            $transaction = $todoModel->insertTodos([
                'todo_title' => $note['note_title'],
                'todo_text' => $note['note_text'],
            ]);

            if ($transaction) {
                $transaction = $notesModel->deleteNotes(['note_id' => $noteId]);
            }
        }

        return json_encode([
            'transaction' => $transaction,
            'message'     => $this->getCustomMessages()['sysMsgNoteToTodoSuccess'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotesStoreRequest $noteRequest, YoyoNotesModel $noteModel)
    {
        $transaction = $noteModel->insertNotes([
            'note_title' => $noteRequest->get('txtNoteTitle'),
            'note_text' => $noteRequest->get('txtNoteText'),
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
     * @param  int  $noteId
     * @return \Illuminate\Http\Response
     */
    public function update(NotesStoreRequest $noteRequest, YoyoNotesModel $notesModel, $noteId)
    {
        $transaction = false;
        $message = $this->getCustomMessages()['sysMsgApiError'];

        if ($noteRequest->ajax()) {
            $transaction = $notesModel->updateNotes([
                'note_id' => $noteId,
                'note_title' => $noteRequest->get('txtNoteTitle'),
                'note_text' => $noteRequest->get('txtNoteText'),
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
    public function destroy(YoyoNotesModel $notesModel, Request $request, $noteId)
    {
        $transaction = false;
        $message = $this->getCustomMessages()['sysMsgApiError'];

        if ($request->ajax()) {
            $transaction = ['results' => $notesModel->deleteNotes(['note_id' => $noteId])];
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