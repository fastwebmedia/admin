<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse{{str_slug($identifier)}}">{{ $item->contentType->title }} <i class="fa fa-angle-down pull-right"></i></a>
        </h4>
    </div>
    <div id="collapse{{str_slug($identifier)}}" class="panel-collapse collapse">
        <div class="panel-body">

            <div class="form-group row">
                <div class="col-xs-11">

                    <input type="hidden" name="content[{{ $identifier }}][id]" value="{{ $identifier }}" />
                    <input type="hidden" name="content[{{ $identifier }}][type]" value="{{ $item->contentType->id }}" />
                    <input type="hidden" name="content[{{ $identifier }}][position]" value="{{ $item->position }}" class="position" />

                    @yield('field')
                </div>
                <div class="col-xs-1">
                    <button type="button" class="btn btn-primary btn-sm moveUp"><i class="fa fa-angle-up"></i></button>
                    <button type="button" class="btn btn-primary btn-sm moveDown"><i class="fa fa-angle-down"></i></button>
                </div>
            </div>

            <hr />

            <div class="row">
                <div class="col-xs-12 text-right">
                    <button type="button" class="btn btn-danger btn-sm removeContent"><i class="fa fa-remove"></i> Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
