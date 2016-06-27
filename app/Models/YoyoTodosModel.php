<?php
namespace App\Models;

use App\Models\BaseModel;

class YoyoTodosModel extends BaseModel
{

    private $_apiUrl = [
        'yoyo-todos'        => 'yoyo-todos/yoyo-todos',
    ];

    /**
     * Retrieve data from yoyo_todos table.
     * @param $params array
     * @return json array object
     */
    public function getTodos($params = [])
    {
        return $this->validateApiReturn($this->ws->get($this->_apiUrl['yoyo-todos'], $params));
    }

    /**
     * Insert data to yoyo_todos table
     * @param $param array
     * @return array
     */
    public function insertTodos($params)
    {
        return $this->validateApiReturn($this->ws->post($this->_apiUrl['yoyo-todos'], $this->buildCreation($params)));
    }

    /**
     * Update data from yoyo_todos table
     * @param $param array
     * @return array
     */
    public function updateTodos($params = [])
    {
        return $this->validateApiReturn($this->ws->put($this->_apiUrl['yoyo-todos'], $this->buildModified($params)));
    }

    /**
     * Delete data from yoyo_todos table
     * @param $param array
     * @return array
     */
    public function deleteTodos($params = []) {
        return $this->validateApiReturn($this->ws->delete($this->_apiUrl['yoyo-todos'], $params));
    }
}