<?php namespace FWM\Admin\Models;

class ContentType extends \Eloquent
{
    protected $table = 'content_types';
    protected $morphClass = 'contenttype';
}
