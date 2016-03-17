<?php namespace FWM\Admin\Blocks;

use FWM\Admin\Models\Image as ImageModel;

class LeftImage extends BaseField
{
    protected $view = 'leftimage';

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