<?php namespace FWM\Admin\Blocks;

class Spotify extends BaseField
{
    protected $view = 'spotify';

    protected $filters = [
        'title' => 'trim|strtolower',
        'body' => 'trim'
    ];

}