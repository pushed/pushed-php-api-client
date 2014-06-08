<?php

include('src/Pushed.php');

class PushTest extends \PHPUnit_Framework_TestCase

{

	protected $stack;

	protected function setUp()

	{

		// Prepare example notifications. Test purposing only.
		// THIS CREDENTIALS WILL WORK NOT WORK.

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

		$this->contentForUserNotification = [
			'auth_code' => 'NzhVZ4EKV2cfyEhhCZjvsx0dFTZvzmnqfjj4BLTb',
			'target_alias' => 'abc123',
			'app_key' => 'APPKEY',
			'app_secret' => 'APPSECRET',
			'content' => 'contentForUserNotification notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'simple',
		];

		$this->contentForUserNotificationWithURL = array_merge($this->contentForUserNotification,[
			'content' => 'contentForUserNotificationWithURL notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'url',
			'content_extra' => 'https://pushed.co',
		]);

		$this->contentForPushedIDNotification = [
			'pushed_id' => 'abcdefghijklmnrsopqrstuwxyz1234512345678',
			'target_alias' => 'abc123',
			'app_key' => 'APPKEY',
			'app_secret' => 'APPSECRET',
			'content' => 'contentForPushedIDNotification notification sent at '.date('Y-m-d H:i:s'),
			'content_type' => 'simple',
		];

		$this->contentForPushedIDNotificationWithURL = array_merge($this->contentForPushedIDNotification,[
			'content' => 'contentForPushedIDNotificationWithURL notification sent at '.date('Y-m-d H:i:s'),
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

	public function testPushToUserSimple()

	{

		$pushToUserSimple = (new Pushed())->push->toUser($this->contentForUserNotification);

		$this->assertTrue(isset($pushToUserSimple['response']));

	}

	public function testPushToUserlWithURL()

	{

		$pushToUserWithURL = (new Pushed())->push->toUser($this->contentForUserNotificationWithURL);

		$this->assertTrue(isset($pushToUserWithURL['response']));

	}

	public function testPushToPushedIDSimple()

	{

		$pushToPushedIDSimple = (new Pushed())->push->toPushedID($this->contentForPushedIDNotification);

		$this->assertTrue(isset($pushToPushedIDSimple['response']));

	}

	public function testPushToPushedIDWithURL()

	{

		$pushToPushedIDWithURL = (new Pushed())->push->toPushedID($this->contentForPushedIDNotificationWithURL);

		$this->assertTrue(isset($pushToPushedIDWithURL['response']));

	}

}