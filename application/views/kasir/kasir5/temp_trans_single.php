<?php
$kode_barang = $this->uri->segment(3); ?>
<?php $this->load->view('kasir/kasir5/_partial/head'); ?>

<font size="4">
    <!-- content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning box-solid">

                        <div class="box-header">
                            <h3 id="judul-transaksi" class="box-title">TRANSAKSI UMUM</h3>
                        </div>

                        <div class="box-body">
                            <div style="padding-bottom: 10px;">


                                <table>
                                    <form name="jual" action="<?php echo site_url('kasir5/jual_single'); ?>" method="post" onsubmit="return cekstok()">
                                        <tr>
                                            <td style="width:100px" rowspan="3"><?php
                                                                                $query = $this->db->query("SELECT
                    tb.kode_barang,tb.kode_barang,tb.kode_barang,tb.nama,tb.gambar,smk.stok
                FROM
                    tab_barang tb
                INNER JOIN
                    stock_m_kasir smk ON tb.kode_barang = smk.kode_barang
                WHERE
                    tb.kode_barang = '$kode_barang' AND smk.kode_m_kasir = '$kode_m_kasir'
                LIMIT 1");
                                                                                foreach ($query->result() as $row) {
                                                                                    echo "<a href=\"#\"><image class=\"rounded float-left\" title=$row->nama id='$row->kode_barang' src=" . base_url() . "upload/image/" . $row->gambar . " height=\"200\" width=\"200\" style=\"padding-right: 20px;padding-bottom: 20px;\"></a>";
                                                                                    //echo "<a href=\"#\"><image class=\"rounded float-left\" title=$row->nama id='$row->kode_barang' src=".base_url()."upload/image/".$row->gambar." height=\"200\" width=\"200\" style=\"padding-right: 20px;padding-bottom: 20px;\"></a>";
                                                                                ?>
                                            </td>
                                            <td style="width:150px">Kode Barang</td>
                                            <td style="width:5px">:</td>
                                            <td style="width:200px"><?php echo $row->kode_barang; ?></td>
                                            <td>
                                                <div class="col-xs-12">
                                                    <label for="inputlg">QTY</label>
                                                    <input class="form-control input-lg" name="qty" id="qty" type="text" required>
                                                </div>
                                            </td>
                                            <td><input id="tipe-cust" type="checkbox" data-onstyle="primary" data-on="Agen" data-off="Umum" data-toggle="toggle" data-size="normal" value="get_harga">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>:</td>
                                            <td><?php echo $row->nama; ?></td>
                                            <td>
                                                <div class="col-xs-12">
                                                    <label for="inputlg">Harga</label>
                                                    <input class="form-control input-lg" name="harga" id="harga" type="text" readonly>
                                                </div>
                                            </td>
                                            <td><input id="tipe-agen" type="checkbox" data-offstyle="warning" data-onstyle="success" data-on="Agen B" data-off="Agen A" data-toggle="toggle" data-size="normal"></td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td>:</td>
                                            <td><input type="hidden" id="stok" name="stok" value="<?php echo $row->stok; ?>" /> <?php echo $row->stok; ?></td>
                                            <td>
                                                <div class="col-xs-12">
                                                    <label for="inputlg">Jumlah</label>
                                                    <input class="form-control input-lg" name="jumlah" id="jumlah" type="text" readonly>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> &nbsp;&nbsp; </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align="right">
                                                <input type="hidden" name="hpp" id="hpp" type="text">
                                                <input type="hidden" name="agen" id="agen" type="text">
                                                <input type="hidden" id="kode_barang" name="kode_barang" value="<?php echo $kode_barang; ?>" />
                                                <input type="hidden" id="kode_m_kasir" name="kode_m_kasir" value="<?php echo $kode_m_kasir; ?>" />
                                                <input type="hidden" id="notrans" name="notrans" value="<?php echo $kode_m_kasir . "" . notrans(); ?>" />
                                                <!-- <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> JUAL</button>  -->
                                                <button type="submit" value="Submit" class="btn btn-block btn-warning btn-lg"><i class="glyphicon glyphicon-shopping-cart">JUAL</i></button>

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
<?php }; ?>

<script>
    function cekstok() {
        var stok = parseInt($("#stok").val());
        var qty = parseInt($("#qty").val());
        if (stok < qty) {
            alert("Stok tidak cukup");
            return false;
        }
    }
</script>
<script src="<?php echo base_url('assets/js/jquery.mask.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.mask.min.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        //DISABLE tipe-agen
        var tipe_cust = $('#tipe-cust').val()
        if (tipe_cust = "get_harga") {
            document.getElementById("tipe-agen").disabled = true;
        }
        //END DISABLE tipe-agen

        //GET CHECKBOX
        $('#tipe-cust').change(function() {
            if (this.checked) {
                $('#judul-transaksi').text("TRANSAKSI AGEN A");
                $('#agen').val("1");
                document.getElementById("judul-transaksi").style.color = "blue";
                document.getElementById("judul-transaksi").style.fontWeight = "900";
                document.getElementById("tipe-agen").disabled = false;
                $('#tipe-cust').val("get_harga_agenKecil");
            } else {
                $('#judul-transaksi').text("TRANSAKSI UMUM");
                $('#agen').val("0");
                document.getElementById("judul-transaksi").style.color = "white";
                document.getElementById("judul-transaksi").style.fontWeight = "500";
                document.getElementById("tipe-agen").disabled = true;
                $('#tipe-cust').val("get_harga");
            }
        });

        $('#tipe-agen').change(function() {
            if (this.checked) {
                $('#judul-transaksi').text("TRANSAKSI AGEN B");
                $('#agen').val("1");
                document.getElementById("judul-transaksi").style.color = "blue";
                document.getElementById("judul-transaksi").style.fontWeight = "900";
                $('#tipe-cust').val("get_harga_agenBesar");
            } else {
                $('#judul-transaksi').text("TRANSAKSI AGEN A");
                $('#agen').val("1");
                document.getElementById("judul-transaksi").style.color = "blue";
                document.getElementById("judul-transaksi").style.fontWeight = "900";
                $('#tipe-cust').val("get_harga_agenKecil");
            }
        });
        //END GET CHECKBOX

        //NUMPAD
        window.addEventListener("load", function() {
            // Bare minimum - provide the IDready
            numpad.attach({
                id: "qty"
            });
            // The options
        });
        //END NUMPAD
    });

    function countHrg() {
        var kode_barang = $("#kode_barang").val();
        var kode_m_kasir = $("#kode_m_kasir").val();
        var checkbox = $('#tipe-cust').val();
        var qty = $("#qty").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>kasir5/" + checkbox,
            dataType: "JSON",
            data: {
                qty,
                kode_barang,
                kode_m_kasir
            },
            cache: false,
            success: function(data) {
                $.each(data, function(qty, kode_barang, kode_m_kasir) {
                    $('[name="harga"]').val(data.harga);
                    $('[name="hpp"]').val(data.hpp);
                    var qty = $("#qty").val();
                    var harga = $("#harga").val();

                    var jumlah = qty * harga;
                    $("#jumlah").val(jumlah);
                });

            }
        });
        return false;
    }

    $('#jual').submit(function(e) {
        var empty = 0;
        $('input[type=text]').each(function() {
            if (this.value == "") {
                empty++;
            }
        })
        if (empty === 0) {
            alert('perfect'); //Doesnt have to be here
        } else {
            alert(empty + ' empty input(s)');
            e.preventDefault();
        }

    });
</script>


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
</font>
<!-- /.content-wrapper -->
<?php $this->load->view('kasir/kasir5/_partial/footer') ?>