<?php namespace FWM\Admin\Models;

use FWM\Admin\Traits\ImageableTrait;

class Content extends \Eloquent
{
    use ImageableTrait;

    protected $table = 'content';

	protected $morphClass = 'content';

	protected $fillable = ['item_id', 'item_type', 'content_type_id', 'title', 'body', 'image_id', 'position'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function item()
    {
        return $this->morphTo();
    }

    public function contentType()
    {
        return $this->belongsTo('FWM\Admin\Models\ContentType');
    }

    /**
     * @return bool
     */
    public function contentImage()
    {
        if ($this->image_id):
            return (new Image())->where('id', $this->image_id)->first()->path;
        else:
            return false;
        endif;
    }

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getContentFieldClass()
    {
        // todo: add to trait
        $fieldType = studly_case($this->contentType->uri);

        $className = "\\FWM\\Admin\\Blocks\\" . $fieldType;

        if(! class_exists($className)){
			throw new \Exception('The class '.$className.' does not exist.');
        }

		return new $className($this);
    }
}
