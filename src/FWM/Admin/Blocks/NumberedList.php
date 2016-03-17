<?php namespace FWM\Admin\Blocks;

class NumberedList extends BaseField
{
    protected $view = 'numberedlist';

    protected $filters = [
        'body' => 'trim'
    ];

}