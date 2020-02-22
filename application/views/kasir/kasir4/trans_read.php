<?php
$data2 = array('kode_m_kasir' => 1);

$this->load->view('kasir/kasir4/_partial/head', $data2);
$data = $this->db->query("SELECT
                                t.id_trans,
                                t.notrans,
                                t.kode_m_kasir,
                                mk.nama as nama_kasir,
                                t.jumlah,
                                t.`datetime`,
                                td.kode_barang,
                                tb.nama,
                                td.qty,
                                td.harga,
                                td.jumlah as subtotal
                            FROM
                                trans t
                            INNER JOIN trans_detail td ON
                                t.notrans = td.notrans
                            INNER JOIN tab_barang tb on
                                td.kode_barang = tb.kode_barang
                            INNER JOIN master_kasir mk ON
                                mk.kode_m_kasir = t.kode_m_kasir
                            WHERE
                                t.notrans = '$notrans'");

?>
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
                                <table width="100%">
                                    <tr>
                                        <?php $row = $data->row(); ?>
                                        <td>No Transaksi</td>
                                        <td>:</td>
                                        <td><?php echo $row->notrans; ?></td>
                                        <td>Tgl Transaksi</td>
                                        <td>:</td>
                                        <td><?php echo $row->datetime; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Kasir</td>
                                        <td>:</td>
                                        <td><?php echo $row->nama_kasir; ?></td>
                                        <td>Jumlah</td>
                                        <td>:</td>
                                        <td><?php echo rupiah($row->jumlah); ?></td>
                                    </tr>
                                </table>
                                <hr>
                                <p>
                                    <table class='table table-bordered'>
                                        <thead>
                                            <tr>
                                                <td>Nama Barang</td>
                                                <td>QTY</td>
                                                <td>Harga</td>
                                                <td>Subtotal</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($data->result_array() as $isi) {

                                            ?>
                                                <tr>
                                                    <td><?php echo $isi['nama']; ?></td>
                                                    <td><?php echo $isi['qty']; ?></td>
                                                    <td><?php echo rupiah($isi['harga']); ?></td>
                                                    <td><?php echo rupiah($isi['subtotal']); ?></td>
                                                </tr>
                                            <?php }; ?>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="3">
                                                    Jumlah
                                                </td>
                                                <td><?php echo rupiah($row->jumlah); ?></td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</font>
<?php $this->load->view('kasir/kasir4/_partial/footer') ?>