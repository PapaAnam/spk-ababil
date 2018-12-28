@php
Auth::user()->update([
	'api_token'=>bcrypt(Auth::user()->email.date('YmdHis'))
])
@endphp
<meta name="api-token" content="{{Auth::user()->api_token}}">