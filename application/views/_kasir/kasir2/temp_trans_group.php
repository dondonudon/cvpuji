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
<font size="4">
    <?php $this->load->view('kasir/kasir2/_partial/head'); ?>
    <!-- content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-warning box-solid">

                        <div class="box-header">
                            <h3 class="box-title">PILIH GROUP</h3>
                        </div>

                        <div class="box-body">
                            <div style="padding-bottom: 10px;">


                                <table class='table table-bordered'>
                                    <form action="" method="post">
                                        <?php
                                        $query = $this->db->query('SELECT DISTINCT master_group.kode_group, master_group.nama_group, master_group.gambar FROM master_group
                            INNER JOIN tab_barang ON tab_barang.kode_group = master_group.kode_group
                            INNER JOIN stock_m_kasir ON stock_m_kasir.kode_barang = tab_barang.kode_barang');

                                        $result = $query->result_array();

                                        // echo $array;
                                        // echo $arrays;font-weight: bold;

                                        $kolom  = 6;
                                        $chunks = array_chunk($result, $kolom);
                                        echo '<table>';
                                        foreach ($chunks as $chunk) {
                                            echo '<tr>';
                                            foreach ($chunk as $galery) {
                                                echo '<td align="center">';
                                                echo '<div class="thumbnail">';
                                                echo '<a href=' . base_url() . 'kasir2/barang/' . $galery['kode_group'] . ' onclick=\"post\">';
                                                echo '<img vspace="10" hspace="10" height=\'200\' width=\'200\' src=' . base_url() . 'upload/image/' . $galery['gambar'] . '>';
                                                echo '<div class="caption post-content">' . $galery['nama_group'] . '</div>';
                                                echo '</div>';
                                                echo '</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        echo '</table>';

                                        ?>
                                    </form>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    </script>

    <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
</font>
<!-- /.content-wrapper -->
<?php $this->load->view('kasir/kasir2/_partial/footer') ?>