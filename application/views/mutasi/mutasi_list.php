<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">LAPORAN MUTASI</h3>
                    </div>

        <div class="box-body">


    <form method="post" action="<?php site_url();?>mutasi/get">

        <div id="form-tanggal">
            <label>Tanggal Awal</label><br>
            <input type="date" name="tanggal_a" class="input-tanggal" />

        </div>
        <div id="form-tanggal">
            <label>Tanggal Akhir</label><br>
            <input type="date" name="tanggal_b" class="input-tanggal" />
            <br /><br />
        </div>



        <button type="submit">Tampilkan</button>
        <a href="<?php echo base_url(); ?>mutasi">Reset Filter</a>
    </form>


    <!-- <b><?php echo $ket; ?></b><br /><br /> -->
    <!-- <a href="<?php echo $url_cetak; ?>">CETAK PDF</a><br /><br /> -->
    <?php
if (!empty($transaksi)) {?>
    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Saldo Awal</th>
        <th>Masuk</th>
        <th>Keluar</th>
        <th>Saldo AKhir</th>

    </tr>
    <?php

 $no = 1;
 foreach ($transaksi as $data) {
  $tgl = date('d-m-Y', strtotime($data->datetime));

  echo "<tr>";
  echo "<td>" . $no . "</td>";
  echo "<td>" . $tgl . "</td>";
  echo "<td>" . $data->nama . "</td>";
  echo "<td>" . $data->saldoAwal . "</td>";
  echo "<td>" . $data->masuk . "</td>";
  echo "<td>" . $data->keluar . "</td>";
  echo "<td>" . $data->akhir . "</td>";
//   echo "<td>" . $data->stok_keluar . "</td>";
  echo "<td></td>";

  //echo "<td>".$data->jenis."</td>";

  echo "</tr>";
  $no++;
 }
}
?>
    </table>

    </section>
    </div>