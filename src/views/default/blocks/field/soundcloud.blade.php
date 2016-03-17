@extends('admin::default.blocks._template')

@section('field')

    <div class="form-group">
        <label>Logo Title</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][title]" value="{{ $item->title }}" />
    </div>

    <div class="form-group">
        <label>SoundCloud Track ID</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][body]" value="{{ $item->body }}" />
        <div class="help-block">{!! trans('admin::lang.field.soundcloud.help') !!}</div>
    </div>

@overwrite