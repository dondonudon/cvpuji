<?php $data = $this->db->query("SELECT
								msk.nostokkasir, mk.kode_m_kasir, mk.nama as nama_kasir, msk.datetime, mskd.kode_barang, tb.nama, mskd.stok
								FROM
									master_stok_agen msk
								INNER JOIN master_stok_agen_detail mskd  ON
									msk.nostokkasir = mskd.nostokkasir
								INNER JOIN tab_barang tb on
									mskd.kode_barang = tb.kode_barang
								INNER JOIN master_kasir mk on
									mk.kode_m_kasir = msk.kode_m_kasir
								WHERE
									msk.nostokkasir = '$nostokkasir'");

?>


<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">DATA MASTER STOK KASIR</h3>

            </div>
			<table class='table table-bordered table-striped'>
			<form name="form" id="form" action ="<?php base_url('');?>insert_trans" method="post">
			<tr>
			<?php $row = $data->row();?>
				<td>Kasir</td>
				<td><?php echo $row->nama_kasir ?></td>
				<td>Tanggal</td>
				<td><?php echo $row->datetime ?></td>

			</tr>
			<tr>
				<td>No Transaksi</td>
				<td><?php echo $row->nostokkasir ?></td>


			</tr>
			</table>

			<div id="reload">
			<table class="table table-bordered table-striped" id="mydata">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Nama Barang</th>
					<th>Stok</th>
				</tr>
			</thead>
			<tbody id="show_data">
			<?php foreach ($data->result_array() as $isi) {?>
			<tr>
			<td><?php echo $isi['kode_barang']; ?></td>
			<td><?php echo $isi['nama']; ?></td>
			<td><?php echo $isi['stok']; ?></td>
			</tr>
			<?php }
;?>
			</tbody>
		</table>
		</form>

		</div>



</div>
</div>