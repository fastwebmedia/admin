<?php namespace FWM\Admin\Traits;

/**
 * Class ContentBlockTrait
 * @package Carling\Traits
 */
trait ContentBlockTrait
{
    /**
     * @return mixed
     */
    public function contentBlocks()
    {
        return $this->morphMany('\FWM\Admin\Models\Content', 'item')->orderBy('position', 'ASC');
    }

    /**
     * @return array
     */
    public function getContentFields()
    {
        $fields = [];

        foreach($this->contentBlocks as $block) {
            $fields[] = $block->getContentFieldClass();
        }

        return $fields;
    }

}
