<?php
namespace App\Models;

use App\WebService\WebService;

class BaseModel
{
    protected $ws;

    public function __construct(WebService $ws)
    {
        $this->ws = $ws;
    }

        /**
     * Validate API return
     * @param array/object $apiReturn
     * @return arary/object
     */
    protected function validateApiReturn($apiReturn)
    {
        if (is_string($apiReturn)) {
            return $this->getCustomMessages()[$apiReturn];
        } else {
            if (empty($apiReturn)) {
                return $this->getCustomMessages()['sysMsgNoRecordsRetrieved'];
            }
        }

        return $apiReturn;
    }

    /**
     * Build created by and created date
     * @param array $params
     * @return array
     */
    protected function buildCreation($params)
    {
        return array_merge($params, [
            'created_date' => $this->getLocalDateTime() ,
        ]);
    }

    /**
     * Build modified by and modified date
     * @param array $params
     * @return array
     */
    protected function buildModified($params)
    {
        return array_merge($params, [
            'modified_date' => $this->getLocalDateTime() ,
        ]);
    }

    /**
     * Get local date time base on timezone
     * @return DateTime
     */
    protected function getLocalDateTime($format = 'Y-m-d H:i:s')
    {
        $config = config('yoyo.config');
        $timestamp = $this->getTimezoneOffset(date_default_timezone_get(), $config['timezone']);

        return date($format, $timestamp);
    }

    /**
     * Get custom messages
     * @return array
     */
    public function getCustomMessages()
    {
        return trans('customMessages');
    }

    /**
     * Get timezone
     * @param unknown $remote_tz
     * @param string $origin_tz
     * @return boolean|number
     */
    protected function getTimezoneOffset($remote_tz, $origin_tz = null) {
        if($origin_tz === null) {
            if(!is_string($origin_tz = date_default_timezone_get())) {
                return false;
            }
        }
        $origin_dtz = new \DateTimeZone($origin_tz);
        $remote_dtz = new \DateTimeZone($remote_tz);
        $origin_dt = new \DateTime('now', $origin_dtz);
        $remote_dt = new \DateTime('now', $remote_dtz);
        $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
        $offset = time() + $offset;

        return $offset;
    }
}
