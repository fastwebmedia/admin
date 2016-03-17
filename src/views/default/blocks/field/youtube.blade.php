@extends('admin::default.blocks._template')

@section('field')
    
    <input type="text" class="form-control" name="content[{{ $identifier }}][body]" value="{{ $item->body }}" />
    <div class="help-block">{{ trans('admin::lang.field.youtube.help') }}</div>

    @if($item->body)
    <div class="push">
        <a href="https://www.youtube.com/watch?v={{ $item->body }}" title="View YouTube Video" target="_blank">View Video</a>
    </div>
    @endif

@overwrite