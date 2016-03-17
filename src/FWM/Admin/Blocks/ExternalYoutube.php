<?php namespace FWM\Admin\Blocks;

class ExternalYoutube extends BaseField
{
    protected $view = 'externalyoutube';

    protected $filters = [
        'body' => 'trim|videoId'
    ];

    /**
     * Custom Sanitizer rules
     */
    public function registerFilters()
    {
        $this->sanitizer->register('videoId', [$this, 'extractVideoId']);
    }

    /**
     * @param $field
     * @return mixed
     */
    public function extractVideoId($field)
    {
        $matches = [];
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $field, $matches);

        if( !empty($matches) ){
            return current($matches);
        }else{
            return $field;
        }
    }


}