<?php namespace FWM\Admin\Traits;

trait DeletableTrait
{

	/**
	 * Boot trait
	 */
	protected static function bootDeletableTrait()
	{
		static::deleting(function ($row)
		{
			$row->removeContentCategories();
			$row->removeSeoEntry();
			$row->removeImages();
			$row->removeContent();
		});
	}

	/**
	 * Remove SEO Entry
	 */
	public function removeSeoEntry()
	{
		if(isset($this->seo)) {
			$this->seo()->delete();
		}
	}

	/**
	 * Remove content category.
	 */
	public function removeContentCategories()
	{
		if(isset($this->category)) {
			$this->category()->sync([]);
		}
	}

	/**
	 * Removes related images
     */
	public function removeImages()
	{
        try {
            if($images = $this->images()){
                $images->delete();
            }
        } catch (\Exception $e) {

        }
	}

    /**
     * Removes related content
     */
    public function removeContent()
	{
        try {
            if($content = $this->contentBlocks()){
                $content->delete();
            }
        } catch (\Exception $e) {

        }
	}
}
