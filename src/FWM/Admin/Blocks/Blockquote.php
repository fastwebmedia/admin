<?php namespace FWM\Admin\Blocks;

class BlockQuote extends BaseField
{
    protected $view = 'blockquote';

    protected $filters = [
        'body' => 'trim'
    ];

}