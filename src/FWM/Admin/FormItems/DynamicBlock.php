<?php namespace FWM\Admin\FormItems;

use Route;
use JavaScript;
use FWM\Admin\Models\Content;
use FWM\Admin\Models\ContentType;
use FWM\Admin\AssetManager\AssetManager;
use FWM\Admin\Interfaces\WithRoutesInterface;


class DynamicBlock extends BaseFormItem implements WithRoutesInterface
{

	protected $view = 'dynamicblock';

	protected static $route = 'view';

	public function initialize()
	{
		parent::initialize();

		AssetManager::addScript('admin::default/vendor/ckeditor/ckeditor.js');
		AssetManager::addScript('admin::default/vendor/ckeditor/adapters/jquery.js');

		JavaScript::put([
			'dynamicblock' => route('admin.blocks.' . static::$route, ['id' => 'DUMMYID'])
		]);
	}

	public static function registerRoutes()
	{
		Route::get('blocks/' . static::$route . '/{id}', [
			'as' => 'admin.blocks.' . static::$route,
			'uses' => 'FWM\Admin\Http\Controllers\ContentBlockController@show'
		]);
	}

	public function getParams()
	{
		return parent::getParams() + [
			'contentTypes' => ContentType::lists('title', 'id'),
			'contentFields' => $this->instance()->getContentFields()
		];
	}

	public function save()
	{
		if( ! ($post = \Input::get('content')) ){
			return false;
		}

		// Save first so we have access to ID
		if( ! $this->instance()->id ){
			$this->instance()->save();
		}

		$contents = [];
		foreach($post as $id => $data) {

			// Get Content item or create new one
			$content = Content::firstOrCreate([
				'id' => array_get($data, 'id', 0),
				'content_type_id' => array_get($data, 'type', 0)
			]);

			$contentClass = $content->getContentFieldClass()->populate($data)->process();

			$contents[] = $content->fill($contentClass->getPost());
		}

		// Diff the ids in both arrays, this returns the ids that have been deleted by the user.
		$contentBlockIds = $this->instance()->contentBlocks->lists('id')->toArray();
		$deleteArray = array_diff($contentBlockIds, array_pluck($contents, 'id'));

		if(! empty($contents)){
			$this->instance()->contentBlocks()->saveMany($contents);
		}

		if(! empty($deleteArray)) {
			Content::destroy($deleteArray);
		}
	}
}