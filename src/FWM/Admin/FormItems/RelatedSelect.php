<?php namespace FWM\Admin\FormItems;

use FWM\Admin\Interfaces\WithRoutesInterface;
use Illuminate\Support\Facades\Route;
use Input;

class RelatedSelect extends NamedFormItem implements WithRoutesInterface
{

	protected static $route = 'getModelData';
	protected $view = 'relatedselect';
	protected $model;
	protected $display = 'title';
	protected $options = [];
	protected $nullable = false;

	protected $relatedFieldName;
	protected $relatedFieldLabel;
	protected $relatedFieldPlaceholder;

	public function initialize()
	{
		parent::initialize();
	}

	public static function registerRoutes()
	{
		Route::post('formitems/relatedselect/' . static::$route, ['as' => 'admin.formitems.relatedselect.' . static::$route, 'uses' => 'FWM\Admin\Http\Controllers\ModelController@getModelData']);
	}

	public function relatedField($name, $label = null)
	{
		$this->relatedFieldName = $name;
		$this->relatedFieldLabel = $label;
		return $this;
	}

	public function relatedFieldPlaceholder($name = null)
	{
		$this->relatedFieldPlaceholder = $name;
		return $this;
	}

	public function options($options = null)
	{
		if (is_null($options))
		{
			$options = $this->options;
			return $options;
		}
		$this->options = $options;
		return $this;
	}

	public function getParams()
	{
		return parent::getParams() + [
			'options'  			=> $this->options(),
			'nullable' 			=> $this->isNullable(),

			'relatedFieldName' 	=> $this->relatedFieldName,
			'relatedFieldLabel' => $this->relatedFieldLabel,
			'relatedFieldPlaceholder' => $this->relatedFieldPlaceholder,
		];
	}

	public function nullable($nullable = true)
	{
		$this->nullable = $nullable;
		return $this;
	}

	public function isNullable()
	{
		return $this->nullable;
	}

	public function save()
	{
		parent::save();

		$relatedFieldName = $this->relatedFieldName;
		if ( ! Input::has($relatedFieldName))
		{
			Input::merge([$relatedFieldName => null]);
		}

		$this->instance()->$relatedFieldName = Input::get($relatedFieldName);
	}
}
