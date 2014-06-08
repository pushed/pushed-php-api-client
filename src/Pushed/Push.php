<?php

class Pushed_Push 

{

	public function __construct(Pushed $master) 

	{
	
		$this->master = $master;
	
	}

	public function toApp($params = []) 

	{
	
		$_params = [
			'app_key' => $params['app_key'],
			'app_secret' => $params['app_secret'],
			'target_type' => 'app', 
			'content' => $params['content'],
			'content_type' => (!empty($params['content_type'])) ? $params['content_type'] : 'simple', 
			'content_extra' => (!empty($params['content_extra'])) ? $params['content_extra'] : NULL,
		];

		return $this->master->call('push', $_params, 'POST');

	}

	public function toChannel($params = []) 

	{
	
		$_params = [
			'app_key' => $params['app_key'], 
			'app_secret' => $params['app_secret'],
			'target_type' => 'channel',
			'target_alias' => $params['target_alias'],
			'content' => $params['content'], 
			'content_type' => (!empty($params['content_type'])) ? $params['content_type'] : 'simple', 
			'content_extra' => (!empty($params['content_extra'])) ? $params['content_extra'] : NULL,
		];

		return $this->master->call('push', $_params, 'POST');
		
	}

	public function toUser($params = []) 

	{
		
		$_params = [
			'app_key' => $params['app_key'],
			'app_secret' => $params['app_secret'],
			'target_type' => 'user',
			'target_alias' => $params['target_alias'],
			'content' => $params['content'],
			'content_type' => (!empty($params['content_type'])) ? $params['content_type'] : 'simple',
			'content_extra' => (!empty($params['content_extra'])) ? $params['content_extra'] : NULL,
		];

		return $this->master->call('push', $_params, 'POST');
	
	}

	public function toPushedId($params = []) 

	{
	
		$_params = [
			'app_key' => $params['app_key'],
			'app_secret' => $params['app_secret'],
			'target_type' => 'pushed_id',
			'target_alias' => $params['target_alias'],
			'content' => $params['content'],
			'content_type' => (!empty($params['content_type'])) ? $params['content_type'] : 'simple',
			'content_extra' => (!empty($params['content_extra'])) ? $params['content_extra'] : NULL,
		];

		return $this->master->call('push', $_params, 'POST');
	
	}

}