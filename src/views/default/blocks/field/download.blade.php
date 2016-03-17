@extends('admin::default.blocks._template')

@section('field')

    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][title]" value="{{ $item->title }}" />
    </div>

    <div class="form-group">
        <label>Download Path</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][body]" value="{{ $item->body }}" />
        <div class="help-block">{{ trans('admin::lang.field.download.body') }}</div>
    </div>

@overwrite
