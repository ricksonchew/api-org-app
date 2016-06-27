<?php
namespace App\WebService;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RestClient {

    private $_restClient;

    /**
     * Set connection configurations
     */
    private $_config = [
        'object' => true
    ];

    /**
     * Dependency Injection : GuzzleHttp\Client
     */
    public function __construct(Client $restClient)
    {
        $this->_restClient = $restClient;
    }

    /**
     * Connect to ReST API
     * @return json
     */
    public function connect($apiUrl, $args, $response)
    {
        try {
            $sysMsg = trans('customMessages');

            if ($response == 'get') {
                $params['query'] = $args;
            } else {
                $params['form_params'] = $args;
            }

            $apiResponse = $this->_restClient->request($response, env('API_URL') . env('API_PREFIX') . $apiUrl, $params)->getBody();

            return ($apiResponse == $sysMsg['sysMsgApiTransactionSuccess']) ? true : json_decode($apiResponse, true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) throw new Exception($errMessage = (env('APP_ENV') == 'local') ? $e->getMessage() : $sysMsg['sysMsgApiError']);
        }
    }

}