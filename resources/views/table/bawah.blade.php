  @include('footer')
  @include('sidebar')
</div>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
@stack('js')
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script>
	$(function () {
		$("#dt").DataTable( {
			"language": {
				"lengthMenu": "Menampilkan _MENU_ baris data per halaman",
				"zeroRecords": "Tidak ada data",
				"info": "Menampilkan halaman _PAGE_ of _PAGES_",
				"infoFiltered": "(filtered from _MAX_ total records)",
				"search":'Pencarian',
				"paginate": {
					"previous": "Sebelumnya",
					"next":"Selanjutnya"
				}
			}
		} );
	});
</script>
@stack('script')
</body>
</html>
