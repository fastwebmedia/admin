@extends('admin::default.blocks._template')

@section('field')

    <div class="form-group">
        <label>Video Title</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][title]" value="{{ $item->title }}" />
    </div>

    <div class="form-group">
        <label>YouTube URL or ID</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][body]" value="{{ $item->body }}" />
        <div class="help-block">{!! trans('admin::lang.field.youtube.help') !!}</div>
    </div>

    @if($item->body)
    <div class="push">
        <a href="https://www.youtube.com/watch?v={{ $item->body }}" title="View YouTube Video" target="_blank">View Video</a>
    </div>
    @endif

@overwrite