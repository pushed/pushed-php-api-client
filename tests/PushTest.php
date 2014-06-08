<?php

include('src/Pushed.php');

class PushTest extends \PHPUnit_Framework_TestCase

{

	protected $stack;

    protected function setUp()
   
    {
   
		$this->contentForAppNotification = [
			'app_key' => 'ZyDKttsl53orGmGSGb7K',
			'app_secret' => 'tbmlhFFzVfj0sbWkHMOsedHp3h6j2zgEPHU4rLZvnIZnf2x15CNX12MoxhufsTj7',
			'content' => 'contentForAppNotification notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'simple',
		];

		$this->contentForAppNotificationWithURL = array_merge($this->contentForAppNotification,[
			'content' => 'contentForAppNotificationWithURL notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'url',
			'content_extra' => 'https://pushed.co',
		]);

		$this->contentForChannelNotification = [
			'target_alias' => 'abc123',
			'app_key' => 'APPKEY',
			'app_secret' => 'APPSECRET',
			'content' => 'contentForChannelNotification notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'simple',
		];

		$this->contentForChannelNotificationWithURL = array_merge($this->contentForChannelNotification,[
			'content' => 'contentForChannelNotificationWithURL notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'url',
			'content_extra' => 'https://pushed.co',
		]);
   
    }

	public function testPushToAppSimple()

	{

		$pushToAppSimple = (new Pushed())->push->toApp($this->contentForAppNotification);

		$this->assertTrue(isset($pushToAppSimple['response']));

	}

	public function testPushToAppURL()

	{

		$pushToAppWithURL = (new Pushed())->push->toApp($this->contentForAppNotificationWithURL);

		$this->assertTrue(isset($pushToAppWithURL['response']));

	}

	public function testPushToChannelSimple()

	{

		$pushToChannelSimple = (new Pushed())->push->toChannel($this->contentForChannelNotification);

		$this->assertTrue(isset($pushToChannelSimple['response']));

	}

	public function testPushToChannelWithURL()

	{

		$pushToChannelWithURL = (new Pushed())->push->toChannel($this->contentForChannelNotificationWithURL);

		$this->assertTrue(isset($pushToChannelWithURL['response']));

	}

}