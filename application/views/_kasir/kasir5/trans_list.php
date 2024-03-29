<?php $this->load->view('kasir/kasir5/_partial/head'); ?>
<font size="4">
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning box-solid">

                        <div class="box-header">
                            <h3 class="box-title">LAPORAN TRANSAKSI</h3>
                        </div>

                        <div class="box-body">
                            <div style="padding-bottom: 10px;">
                                <form id="form-filter" class="form-horizontal">

                                    <div class="form-group">
                                        <label for="FirstName" class="col-sm-2 control-label">Tanggal Awal</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="input-tanggal" id="tgl_a">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="FirstName" class="col-sm-2 control-label">Tanggal Akhir</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="input-tanggal" id="tgl_b">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="LastName" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-4">
                                            <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                                            <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Notrans</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</font>

<script type="text/javascript">
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({
            "footerCallback": function(row, data, start, end, display) {
                var numFormat = $.fn.dataTable.render.number('\,', '.', 0).display;
                var api = this.api(),
                    data;

                // converting to interger to find total
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/Rp |,/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // computing column Total the complete result
                var jumlahSemua = api
                    .column(2)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                $(api.column(2).footer()).html(numFormat(jumlahSemua));
            },

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "paging": false, //disable paging

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('kasir5_trans/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_a = $('#tgl_a').val();
                    data.tgl_b = $('#tgl_b').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(); //just reload table
        });

    });
</script>
<script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
<script>
    $(document).ready(function() { // Ketika halaman selesai di load
        $('.input-tanggal').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });
    })
</script>
<?php $this->load->view('kasir/kasir5/_partial/footer') ?>