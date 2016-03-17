@extends('admin::default.blocks._template')

@section('field')

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                <label>Text</label>
                <textarea class="form-control ckeditor" id="field_{{$identifier}}_{{ time() }}" rows="10" name="content[{{ $identifier }}][body]">{!! $item->body !!}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
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
                        <div class="btn btn-primary imageBrowse ladda-button"><span class="ladda-label"><i class="fa fa-upload"></i> {{ trans('admin::lang.image.browse') }}</div></span>
                        <div class="btn btn-danger imageRemove"><i class="fa fa-times"></i> {{ trans('admin::lang.image.remove') }}</div>
                    </div>
                    <input name="content[{{ $identifier }}][image_id]" type="hidden" value="{{ $item->image_id }}">
                    <input name="content[{{ $identifier }}][image_path]" class="imageValue" type="hidden" value="{{ $item->relatedImage('path') }}">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            window.imageupload = new ImageUpload('.imageUpload');

            var flow = new Flow();

            flow.on('uploadStart', function(file){
              loadingBtn = Ladda.create($imageBrowse[0]);
              loadingBtn.start();
            });

            flow.on('progress', function(file){
              if ( flow.progress() >= 1 ) {
                loadingBtn.stop();
              }
            });

            flow.on('complete', function(file){
              loadingBtn.stop();
            });

            $('.ckeditor').ckeditor();
        });
    </script>

@overwrite
