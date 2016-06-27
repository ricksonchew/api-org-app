<?php
namespace App\Models;

use App\Models\BaseModel;

class YoyoNotesModel extends BaseModel
{

    private $_apiUrl = [
        'yoyo-notes'        => 'yoyo-notes/yoyo-notes',
    ];

    /**
     * Retrieve data from yoyo_notes table.
     * @param $params array
     * @return json array object
     */
    public function getNotes($params = [])
    {
        return $this->validateApiReturn($this->ws->get($this->_apiUrl['yoyo-notes'], $params));
    }

    /**
     * Insert data to yoyo_notes table
     * @param $param array
     * @return array
     */
    public function insertNotes($params)
    {
        return $this->validateApiReturn($this->ws->post($this->_apiUrl['yoyo-notes'], $this->buildCreation($params)));
    }

    /**
     * Update data from yoyo_notes table
     * @param $param array
     * @return array
     */
    public function updateNotes($params = [])
    {
        return $this->validateApiReturn($this->ws->put($this->_apiUrl['yoyo-notes'], $this->buildModified($params)));
    }

    /**
     * Delete data from yoyo_notes table
     * @param $param array
     * @return array
     */
    public function deleteNotes($params = []) {
        return $this->validateApiReturn($this->ws->delete($this->_apiUrl['yoyo-notes'], $params));
    }
}