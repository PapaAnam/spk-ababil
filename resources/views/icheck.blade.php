<label>
	<input id="{{$id}}" name="{{$id}}" type="checkbox" class="minimal" @isset($checked) @if($checked) checked="checked" @endif @endisset>
	{{$label}}
</label>