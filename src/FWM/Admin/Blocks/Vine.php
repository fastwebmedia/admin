<?php namespace FWM\Admin\Blocks;

class Vine extends BaseField
{
    protected $view = 'vine';

    protected $filters = [
        'body' => 'trim|vineId'
    ];

    /**
     * Custom Sanitizer rules
     */
    public function registerFilters()
    {
        $this->sanitizer->register('vineId', [$this, 'extractVineId']);
    }

    /**
     * @param $field
     * @return mixed
     */
    public function extractVineId($field)
    {
        $matches = [];
        preg_match("#(?<=vine.co/v/)[0-9A-Za-z]+#", $field, $matches);

        if( !empty($matches) ){
            return current($matches);
        }else{
            return $field;
        }
    }


}