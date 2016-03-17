<?php namespace FWM\Admin\Blocks;

class Text extends BaseField
{
    protected $view = 'text';

    protected $filters = [
        'body' => 'trim'
    ];

    /**
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);
    }


}