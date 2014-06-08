<?php

require_once 'Pushed/Exceptions.php';
require_once 'Pushed/Push.php';
require_once 'Pushed/Authorize.php';
require_once 'Pushed/Subscribe.php';
require_once 'Pushed/Analytics.php';

class Pushed 

{

	public $ch;
	//public $root = 'https://api.pushed.co/1';
	public $root = 'http://staging.pushed.io/api/1';
	public $debug = true;

	public static $error_map = array(
        "ValidationError" => "Pushed_ValidationError",
        "Invalid_Key" => "Pushed_Invalid_Key",
		"Invalid_Secret" => "Pushed_Invalid_Key",
        "PaymentRequired" => "Pushed_PaymentRequired",
        "ServiceUnavailable" => "Pushed_ServiceUnavailable"
    );

	public function __construct($apikey=null) {
        $this->ch = curl_init();
		
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Pushed-PHP/1.0.0');
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 600);

        $this->root = rtrim($this->root, '/') . '/';

        $this->authorize = new Pushed_Authorize($this);
        $this->analytics = new Pushed_Analytics($this);
        $this->push = new Pushed_Push($this);
        $this->subscribe = new Pushed_Subscribe($this);
	}

	public function __destruct() {
		curl_close($this->ch);
	}

	public function call($url, $params, $method) {
		$ch = $this->ch;

		switch ($method) {
			case 'GET':
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			break;

			case 'POST':
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			break;

			case 'DELETE':
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			break;

			case 'PUT':
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			break;
			
			default:
				throw new Pushed_Error('Invalid method: ' . $method . '.');
			break;
		}

		curl_setopt($ch, CURLOPT_URL, $this->root . $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);

		$start = microtime(true);
		$this->log('Call to ' . $this->root . $url . json_encode($params));
		if($this->debug) {
		    $curl_buffer = fopen('php://memory', 'w+');
		    curl_setopt($ch, CURLOPT_STDERR, $curl_buffer);
		}

		$response_body = curl_exec($ch);
		$info = curl_getinfo($ch);
		$time = microtime(true) - $start;
		if($this->debug) {
		    rewind($curl_buffer);
		    $this->log(stream_get_contents($curl_buffer));
		    fclose($curl_buffer);
		}
		$this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
		$this->log('Got response: ' . $response_body);

		if(curl_error($ch)) {
		    throw new Pushed_HttpError("API call to $url failed: " . curl_error($ch));
		}
		$result = json_decode($response_body, true);
		if($result === null) throw new Pushed_Error('We were unable to decode the JSON response from the Pushed API: ' . $response_body . '.');

		if(floor($info['http_code'] / 100) >= 4) {
		    throw $this->castError($result);
		}

		return $result;
	}

	public function castError($result) {
		if(!isset($result['response'])) throw new Pushed_Error('We received an unexpected error: ' . $result['error']['message']);

		$class = (isset(self::$error_map[$result['error']['response']])) ? self::$error_map[$result['error']['response']] : 'Pushed_Error';
		return new $class($result['error']['response'], $result['code']);
	}

	public function log($msg) {
		if($this->debug) error_log($msg);
	}

}