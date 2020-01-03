    <?php $this->load->view('kasir/kasir1/_partial/head')?>
            <!-- content -->
            <font size="4">
            <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-warning box-solid">

                            <div class="box-header">
                                <h3 class="box-title">TRANSAKSI</h3>
                            </div>

                <div class="box-body">
                <div style="padding-bottom: 10px;">


            <table class='table table-bordered'>

            <tr>
                <td>Tanggal</td>
                <td><?php echo date('Y-m-d'); ?></strong></td>
                <td>Jam</td>
                <td><?php echo date('H:i'); ?></td>
            </tr>
            <tr>
                <td>No Transaksi</td>
                <?php $notrans = $kode_m_kasir . "" . notrans();?>
                <td>
                <?php echo $notrans; ?></td>

            </tr>

                <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Notrans</th>
		    <th>Nama Barang</th>
		    <th>Qty</th>
		    <th>Harga</th>
            <th class="sum">Jumlah</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                </tr>
            </tfoot>

        </table>

                <form name="form" id="form" action ="<?php base_url('');?>kasir1/insert_trans" method="post" target="_blank">
                <input type="hidden" name="kode_m_kasir" value="<?php echo $kode_m_kasir; ?>" />
                <input type="hidden" id="notrans" name="notrans" value="<?php echo $notrans; ?>">
                <table>
                    <tr>
                        <td width="200px">
                            <input type="button" class="btn btn-block btn-warning btn-lg" onclick="location.href='<?php base_url();?>kasir1/group';" value="JUAL" />
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td width="200px">
                            <!-- <input type="submit" target="_blank" class="btn btn-block btn-success btn-lg" value="SAVE" /> -->

                            <!-- <button type="submit" class="btn btn-block btn-success btn-lg" value="SIMPAN">SIMPAN</button> -->
                            <!-- <a type="submit" class="btn btn-block btn-success btn-lg" href="<?php base_url() . 'kasir1/print/' . $notrans;?>"  onclick="document.getElementById('form').submit()">SAVE</a> -->
                            <button type="submit" class="btn btn-block btn-success btn-lg" onclick="myFunction()">SIMPAN</button>
                            <!-- <button type="submit" class="btn btn-block btn-success btn-lg" target="_blank">SIMPAN</button> -->

                        </td>
                    </tr>
                </table>

                </form>
                </div>
                            </div>
                    </div>
                    </div>
            </section>
        </div>

        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script>
        function myFunction() {
            location.reload();
        }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                var numFormat = $.fn.dataTable.render.number( '\,', '.', 0 ).display;
                var api = this.api(), data;

                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/Rp |,/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // computing column Total the complete result
                var jumlahSemua = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );


                $( api.column( 5 ).footer() ).html(numFormat(jumlahSemua));
                },
					responsive: true,
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "kasir1/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_trans",
                            "orderable": false
                        },{"data": "notrans"},{"data": "nama"},{"data": "qty"},
                        {"data": "harga",render: $.fn.dataTable.render.number(',', '.', 0, '')},
                        {"data": "jumlah",render: $.fn.dataTable.render.number(',', '.', 0, '')},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>

            </font>
            <!-- /.content-wrapper -->
            <?php $this->load->view('kasir/kasir1/_partial/footer')?>
