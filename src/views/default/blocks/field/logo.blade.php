@extends('admin::default.blocks._template')

@section('field')

    <div class="form-group">
        <label>Logo Title</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][title]" value="{{ $item->title }}" />
    </div>

    <div class="form-group row">
        <div class="col-md-4">
            <label>Upload Image</label>

            <div class="imageUpload" data-target="{{ route('admin.formitems.image.uploadImage') }}" data-token="{{ csrf_token() }}">
                <div>
                    <div class="thumbnail">
                        @if( $imagePath = $item->getRelatedImageAttribute() )
                            <img class="has-value" src="{{ $imagePath }}" width="200px" height="150px" />
                        @else
                            <img class="no-value" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" width="200px" height="150px" />
                            <img class="has-value hidden" src="" width="200px" height="150px" />
                        @endif
                    </div>
                </div>
                <div>
                    <div class="btn btn-primary imageBrowse"><i class="fa fa-upload"></i> {{ trans('admin::lang.image.browse') }}</div>
                    <div class="btn btn-danger imageRemove"><i class="fa fa-times"></i> {{ trans('admin::lang.image.remove') }}</div>
                </div>
                <input name="content[{{ $identifier }}][image_id]" type="hidden" value="{{ $item->image_id }}">
                <input name="content[{{ $identifier }}][image_path]" class="imageValue" type="hidden" value="{{ $item->relatedImage('path') }}">
            </div>

        </div>
    </div>

    <script type="text/javascript">
        window.imageupload = new ImageUpload('.imageUpload');
    </script>

@overwrite
