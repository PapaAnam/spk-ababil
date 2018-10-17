@extends('my-container')
@section('other-box')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{$title}}</h3>
    </div>
    <div class="box-body">
        <dl class="dl-horizontal">
            @include('line',['label'=>'ID Proyek','text'=>$d->id])
            <hr>
            @include('line',['label'=>'Nama Proyek','text'=>$d->nama])
            <hr>
            <dt>Pelaksana</dt>
            <dd>
                <ul>
                    @foreach ($d->pelaksana as $p)
                    <li>{{$p->karyawan->nama}}</li>
                    @endforeach
                </ul>
            </dd>
            <hr>
            @include('line',['label'=>'Nama Perusahaan','text'=>$d->kliendetail->nama_perusahaan])
            <hr>
            @include('line',['label'=>'Qty','text'=>$d->qty])
            <hr>
            @include('line',['label'=>'Satuan','text'=>$d->satuandetail->nama])
            <hr>
            @include('line',['label'=>'Jumlah Tugas','text'=>$d->tugas_count])
            <hr>
            <dt>Persentase</dt>
            <dd>
                {{$d->persentase}}%
                <div class="progress active">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{$d->persentase}}%">
                        <span class="sr-only">{{$d->persentase}}% Complete</span>
                    </div>
                </div>
            </dd>
            <hr>
            @include('line',['label'=>'Waktu Mulai','text'=>$d->start_date_indo])
            <hr>
            @include('line',['label'=>'Waktu Akhir','text'=>$d->end_date_indo])
        </dl>
    </div>
    <div class="box-footer">
        <a href="{{$modul_link}}" class="btn btn-default btn-flat">Kembali</a>
    </div>
</div>
@endsection