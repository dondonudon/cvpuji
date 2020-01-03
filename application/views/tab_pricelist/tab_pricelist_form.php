<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TAB_PRICELIST</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

<table class='table table-bordered'>

		<tr><td width='200'>Barang <?php echo form_error('kode_barang') ?></td>
		<td>
			<?php echo select2_dinamis('kode_barang', 'tab_barang', 'nama', 'kode_barang', 'Nama Barang') ?>
		</td></tr>
		<?php
$query = $this->db->query("SELECT * FROM tab_kasir")->result_array();
foreach ($query as $key) {
 echo "<input type=\"hidden\" name=\"kode_kasir[]\" id=\"kode_kasir[]\" value=" . $key['kode_kasir'] . ">";
 echo "<tr><td width='200'>" . $key['nama'] . "</td><td><input type=\"text\" class=\"form-control\" name=\"harga[]\" id=\"harga[]\" placeholder=\"Harga\"></td></tr>";
 //  echo $key['kode_kasir'];
 //  echo $key['nama'];
}
?>
	    <!-- <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr> -->
	    <!-- <tr><td width='200'>Opsi1 <?php echo form_error('opsi1') ?></td><td><input type="text" class="form-control" name="opsi1" id="opsi1" placeholder="Opsi1" value="<?php echo $opsi1; ?>" /></td></tr>
	    <tr><td width='200'>Opsi2 <?php echo form_error('opsi2') ?></td><td><input type="text" class="form-control" name="opsi2" id="opsi2" placeholder="Opsi2" value="<?php echo $opsi2; ?>" /></td></tr>
	    <tr><td width='200'>Opsi3 <?php echo form_error('opsi3') ?></td><td><input type="text" class="form-control" name="opsi3" id="opsi3" placeholder="Opsi3" value="<?php echo $opsi3; ?>" /></td></tr>
	    <tr><td width='200'>Opsi4 <?php echo form_error('opsi4') ?></td><td><input type="text" class="form-control" name="opsi4" id="opsi4" placeholder="Opsi4" value="<?php echo $opsi4; ?>" /></td></tr>
	    <tr><td width='200'>Opsi5 <?php echo form_error('opsi5') ?></td><td><input type="text" class="form-control" name="opsi5" id="opsi5" placeholder="Opsi5" value="<?php echo $opsi5; ?>" /></td></tr> -->
	    <tr><td></td><td><input type="hidden" name="id_pricelist" value="<?php echo $id_pricelist; ?>" />
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
	    <a href="<?php echo site_url('tab_pricelist') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>