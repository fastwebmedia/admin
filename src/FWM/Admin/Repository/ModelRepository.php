<?php namespace FWM\Admin\Repository;

class ModelRepository extends BaseRepository
{
	protected $model;

	public function __construct()
	{
		//
	}

	/**
	 * @param $model
	 * @return bool
     */
	public function getAllItems($model, $display)
	{
		// todo: pass through display title/id
		if( class_exists($model) ){
			return (new $model)->lists($display, 'id');
		}

		return response()->json(['message' => 'Error. Content Not found'], 404);
	}

}