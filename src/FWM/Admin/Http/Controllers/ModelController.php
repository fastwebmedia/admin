<?php namespace FWM\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use FWM\Admin\Repository\ModelRepository;

/**
 * Class ModelController
 * @package FWM\Admin\Http\Controllers
 */
class ModelController extends Controller
{
    protected $repository;

    /**
     * @param ModelRepository $repository
     */
    public function __construct(ModelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getModelData(Request $request)
    {
        if(! isset($request->model) ){
            return false;
        }

        return $this->repository->getAllItems($request->model, $request->display);
    }

}