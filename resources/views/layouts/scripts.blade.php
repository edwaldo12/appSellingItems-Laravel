<!-- jQuery 3 -->
<script src="{{ url('') }}/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('') }}/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- DataTables -->
<script src="{{ url('') }}/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('') }}/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="{{ url('') }}/adminlte/bower_components/raphael/raphael.min.js"></script>
<script src="{{ url('') }}/adminlte/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="{{ url('') }}/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{ url('') }}/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ url('') }}/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('') }}/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ url('') }}/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="{{ url('') }}/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{ url('') }}/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('') }}/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{{ url('') }}/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ url('') }}/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('') }}/adminlte/dist/js/adminlte.min.js"></script>

<script>
    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString();
        split = number_string.split(',');
        sisa = split[0].length % 3;
        rupiah = split[0].substr(0, sisa);
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return "Rp. " + rupiah;
    }
</script>
