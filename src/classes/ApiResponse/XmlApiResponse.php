<?php

namespace ApiResponse;

/**
 * Class XmlApiResponse
 *
 * Extended Game API Response for XmlApiResponse
 */
class XmlApiResponse extends ApiResponse
{
    /**
     * Return response object from XML format
     * @return object
     */
    public function getData(): object
    {

        // Mock data so init.php can run
        if (defined('RUN_GAME') && constant('RUN_GAME') === 1) {
            $this->data = '<some>Example XML</some>';
        }

        return simplexml_load_string($this->data);
    }
}