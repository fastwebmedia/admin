@extends('admin::default.blocks._template')

@section('field')

    <div class="form-group">
        <label>Vine Title</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][title]" value="{{ $item->title }}" />
    </div>

    <div class="form-group">
        <label>Vine URL or ID</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][body]" value="{{ $item->body }}" />
        <div class="help-block">{!! trans('admin::lang.field.vine.help') !!}</div>
    </div>

    @if($item->body)
    <div class="push">
        <a href="https://vine.co/v/{{ $item->body }}" title="View Vine Video" target="_blank">View Video</a>
    </div>
    @endif

@overwrite