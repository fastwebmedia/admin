<?php namespace FWM\Admin\Blocks;

use FWM\Admin\Models\Image as ImageModel;

class Image extends BaseField
{
    protected $view = 'image';

    protected $filters = [
        'title' => 'trim',
        'body' => 'trim|strtolower',
    ];

    /**
     * @return array
     */
    public function transform()
    {
        $this->uploadImage();

        return $this;
    }

}