<?php namespace FWM\Admin\Blocks;

class Download extends BaseField
{
    protected $view = 'download';

    protected $filters = [
        'title' => 'trim',
        'body' => 'trim',
    ];

}