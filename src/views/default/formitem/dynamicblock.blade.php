<hr />

<div class="form-inline">
    <div class="form-group">
        <div>
            <label>Select Content Type</label>
        </div>

        <select id="selectContentType" name="contentType" class="form-control multiselect" data-select-type="single">
            <option value=""></option>
            @foreach ($contentTypes as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </select>

        &nbsp;
        <button type="button" class="btn btn-success btn-xs addContent">Add Content</button>

        {{--@include(AdminTemplate::view('formitem.errors'))--}}
    </div>
</div>

<hr />

<div id="dynamic-content">
    @forelse($contentFields as $field)

        {!! $field->render() !!}

    @empty
        <div class="well empty">
            <i>No content found.</i>
        </div>
    @endforelse
</div>