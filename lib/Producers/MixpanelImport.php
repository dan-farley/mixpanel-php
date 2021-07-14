<?php
require_once(dirname(__FILE__) . "/MixpanelBaseProducer.php");
require_once(dirname(__FILE__) . "/MixpanelPeople.php");
require_once(dirname(__FILE__) . "/../ConsumerStrategies/CurlConsumer.php");

/**
 * Provides an API to track past events on Mixpanel
 */
class Producers_MixpanelImport extends Producers_MixpanelBaseProducer {

    /**
     * Track an event defined by $event associated with metadata defined by $properties
     * @param string $event
     * @param array $properties
     */
    public function import($event, $properties = array()) {

        // if no token is passed in, use current token
        if (!array_key_exists("token", $properties)) $properties['token'] = $this->_token;

        // if no time is passed in, use the current time
        if (!array_key_exists('time', $properties)) $properties['time'] = time();

        $params['event'] = $event;
        $params['properties'] = array_merge($this->_super_properties, $properties);

        $this->enqueue($params);
    }

    /**
     * Returns the "events" endpoint
     * @return string
     */
    function _getEndpoint() {
        return $this->_options['import_endpoint'];
    }
}
