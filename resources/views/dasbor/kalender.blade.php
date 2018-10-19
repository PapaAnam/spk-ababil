<div class="row">
  <section class="col-lg-5 connectedSortable">
    <div class="box box-solid bg-green-gradient">
      <div class="box-header">
        <i class="fa fa-calendar"></i>
        <h3 class="box-title">Kalender</h3>
        <div class="pull-right box-tools">
          <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
          </button>
        </div>
      </div>
      <div class="box-body no-padding">
        <div id="calendar" style="width: 100%"></div>
      </div>
    </div>
  </section>
  <div class="col-md-7">
    <div class="box bg-yellow" style="border-top: 0;">
      <div class="box-header">
        <center><h3 class="box-title" style="color: white;">Memo</h3></center>
      </div>
      <div class="box-body">
        @if($memo)
        <table class="table memo">
          <tbody>
            <tr>
              <td>Tanggal</td>
              <td>: {{tglIndo($memo->tanggal)}}</td>
            </tr>
            <tr>
              <td>Deadline</td>
              <td>: {{tglIndo($memo->deadline)}}</td>
            </tr>
            <tr>
              <td>Kepada</td>
              <td>: 
                @foreach($memo->pelaksana as $p)
                {{ $p->karyawan ? $p->karyawan->nama : "" }}@if($loop->last) @else,@endif
                @endforeach
                <br>
                @foreach($memo->jeniskaryawan as $p)
                {{ $p->jeniskaryawan }}@if($loop->last) @else,@endif
                @endforeach
              </td>
            </tr>
            <tr>
              <td>Pesan</td>
              <td>: {{$memo->pesan}}</td>
            </tr>
          </tbody>
        </table>
        @else
        <center>Tidak ada memo</center>
        @endif
      </div>
    </div>
  </div>
</div>