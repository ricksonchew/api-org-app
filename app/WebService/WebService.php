<?php
namespace App\WebService;

class WebService extends RestClient {

    protected $_webService;

    /**
     * Get table record(s)
     * @param array
     * @return json
     */
    public function get($apiUrl, $params = [])
    {
        return $this->connect($apiUrl, $params, __FUNCTION__);
    }

    /**
     * Insert table record(s)
     * @param array
     * @return json
     */
    public function put($apiUrl, $params = [])
    {
        return $this->connect($apiUrl, $params, __FUNCTION__);
    }

    /**
     * Update table record(s)
     * @param array
     * @return json
     */
    public function post($apiUrl, $params = [])
    {
        return $this->connect($apiUrl, $params, __FUNCTION__);
    }

    /**
     * Delete table record(s)
     * @param array
     * @return json
     */
    public function delete($apiUrl, $params = [])
    {
        return $this->connect($apiUrl, $params, __FUNCTION__);
    }

}