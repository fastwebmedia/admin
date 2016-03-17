<?php namespace FWM\Admin\Blocks;

use Rees\Sanitizer\Sanitizer;
use FWM\Admin\Models\Image as ImageModel;
use FWM\Admin\Templates\Facade\AdminTemplate;

abstract class BaseField
{
    protected $view;

    protected $viewPath = 'blocks.field.';

    protected $instance;

    protected $sanitizer;

    protected $post = [];

    protected $rules = [];

    protected $filters = [];

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->instance = $data;
        $this->sanitizer = new Sanitizer();
        $this->registerFilters();
    }

    /**
     * @return mixed
     */
    public function instance()
    {
        return $this->instance;
    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param array $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @param array $items
     */
    public function setPostItem(array $items)
    {
        $this->setPost(array_merge($this->getPost(), $items));
    }

    /**
     * @param $attribute
     * @param null $default
     * @return mixed
     */
    public function getPostItem($attribute, $default=null)
    {
        return array_get($this->getPost(), $attribute, $default);
    }

    /**
     * @param array $post
     * @return $this
     * Add post data to content type
     * Wrapper for setPost
     */
    public function populate(array $post)
    {
        $this->setPost($post);

        return $this;
    }

    /**
     * Set a random identifier for new fields
     * @return string
     */
    public function getIdentifier()
    {
        if( ! ($id = $this->instance()->id) ) {
            $id = strtolower(str_random(13));
        }
        return $id;
    }

    /**
     * Custom Sanitizer rules
     */
    public function registerFilters()
    {
        //
    }

    /**
     * @return array
     */
    public function process()
    {
        $this->transform()->sanitize();

        return $this;
    }

    /**
     * @return array
     */
    public function transform()
    {
        return $this;
    }

    /**
     * @return array
     */
    public function sanitize()
    {
        $data = $this->getPost();

        $data = $this->sanitizer->sanitize($this->filters, $data);

        $this->setPost($data);

        return $this;
    }

    /**
     * @return $this
     */
    public function uploadImage()
    {
        $data = $this->getPost();

        $image = ImageModel::firstOrNew(['id' => array_get($data, 'image_id', 0)]);

        $this->instance()->images()->save($image->fill([
            'image_type' => 'related',
            'path'       => array_get($data, 'image_path')
        ]));

        $this->setPostItem(['image_id' => $image->id]);
    }

    /**
     * @return $this
     */
    public function render()
    {
		$view = AdminTemplate::view($this->viewPath . $this->view);

        if( view()->exists($view) ) {

            return view($view)
                ->with('identifier', $this->getIdentifier())
                ->with('item', $this->instance());

        }
    }
}
