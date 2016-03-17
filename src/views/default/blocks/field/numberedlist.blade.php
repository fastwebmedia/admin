@extends('admin::default.blocks._template')

@section('field')

    <textarea class="form-control" rows="8" name="content[{{ $identifier }}][body]">{!! $item->body !!}</textarea>
    <div class="help-block">Each list item should be on a new line.</div>

@overwrite
