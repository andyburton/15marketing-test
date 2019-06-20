<?php

namespace ApiResponse;

/**
 * Class JsonApiResponse
 *
 * Extended Game API Response for JsonApiResponse
 */
class JsonApiResponse extends ApiResponse
{
    /**
     * Return response object from JSON format
     * @return object
     */
    public function getData(): object
    {
        // Mock data so init.php can run
        if (defined('RUN_GAME') && constant('RUN_GAME') === 1) {
            $this->data = '{"some": "Example JSON"}';
        }

        return json_decode($this->data);
    }
}