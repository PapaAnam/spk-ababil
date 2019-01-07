@if(config('app.is_online'))
@php
$_pengaturan = \App\Pengaturan::where('key', 'font')->first();
$font = $_pengaturan->value;
$_pengaturan = \App\Pengaturan::where('key', 'style_font')->first();
$styleFont = $_pengaturan->value;
@endphp
@if ($font == 'default')

@else
<link href="{!!$font!!}" rel="stylesheet">
<style>
* {
	{!! $styleFont !!}
}
</style>
@endif
@endif