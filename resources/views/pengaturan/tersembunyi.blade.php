<form action="{{ route('pengaturan.post') }}" method="post">
	@csrf
	@foreach ($pengaturan as $p)
	{{$p->key}}
	<br>
	<input type="text" name="{{$p->key}}" value="{{$p->value}}">
	<br>
	@endforeach
	<button type="submit">Kirim</button>
</form>