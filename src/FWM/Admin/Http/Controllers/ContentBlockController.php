<?php namespace FWM\Admin\Http\Controllers;

use FWM\Admin\Models\Content;
use Illuminate\Routing\Controller;

class ContentBlockController extends Controller
{

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 */
	public function show($id)
	{
		$content = new Content(['content_type_id' => $id]);

		return $content->getContentFieldClass()->render();
	}

}
