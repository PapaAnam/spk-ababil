<div class="form-group">
  <label for="{{ $id }}" class="col-lg-2 control-label">{{ $label }}</label>
  <div class="col-sm-6">
    <select name="{{ isset($name) ? $name : $id }}" type="text" class="form-control select2" id="{{ $id }}" data-placeholder="{{ $label }}" style="width: 100%;">
    	@foreach($selectData as $s)
    	<option  
    	@if(old($id)) 
    		@if(is_array(old($id)))
    			@if(old($id)[$index] == $s['value'] )
    				selected
				@endif
            @else
                @if(old($id) == $s['value'])
                    selected
                @endif
			@endif
    	@elseif(isset($selected))
    		@if($selected == $s['value'])
    			selected
    		@endif
    	@endif
    	" value="{{ $s['value'] }}">{{ $s['text'] }}</option>
    	@endforeach
    </select>
  </div>
</div>