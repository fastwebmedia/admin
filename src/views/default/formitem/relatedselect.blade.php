<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	<div class="row">
		<div class="col-xs-12 form-group">
			<div>
				<label for="{{ $name }}">{{ $label }}</label>
			</div>
			<select id="{{ $name }}" name="{{ $name }}" class="form-control multiselect" size="2" data-select-type="single" {!! ($nullable) ? 'data-nullable="true"' : '' !!}>
				@if ($nullable)
					<option value=""></option>
				@endif
				@foreach ($options as $option)
					<option value="{{ array_get($option, 'field') }}"
							data-model="{{ array_get($option, 'model') }}"
							data-display="{{ array_get($option, 'display', 'title') }}"
							{!! ($value == array_get($option, 'label')) ? 'selected="selected"' : '' !!}>
						{{ array_get($option, 'label') }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="col-xs-12 form-group">
			<div>
				<label for="{{ $relatedFieldName }}">{{ $relatedFieldLabel }}</label>
			</div>
			<select id="{{ $relatedFieldName }}" name="{{ $relatedFieldName }}" class="form-control multiselect" size="2" data-select-type="single" {!! ($relatedFieldPlaceholder) ? 'data-placeholder="'.$relatedFieldPlaceholder.'"' : '' !!}></select>
		</div>
	</div>
	@if(isset($help))
		<div class="help-block">{!! $help !!}</div>
	@endif
	@include(AdminTemplate::view('formitem.errors'))
</div>

<script type="text/javascript">
	$(function(){

		var $itemSelect = $("#{{ $name }}"),
			$targetSelect = $("#{{ $relatedFieldName }}"),
			currentItemId = "{{ $instance->item_id }}";

		$itemSelect.on('change', function(){
			var model = $('option:selected', this).data('model'),
				display	= $('option:selected', this).data('display');

			if(model){
				getData(model, display);
			}
		}).trigger('change');

		function getData(model, display)
		{
			$.ajax({
				type: 'POST',
				url: '{{ route('admin.formitems.relatedselect.getModelData') }}',
				data: {
					model: model,
					display: display
				},
				success: function(result){

					setData(result);
				},
				error: function(xhr){
					var error = $.parseJSON(xhr.responseText);
					$.notify(error.message, 'error');
				}
			});
		}

		function setData(data)
		{
			$targetSelect.html('');

			$.each(data, function(key, value){
				$targetSelect.append($('<option>', { value : key, selected: (currentItemId==key) }).html(value));
			});

			$targetSelect.trigger('chosen:updated');
		}
	});
</script>
