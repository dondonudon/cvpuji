<style>
    .post-content {
        background: none repeat scroll 0 0 #FFFFFF;
        opacity: 0.8;
        top: 100px;
        left: 10px;
        position: absolute;
        font-size: 16px;
        font-weight: bold;
    }

    .thumbnail {
        position: relative;
    }
</style>
<?php $this->load->view('kasir/kasir5/_partial/head'); ?>
<font size="4">
    <!-- content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning box-solid">

                        <div class="box-header">
                            <h3 class="box-title">PILIH BARANG</h3>
                        </div>

                        <div class="box-body">
                            <div style="padding-bottom: 10px;">


                                <table class='table table-bordered'>
                                    <?php
                                    $query = $this->db->query("SELECT tb.kode_barang, tb.gambar, tb.nama, tb.ukuran FROM tab_barang tb 
                                              INNER JOIN stock_m_kasir smk ON tb.kode_barang = smk.kode_barang                                              
                                               WHERE tb.kode_group='$kode_group' AND smk.kode_m_kasir = '$kode_m_kasir'");
                                    $result = $query->result_array();

                                    // echo $array;
                                    // echo $arrays;

                                    $kolom = 7;
                                    $chunks = array_chunk($result, $kolom);
                                    echo '<table>';
                                    foreach ($chunks as $chunk) {
                                        echo '<tr>';
                                        foreach ($chunk as $galery) {
                                            echo '<td align="center">';
                                            echo '<div class="thumbnail">';
                                            echo '<a href=' . base_url() . 'kasir5/single/' . $galery['kode_barang'] . ' onclick=\"post\">';
                                            echo '<img vspace="10" hspace="10" width="170" height="170" src=' . base_url() . 'upload/image/' . $galery['gambar'] . '>';
                                            echo '<div class="caption post-content">' . $galery['nama'] . '<br>' . $galery['ukuran'] . ' gr</div>';
                                            echo '</div>';
                                            echo '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                    echo '</table>';

                                    ?>

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
</font>
<!-- /.content-wrapper -->
<?php $this->load->view('kasir/kasir5/_partial/footer') ?>