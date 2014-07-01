<?php

include('src/Pushed.php');

unset($_ENV['pushed_php_api_client_test']);

// Load Credentials
$debug = TRUE;
$credentials = $debug ? 'development-test-credentials.php' : 'production-test-credentials.php';
if(file_exists($credentials))
	include($credentials);

class PushTest extends \PHPUnit_Framework_TestCase

{

	protected function setUp()

	{


		$this->credentials = [

			'endpoint' => (isset($_ENV['pushed_php_api_client_test']['endpoint'])) ? $_ENV['pushed_php_api_client_test']['endpoint'] : null,

			'app' => [

				'app_key' => (isset($_ENV['pushed_php_api_client_test']['app']['app_key'])) ? $_ENV['pushed_php_api_client_test']['app']['app_key'] : null,
				'app_secret' => (isset($_ENV['pushed_php_api_client_test']['app']['app_secret'])) ? $_ENV['pushed_php_api_client_test']['app']['app_secret'] : null,

			],

			'channel' => [

				'target_alias' => (isset($_ENV['pushed_php_api_client_test']['channel']['target_alias'])) ? $_ENV['pushed_php_api_client_test']['channel']['target_alias'] : null,
				'app_key' => (isset($_ENV['pushed_php_api_client_test']['channel']['app_key'])) ? $_ENV['pushed_php_api_client_test']['channel']['app_key'] : null,
				'app_secret' => (isset($_ENV['pushed_php_api_client_test']['channel']['app_secret'])) ? $_ENV['pushed_php_api_client_test']['channel']['app_secret'] : null,

			],

			'user' => [

				'auth_code' => (isset($_ENV['pushed_php_api_client_test']['user']['auth_code'])) ? $_ENV['pushed_php_api_client_test']['user']['auth_code'] : null,
				'target_alias' => (isset($_ENV['pushed_php_api_client_test']['user']['target_alias'])) ? $_ENV['pushed_php_api_client_test']['user']['target_alias'] : null,
				'app_key' => (isset($_ENV['pushed_php_api_client_test']['user']['app_key'])) ? $_ENV['pushed_php_api_client_test']['user']['app_key'] : null,
				'app_secret' => (isset($_ENV['pushed_php_api_client_test']['user']['app_secret'])) ? $_ENV['pushed_php_api_client_test']['user']['app_secret'] : null,

			],

			'pushed_id' => [

				'pushed_id' => (isset($_ENV['pushed_php_api_client_test']['pushed_id']['pushed_id'])) ? $_ENV['pushed_php_api_client_test']['pushed_id']['pushed_id'] : null,
				'target_alias' => (isset($_ENV['pushed_php_api_client_test']['pushed_id']['target_alias'])) ? $_ENV['pushed_php_api_client_test']['pushed_id']['target_alias'] : null,
				'app_key' => (isset($_ENV['pushed_php_api_client_test']['pushed_id']['app_key'])) ? $_ENV['pushed_php_api_client_test']['pushed_id']['app_key'] : null,
				'app_secret' => (isset($_ENV['pushed_php_api_client_test']['pushed_id']['app_secret'])) ? $_ENV['pushed_php_api_client_test']['pushed_id']['app_secret'] : null,
			],

		];

		/** App Tests */

		$this->contentForAppNotification = [
			'app_key' => $this->credentials['app']['app_key'],
			'app_secret' => $this->credentials['app']['app_secret'],
			'content' => 'contentForAppNotification notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'simple',
		];

		$this->contentForAppNotificationWithURL = array_merge($this->contentForAppNotification,[
			'content' => 'contentForAppNotificationWithURL notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'url',
			'content_extra' => 'https://pushed.co',
		]);

		/** Channel Tests */

		$this->contentForChannelNotification = [
			'target_alias' => $this->credentials['channel']['target_alias'],
			'app_key' => $this->credentials['channel']['app_key'],
			'app_secret' => $this->credentials['channel']['app_secret'],
			'content' => 'contentForChannelNotification notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'simple',
		];

		$this->contentForChannelNotificationWithURL = array_merge($this->contentForChannelNotification,[
			'content' => 'contentForChannelNotificationWithURL notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'url',
			'content_extra' => 'https://pushed.co',
		]);

		/** User Tests */

		$this->contentForUserNotification = [
			'auth_code' => $this->credentials['user']['auth_code'],
			'target_alias' => $this->credentials['user']['target_alias'],
			'app_key' => $this->credentials['user']['app_key'],
			'app_secret' => $this->credentials['user']['app_secret'],
			'content' => 'contentForUserNotification notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'simple',
		];

		$this->contentForUserNotificationWithURL = array_merge($this->contentForUserNotification,[
			'content' => 'contentForUserNotificationWithURL notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'url',
			'content_extra' => 'https://pushed.co',
		]);

		/** Pushed-ID Tests */

		$this->contentForPushedIDNotification = [
			'pushed_id' => $this->credentials['pushed_id']['pushed_id'],
			'target_alias' => $this->credentials['pushed_id']['target_alias'],
			'app_key' => $this->credentials['pushed_id']['app_key'],
			'app_secret' => $this->credentials['pushed_id']['app_secret'],
			'content' => 'contentForPushedIDNotification notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'simple',
		];

		$this->contentForPushedIDNotificationWithURL = array_merge($this->contentForPushedIDNotification,[
			'content' => 'contentForPushedIDNotificationWithURL notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'url',
			'content_extra' => 'https://pushed.co',
		]);

		print_r($this->credentials);die();

	}

	public function testPushToAppSimple()

	{

		$pushToAppSimple = (new Pushed());
		$pushToAppSimple->root = $this->credentials['endpoint'];

		$response = $pushToAppSimple->push->toApp($this->contentForAppNotification);

		echo json_encode($response).PHP_EOL.PHP_EOL;

		$this->assertTrue(isset($response['response']));

	}

	public function testPushToAppURL()

	{

		$pushToAppWithURL = (new Pushed());
		$pushToAppWithURL->root = $this->credentials['endpoint'];

		$response = $pushToAppWithURL->push->toApp($this->contentForAppNotificationWithURL);

		echo json_encode($response).PHP_EOL.PHP_EOL;

		$this->assertTrue(isset($response['response']));

	}

	public function testPushToChannelSimple()

	{

		$pushToChannelSimple = (new Pushed());
		$pushToChannelSimple->root = $this->credentials['endpoint'];

		$response = $pushToChannelSimple->push->toChannel($this->contentForChannelNotification);

		echo json_encode($response).PHP_EOL.PHP_EOL;

		$this->assertTrue(isset($response['response']));

	}

	public function testPushToChannelWithURL()

	{

		$pushToChannelWithURL = (new Pushed());
		$pushToChannelWithURL->root = $this->credentials['endpoint'];

		$response = $pushToChannelWithURL->push->toChannel($this->contentForChannelNotificationWithURL);

		echo json_encode($response).PHP_EOL.PHP_EOL;

		$this->assertTrue(isset($response['response']));

	}

	public function testPushToUserSimple()

	{

		$pushToUserSimple = (new Pushed());
		$pushToUserSimple->root = $this->credentials['endpoint'];

		$response = $pushToUserSimple->push->toUser($this->contentForUserNotification);

		echo json_encode($response).PHP_EOL.PHP_EOL;

		$this->assertTrue(isset($response['response']));

	}

	public function testPushToUserlWithURL()

	{

		$pushToUserWithURL = (new Pushed());
		$pushToUserWithURL->root = $this->credentials['endpoint'];

		$response = $pushToUserWithURL->push->toUser($this->contentForUserNotificationWithURL);

		echo json_encode($response).PHP_EOL.PHP_EOL;

		$this->assertTrue(isset($response['response']));

	}

	public function testPushToPushedIDSimple()

	{

		$pushToPushedIDSimple = (new Pushed());
		$pushToPushedIDSimple->root = $this->credentials['endpoint'];

		$response = $pushToPushedIDSimple->push->toPushedID($this->contentForPushedIDNotification);

		echo json_encode($response).PHP_EOL.PHP_EOL;

		$this->assertTrue(isset($response['response']));

	}

	public function testPushToPushedIDWithURL()

	{

		$pushToPushedIDWithURL = (new Pushed());
		$pushToPushedIDWithURL->root = $this->credentials['endpoint'];

		$response = $pushToPushedIDWithURL->push->toPushedID($this->contentForPushedIDNotificationWithURL);

		echo json_encode($response).PHP_EOL.PHP_EOL;

		$this->assertTrue(isset($response['response']));

	}

}