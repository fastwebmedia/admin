<?php namespace FWM\AdminAuth\Entities;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use FWM\Roles\Traits\HasRoleAndPermission;
use FWM\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class Administrator extends \Eloquent implements AuthenticatableContract, HasRoleAndPermissionContract
{
	use Authenticatable, HasRoleAndPermission;

	protected $fillable = [
		'username',
		'password',
		'name',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	public function setPasswordAttribute($value)
	{
		if ( ! empty($value))
		{
			$this->attributes['password'] = Hash::make($value);
		}
	}

}