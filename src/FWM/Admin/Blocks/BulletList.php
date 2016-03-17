<?php namespace FWM\Admin\Blocks;

class BulletList extends BaseField
{
    protected $view = 'bulletlist';

    protected $filters = [
        'body' => 'trim'
    ];

}