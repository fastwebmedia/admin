<?php namespace FWM\Admin\Traits;

use FWM\Admin\Models\Image;

trait ImageableTrait
{
    /**
     * @return mixed
     */
    public function images($type = null)
    {
        $images = $this->morphMany('FWM\Admin\Models\Image', 'item');

        if ($type) {
            $images = $images->where('image_type', $type);
        }

        return $images->orderBy('position', 'ASC');
    }

    /**
     * Returns featured image from collection
     * @return bool
     */
    public function featuredImage()
	{
	  if ( isset($this->images[0]) ) {
	    $featured = array_where($this->images, function ($key, $image) {
	      return $image['image_type'] == "featured";
	    });
	    return current($featured);
	  }
	  return false;
	}

    /**
     * Returns featured image from DB
     * @return bool
     */
    public function getFeaturedImage()
    {
        $images = $this->images('featured')->get();
		if ($images->count()) {
            return $images->first();
        }
        return false;
    }

    /**
     * @param $image
     * @return bool
     */
    public function setFeaturedImageAttribute($image)
    {
        if( ! $featured = $this->getFeaturedImage() ) {
            $featured = new Image();
        }

        if( ! $image ) {
            // Delete Image
            $featured->delete();
            return false;
        }

        if( ! isset($this->id) ){
            $this->save();
        }

        $featured->path = $featured->getOriginalPath($image);
        $featured->image_type = 'featured';

        $this->images()->save($featured);
    }

    /**
     * @return bool
     */
    public function getFeaturedImageAttribute()
    {
        if( $featured = $this->getFeaturedImage() ) {
            return $featured->getSize('medium');
        }
        return false;
    }

    /**
     * @return bool
     */
    public function backgroundImage()
    {
        $images = $this->images('background')->get();
		if ($images->count()) {
            return $images->first();
        }
        return false;
    }

    /**
     * @return bool
     */
    public function getBackgroundImageAttribute()
    {
        if( $background = $this->backgroundImage() ) {
            return $background->getSize('medium');
        }
        return false;
    }

    /**
     * @param $image
     * @return bool
     */
    public function setBackgroundImageAttribute($image)
    {
        if( ! $background = $this->backgroundImage() ) {
            $background = new Image();
        }

        if( ! $image ) {
            // Delete Image
            $background->delete();
            return false;
        }

        if( ! isset($this->id) ){
            $this->save();
        }

        $background->path = $background->getOriginalPath($image);
        $background->image_type = 'background';

        $this->images()->save($background);
    }

    /**
     * @return bool
     */
    public function relatedImage($field=null)
    {
        $images = $this->images('related')->get();
        if ($images->count()) {
            $image = $images->first();
            if($field){
                return $image->{$field};
            }
            return $image;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function getRelatedImageAttribute()
    {
        if( $related = $this->relatedImage() ) {
            return $related->getSize('medium');
        }
        return false;
    }

    /**
     * @param $image
     * @return bool
     */
    public function setRelatedImageAttribute($image)
    {
        if( ! $related = $this->relatedImage() ) {
            $related = new Image();
        }

        if( ! $image ) {
            // Delete Image
            $related->delete();
            return false;
        }

        if( ! isset($this->id) ){
            $this->save();
        }

        $related->path = $related->getOriginalPath($image);
        $related->image_type = 'related';

        $this->images()->save($related);
    }

    /**
     * @return bool
     */
    public function contentImage($field=null)
    {
        $images = $this->images('image')->get();
		if ($images->count()) {
            $image = $images->first();
            if($field){
                return $image->{$field};
            }
            return $image;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function getContentImageAttribute()
    {
        if( $content = $this->contentImage() ) {
            return $content->getSize('medium');
        }
        return false;
    }

    /**
     * @param $image
     * @return bool
     */
    public function setContentImageAttribute($image)
    {
        if( ! $content = $this->contentImage() ) {
            $content = new Image();
        }

        if( ! $image ) {
            // Delete Image
            $content->delete();
            return false;
        }

        if( ! isset($this->id) ){
            $this->save();
        }

        $content->path = $content->getOriginalPath($image);
        $content->image_type = 'image';

        $this->images()->save($content);
    }

}
