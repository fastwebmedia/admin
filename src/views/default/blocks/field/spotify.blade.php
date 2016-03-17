@extends('admin::default.blocks._template')

@section('field')

    <div class="form-group">
        <label>Spotify Username</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][title]" value="{{ $item->title }}" placeholder="michaeljackson" />
    </div>

    <div class="form-group">
        <label>Spotify Playlist ID</label>
        <input type="text" class="form-control" name="content[{{ $identifier }}][body]" value="{{ $item->body }}" placeholder="1EXZD5BXWHSN2Mdb7rzLj4" />
    </div>

@overwrite