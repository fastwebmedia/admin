<?php namespace FWM\Admin\Blocks;

class RightImage extends BaseField
{
    protected $view = 'rightimage';

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