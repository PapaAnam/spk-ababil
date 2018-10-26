<label>
	<input id="{{$id}}" name="{{$id}}" type="radio" class="minimal" @isset($checked) @if($checked) checked="checked" @endif @endisset @isset ($value) value="{{$value}}" @endisset>
	{{$label}}
</label>