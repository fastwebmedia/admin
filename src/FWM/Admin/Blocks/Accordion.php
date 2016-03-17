<?php namespace FWM\Admin\Blocks;

class Accordion extends BaseField
{
    protected $view = 'accordion';

    protected $filters = [
        'title' => 'trim',
        'body' => 'trim',
    ];

}