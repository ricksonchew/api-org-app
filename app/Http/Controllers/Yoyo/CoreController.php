<?php

namespace App\Http\Controllers\Yoyo;

use URL;
use App\Http\Controllers\Controller;

class CoreController extends Controller
{
    private $_config;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->viewShare();
    }

    /**
     * Load global view variables
     */
    public function viewShare()
    {
        $htmlData = [
            'baseUrl' => $this->getBaseUrl()
        ];

        view()->share(array_merge($htmlData, $this->_loadAssetsUrl()));
    }

    /**
     * Load assets url base on the config file
     * @return array
     */
    private function _loadAssetsUrl()
    {
        $htmlData = [];
        $config = $this->getConfig();

        foreach ($config['assetsUrls'] as $key => $value) {
            $htmlData[$key] = $this->getAssetsUrl() . $value;
        }

        return $htmlData;
    }

    /**
     * Get base url
     * @return string
     */
    protected function getBaseUrl()
    {
        return URL::to('/') . '/';
    }

    /**
     * Set assets url
     */
    protected function getAssetsUrl()
    {
        return $this->getBaseUrl() . 'assets/';
    }

    /**
     * Get custom configuration file
     * @return array
     */
    protected function getConfig()
    {
        return config('yoyo.config');
    }

    /**
     * Get custom messages
     * @return array
     */
    protected function getCustomMessages()
    {
        return trans('customMessages');
    }
}
