<?php namespace FWM\Admin\Blocks;

class Logo extends BaseField
{
    protected $view = 'logo';

    protected $filters = [
        'title' => 'trim',
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