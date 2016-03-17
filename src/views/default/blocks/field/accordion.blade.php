@extends('admin::default.blocks._template')

@section('field')

    <div class="form-group">
        <label>Heading</label>
        <input type="text" class="form-control ckeditor" name="content[{{ $identifier }}][title]" value="{{ $item->title }}" />
    </div>

    <div class="form-group">
        <label>Body</label>
        <textarea class="form-control ckeditor" id="field_{{$identifier}}_{{ time() }}" rows="8" name="content[{{ $identifier }}][body]">{!! $item->body !!}</textarea>
    </div>

    <script type="text/javascript">
        $(function() {
            $('.ckeditor').ckeditor();
        });
    </script>

@overwrite
