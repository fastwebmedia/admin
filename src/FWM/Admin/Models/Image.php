<?php namespace FWM\Admin\Models;

class Image extends \Eloquent
{
    protected $table = 'images';

    protected $fillable = [
        'path',
        'item_id',
        'item_type',
        'image_type',
        'alt_title',
        'position'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function item()
    {
        return $this->morphTo();
    }

    /**
     * @param string $size
     * @return mixed
     */
    public function getSize($size='large')
    {
        $filename = pathinfo($this->path, PATHINFO_FILENAME);

        return str_replace($filename, $size . '/' . $filename, $this->path);
    }

    /**
     * @param string $imagePath
     * @return string
     */
    public function getOriginalPath($imagePath='')
    {
        // todo: replace sizes array with dynamic sizes
        $urlParts = parse_url($imagePath);

        $pathBits = array_diff(explode('/', $urlParts['path']), ['small', 'medium', 'large']);

        return $urlParts['scheme']."://".$urlParts['host'].implode('/', $pathBits);
    }

} // class Image
