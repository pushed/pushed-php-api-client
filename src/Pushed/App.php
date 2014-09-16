<?php

class Pushed_App 

{

	public function __construct(Pushed $master) 

	{
	
		$this->master = $master;
	
	}

	public function new($params = []) 

	{
	
		$_params = [
			'name' => $params['name'],
			'description' => $params['app_secret'],
			'category' => $params['category'],
			'icon_url' => isset($params['icon_url']) ? $params['icon_url'] : '',
		];
		
		return $this->master->call('app', $_params, 'PUT');

	}

}