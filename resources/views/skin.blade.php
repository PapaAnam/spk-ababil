@php
$_pengaturan = \App\Pengaturan::where('key', 'skin')->first();
$skin = $_pengaturan->value;
@endphp
<body class="hold-transition {{$skin}} sidebar-mini">