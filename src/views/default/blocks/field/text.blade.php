@extends('admin::default.blocks._template')

@section('field')

    <textarea class="form-control ckeditor" id="field_{{$identifier}}_{{ time() }}" rows="10" name="content[{{ $identifier }}][body]">{!! $item->body !!}</textarea>

    <script type="text/javascript">
        $(function() {
            $('.ckeditor').ckeditor();
        });
    </script>

@overwrite
