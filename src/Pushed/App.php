<?php

class Pushed_App

{

	public function __construct(Pushed $master)

	{

		$this->master = $master;

	}

	public function newApp($params = [])

	{

		$mandatory_params = ['name','description','category','icon_url','api_key','pushed_id'];
		$checkMandatoryParams = $this->master->checkMandatoryParams($mandatory_params, $params);

		return $this->master->call('app', $params, 'PUT', ['X-Api-Key: '.$params['api_key'], 'X-Pushed-Id: '.$params['pushed_id']]);

	}

}