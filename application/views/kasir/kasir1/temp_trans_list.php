<?php $this->load->view('kasir/kasir1/_partial/head')?>
            <!-- content -->

            <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-warning box-solid">

                            <div class="box-header">
                                <h3 id="judul-transaksi" class="box-title">TRANSAKSI UMUM</h3>
                                <button type="button" class="btn btn-primary" style="float: right;" onclick="window.location.href = '<?php base_url();?>kasir1/group';">MANUAL</button>
                            </div>

                <div class="box-body">
                <div style="padding-bottom: 10px;">


            <table class='table table-bordered'>
            <tr>
                <td>Tipe Customer</td>
                <td>
                    <input id="tipe-cust" type="checkbox" data-onstyle="primary" data-on="Agen"  data-off="Umum" data-toggle="toggle" data-size="normal" value="get_barcode">
                    <input id="tipe-agen" type="checkbox" data-offstyle="warning" data-onstyle="success" data-on="Agen Besar"  data-off="Agen Kecil" data-toggle="toggle" data-size="normal">
                </td>
            </tr>
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
                <td>Barcode</td>
                <td><input type="hidden" name="kode_m_kasir" id="kode_m_kasir" value="<?php echo $kode_m_kasir; ?>">
                <input type="text" name="barcode" id="barcode" autofocus></td>



            </tr>
            </table>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <!-- <th>a</th> -->
                        <th>Notrans</th>
                        <th>Nama Barang</th>
                        <th>QTY</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                </tbody>
                <tfoot></tfoot>
            </table>


                <form name="form" id="form" action ="<?php base_url();?>kasir1/insert_trans" method="post" target="_blank">
                Bayar &nbsp; &nbsp; &nbsp;
                <input type="text" name="bayar" id="bayar" min="0" readonly onclick="show_easy_numpad_bayar(this);">
                <input type="hidden" name="kode_m_kasir" value="<?php echo $kode_m_kasir; ?>" />
                <input type="hidden" id="notrans" name="notrans" value="<?php echo $notrans; ?>">
                <br><br>
                <table>
                    <tr>
                        <!-- <td width="200px">
                            <input type="button" class="btn btn-block btn-warning btn-lg" onclick="location.href='<?php base_url();?>kasir1/group';" value="JUAL" />
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;</td> -->
                        <td width="200px">
                            <!-- <input type="submit" target="_blank" class="btn btn-block btn-success btn-lg" value="SAVE" /> -->


                            <button type="button" class="btn btn-block btn-success btn-lg" onclick="reload()">SIMPAN</button>


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
            function reload() {
                var bayar  = parseInt($("#bayar").val());
                var sum = parseInt($("#sum").val());
                if (sum==0) {
                    alert('Silahkan Lakukan Transaksi');
                    return false;
                }else if (bayar < sum) {
                    alert ('Kurang Bayar');
                    return false;
                } else if (bayar >= sum){
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                    $("#form").submit();
                    return true;
                }

            }
        </script>

        <script type="text/javascript">
            $(document).ready(function() {

                load_data();

                // FUNCTION UPDATE

                $(document).on('change', '.table_data', function(){

                    var id_trans = $(this).data('row_id');
                    var table_column = $(this).data('column_name');
                    var value = $(this).val();
                    $.ajax({
                    url:"<?php echo base_url(); ?>kasir1/update",
                    method:"POST",
                    data:{id_trans:id_trans, table_column:table_column, value:value},
                    success:function(data)
                    {
                        load_data();
                    }
                    });

                });

                //END FUNCTION UPDATE

                // FUNCTION DELETE
                $(document).on('click', '.btn_delete', function(){
                    var id = $(this).attr('id');
                    if(confirm("Are you sure you want to delete this?"))
                    {
                    $.ajax({
                        url:"<?php echo base_url(); ?>kasir1/delete",
                        method:"POST",
                        data:{id:id},
                        success:function(data){
                        load_data();
                        }
                    })
                    }
                });
                //END FUNCTION DELETE

                //DISABLE tipe-agen
                var tipe_cust = $('#tipe-cust').val()
                if (tipe_cust="get_barcode") {
                    document.getElementById("tipe-agen").disabled = true;
                }
                //END DISABLE tipe-agen

                //GET CHECKBOX
                $('#tipe-cust').change(function(){
                if (this.checked) {
                    $('#judul-transaksi').text("TRANSAKSI AGEN KECIL");
                    document.getElementById("judul-transaksi").style.color = "blue";
                    document.getElementById("judul-transaksi").style.fontWeight = "900";
                    document.getElementById("tipe-agen").disabled = false;
                    $('#tipe-cust').val("get_barcode_agenKecil");
                   } else {
                     $('#judul-transaksi').text("TRANSAKSI UMUM");
                     document.getElementById("judul-transaksi").style.color = "white";
                    document.getElementById("judul-transaksi").style.fontWeight = "500";
                    $('#tipe-agen').prop('checked', false).change()
                    document.getElementById("tipe-agen").disabled = true;
                     $('#tipe-cust').val("get_barcode");
                    }
                }
                );

                $('#tipe-agen').change(function(){
                if (this.checked) {
                    $('#judul-transaksi').text("TRANSAKSI AGEN BESAR");
                    document.getElementById("judul-transaksi").style.color = "blue";
                    document.getElementById("judul-transaksi").style.fontWeight = "900";
                    $('#tipe-cust').val("get_barcode_agenBesar");
                   } else {
                    $('#judul-transaksi').text("TRANSAKSI AGEN KECIL");
                    document.getElementById("judul-transaksi").style.color = "blue";
                    document.getElementById("judul-transaksi").style.fontWeight = "900";
                     $('#tipe-cust').val("get_barcode_agenKecil");
                    }
                }
                );
                //END GET CHECKBOX

                //GET BARCODE
                $('#barcode').on('change',function(){

                var kode_m_kasir    =$("#kode_m_kasir").val();
                var notrans         =$("#notrans").val();
                var checkbox        =$('#tipe-cust').val();
                var barcode         =$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url() ?>kasir<?php echo $kode_m_kasir ?>/"+checkbox,
                    dataType : "JSON",
                    data : {barcode,kode_m_kasir,notrans},
                    cache:false,
                    success: function(data){
                        $('[name="barcode"]').val('');
                        load_data();
                    }

                });
                    return false;
                });
                //END GET BARCODE
            });

            //FUNCTION LOAD
            function load_data()
                {
                    $.ajax({
                    url:"<?php echo base_url(); ?>kasir1/json",
                    dataType:"JSON",
                    success:function(data){
                    var sum = 0;
                    var numFormat = $.fn.dataTable.render.number( '\,', '.', 0 ).display;
                    var html = '<tr hidden>';
                    html += '<td hidden id="first_name" contenteditable placeholder="Enter First Name"></td>';
                    html += '<td hidden id="last_name" contenteditable placeholder="Enter Last Name"></td>';
                    html += '<td hidden id="age" contenteditable></td>';
                    html += '<td hidden id="age" contenteditable></td>';
                    html += '<td hidden id="age" contenteditable></td>';
                    html += '<td hidden><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span></button></td></tr>';


                    for(var i = 0; i < data.length; i++)
                    {
                    html += '<tr>';
                    html += '<td class="table_data" data-row_id="'+data[i].id_trans+'" data-column_name="notrans" >'+data[i].notrans+'</td>';
                    html += '<td class="table_data" data-row_id="'+data[i].id_trans+'" data-column_name="nama" >'+data[i].nama+'</td>';
                    html += '<td ><input class="table_data" data-row_id="'+data[i].id_trans+'" data-column_name="qty" id="table_data'+data[i].id_trans+'" placeholder="'+data[i].qty+'" size="2" max="9999" min="0" onclick="show_easy_numpad(this);" readonly></td>';
                    // html += '<td class="table_data" data-row_id="'+data[i].id_trans+'" data-column_name="qty" contenteditable>'+data[i].qty+'</td>';
                    html += '<td class="table_data" data-row_id="'+data[i].id_trans+'" data-column_name="harga" >'+numFormat(data[i].harga)+'</td>';
                    html += '<td class="jumlah" data-row_id="'+data[i].id_trans+'" data-column_name="jumlah" >'+numFormat(data[i].jumlah)+'</td>';
                    // html += '<td><button type="button" name="delete_btn" id="'+data[i].id_trans+'" class="btn btn-xs btn-success btn_edit"><span class="glyphicon glyphicon-pencil"></span></button>';
                    html += '<td><button type="button" name="delete_btn" id="'+data[i].id_trans+'" class="btn btn-xs btn-danger btn_delete"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';

                    sum += parseInt(data[i].jumlah);
                    //console.log(sum);

                    }

                    html += '<tr>';
                    html += '<td colspan="3"></td>';
                    html += '<td>Jumlah</td>';
                    html += '<td>'+numFormat(sum)+'</td>';
                    html += '<input type="hidden" id="sum" value = "'+sum+'">';
                    html += '</tr>';


                    $('#show_data').html(html);
                    //$('#footer').html(footer);
                    }
                    });

                }
            //END FUNCTION LOAD

            function countHrg(id) {
                var id_trans = $("#"+id).data('row_id');
                var table_column = $("#"+id).data('column_name');
                var value = $("#"+id).val();
                $.ajax({
                    url:"<?php echo base_url(); ?>kasir1/update",
                    method:"POST",
                    data:{id_trans:id_trans, table_column:table_column, value:value},
                    success:function(data)
                    {
                        load_data();
                    }
                });
            }
        </script>
        <script type="text/javascript">
            <?php if ($this->session->flashdata('success')) {?>
                alert("<?php echo $this->session->flashdata('success'); ?>");
            <?php } else if ($this->session->flashdata('error')) {?>
                alert("<?php echo $this->session->flashdata('error'); ?>");
            <?php }?>
        </script>


            <!-- /.content-wrapper -->
            <?php $this->load->view('kasir/kasir1/_partial/footer')?>
