<?php $this->load->view('kasir/kasir6/_partial/head'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA TRANS_DETAIL</h3>
                    </div>

                    <div class="box-body">
                        <div style="padding-bottom: 10px;"'>
        <!-- <?php echo anchor(site_url('trans_detail/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?></div> -->
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Notrans</th>
		    <th>Kode Barang</th>
		    <th>Kode M Kasir</th>
		    <th>Qty</th>
		    <th>Harga</th>
		    <th>Jumlah</th>
		    <th>Datetime</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
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
					responsive: true,
                    initComplete: function() {
                        var api = this.api();
                        $(' #mytable_filter input') .off('.DT') .on('keyup.DT', function(e) { if (e.keyCode==13) { api.search(this.value).draw(); } }); }, oLanguage: { sProcessing: "loading..." }, processing: true, serverSide: true, ajax: {"url": "trans_detail/json" , "type" : "POST" }, columns: [ { "data" : "id_trans" , "orderable" : false },{"data": "notrans" },{"data": "kode_barang" },{"data": "kode_m_kasir" },{"data": "qty" },{"data": "harga" },{"data": "jumlah" },{"data": "datetime" }, { "data" : "action" , "orderable" : false, "className" : "text-center" } ], order: [[0, 'desc' ]], rowCallback: function(row, data, iDisplayIndex) { var info=this.fnPagingInfo(); var page=info.iPage; var length=info.iLength; var index=page * length + (iDisplayIndex + 1); $('td:eq(0)', row).html(index); } }); }); </script> <?php $this->load->view('kasir/kasir6/_partial/footer') ?>