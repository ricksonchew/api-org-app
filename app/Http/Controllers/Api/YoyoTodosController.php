<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\CoreController;

class YoyoTodosController extends CoreController
{
    const TABLE_NAME = 'yoyo_todos';

    private $_columns = [
        'todo_id' => '',
        'todo_title' => '',
        'todo_text' => '',
        'is_done' => 0,
        'created_date' => null,
        'modified_date' => null,
    ];
    private $_primaryKey = 'todo_id';
    private $_foreignKeys = '';

    /**
     * Get todos
     * @return json
     */
    public function getYoyoTodos(Request $request)
    {
        try {
            $allParams = $request->all();
            $params = array_intersect_key($allParams, $this->_columns);

            $sqlQuery = $this->sqlConnection->table(self::TABLE_NAME);
            $sqlQuery->orderBy('created_date', 'desc');
            $sqlQuery->where($params);

        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $sqlQuery->get();
    }

    /**
     * Insert data to yoyo_todos table
     * @param array $sqlParams
     * @return boolean
     */
    public function insertYoyoTodos(Request $request)
    {
        $params = array_intersect_key($request->all(), $this->_columns);
        $this->sqlConnection->beginTransaction();

        try {
            $this->sqlConnection->table(self::TABLE_NAME)->insert($params);
            $this->sqlConnection->commit();

            return response($this->getCustomMessages()['API_TRANS_SUCCESS'], 200);
        } catch (Exception $e) {
            $this->sqlConnection->rollback();
            return response($this->getCustomMessages()['API_INSERT_ERROR'], 400);
        }
    }

    /**
     * Delete data from yoyo_todos table
     * @param array $sqlParams
     * @return boolean
     */
    public function deleteYoyoTodos(Request $request)
    {
        $params = array_intersect_key($request->all(), $this->_columns);
        $this->sqlConnection->beginTransaction();

        try {
            if (!array_key_exists($this->_primaryKey, $this->_columns)) throw new Exception();
            $pkValue = $params[$this->_primaryKey];

            $this->sqlConnection->table(self::TABLE_NAME)->where($this->_primaryKey, $pkValue)->delete();
            $this->sqlConnection->commit();

            return response($this->getCustomMessages()['sysMsgApiTransactionSuccess'], 200);
        } catch (Exception $e) {
            $this->sqlConnection->rollback();
            return response($this->getCustomMessages()['sysMsgApiDeleteError'], 400);
        }
    }

    /**
     * Update data of yoyo_todos table
     * @param array $sqlParams
     * @return boolean
     */
    public function updateYoyoTodos(Request $request)
    {
        $params = array_intersect_key($request->all(), $this->_columns);
        $this->sqlConnection->beginTransaction();

        try {
            if (!array_key_exists($this->_primaryKey, $this->_columns)) throw new Exception();
            $pkValue = $params[$this->_primaryKey];

            $this->sqlConnection->table(self::TABLE_NAME)->where($this->_primaryKey, $pkValue)->update($params);
            $this->sqlConnection->commit();

            return response($this->getCustomMessages()['sysMsgApiTransactionSuccess'], 200);
        } catch (Exception $e) {
            $this->sqlConnection->rollback();
            return response($this->getCustomMessages()['sysMsgApiUpdateError'], 400);
        }
    }
}