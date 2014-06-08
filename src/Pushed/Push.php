<?php

class Pushed_Push {

	public function __construct(Pushed $master) {
		$this->master = $master;
	}

	public function toChannel() {
		$_params = [];
		return $this->master->call('push', $_params, 'POST');
	}

	public function toApp($app_key = NULL, $app_secret = NULL, $content = NULL) {
		$_params = ['app_key' => $app_key, 'app_secret' => $app_secret, 'content' => $content, 'target_type' => 'app'];
		return $this->master->call('push', $_params, 'POST');
	}

	public function toUser() {
		$_params = [];
		return $this->master->call('push', $_params, 'POST');
	}

	public function toPushedId() {
		$_params = [];
		return $this->master->call('push', $_params, 'POST');
	}

}