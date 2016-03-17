<?php namespace FWM\AdminAuth;

use Config;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Manager;

class AdminAuthManager extends AuthManager {

	/**
	 * Create an instance of the Eloquent driver.
	 *
	 * @return \Illuminate\Auth\Guard
	 */
	public function createEloquentDriver()
	{
		$config = Config::get('auth.providers.administrators');

		$provider = $this->createEloquentProvider($config);

		return new Guard($provider, $this->app['session.store']);
	}

}
