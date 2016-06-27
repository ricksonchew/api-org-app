<?php
/*
THROW EXCEPTION ERROR CODES
---------------------------
0 - Application Error (missing configurations, etc)

*/


return array(
    // SYS MESSAGE
    'sysMsgTodoToNoteSuccess'  => 'Successfully converted todo to a note.',
    'sysMsgNoteToTodoSuccess'  => 'Successfully converted note to a todo.',
    'sysMsgNoRecordsRetrieved' => 'No records retrieved.',
    'sysMsgSaveSuccess'        => 'Save successful.',
    'sysMsgDeleteSuccess'      => 'Delete successful.',

    // API MESSAGE
    'sysMsgApiError'              => 'An error occured while executing the query.',
    'sysMsgApiTransactionSuccess' => 'API_TRANS_SUCCESS',

    'API_NO_RECORDS'       => 'No record(s) retrieved.',
    'API_TRANS_SUCCESS'    => 'API_TRANS_SUCCESS',
    'API_TRANS_ERROR'      => 'An error occured while executing the query.',
    'API_INSERT_ERROR'     => 'An error occured while executing the query.',
    'API_UPDATE_ERROR'     => 'An error occured while executing the query.',
    'API_DELETE_ERROR'     => 'An error occured while executing the query.',
    'API_ERROR_UNEXPECTED' => 'Your application isn\'t configured properly.',
);