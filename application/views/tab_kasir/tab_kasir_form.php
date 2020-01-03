<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TIPE KASIR</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

<table class='table table-bordered'>

	    <tr><td width='200'>Nama <?php echo form_error('nama') ?></td><td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" /></td></tr>
	    <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
	    <tr><td width='200'>QTY Awal <?php echo form_error('qty_a') ?></td><td><input type="text" class="form-control" name="qty_a" id="qty_a" placeholder="QTY AWAL" value="<?php echo $qty_a; ?>" /></td></tr>
	    <tr><td width='200'>QTY Akhir <?php echo form_error('qty_b') ?></td><td><input type="text" class="form-control" name="qty_b" id="qty_b" placeholder="QTY AKHIR" value="<?php echo $qty_b; ?>" /></td></tr>
	    <!-- <tr><td width='200'>Opsi3 <?php echo form_error('opsi3') ?></td><td><input type="text" class="form-control" name="opsi3" id="opsi3" placeholder="Opsi3" value="<?php echo $opsi3; ?>" /></td></tr>
	    <tr><td width='200'>Opsi4 <?php echo form_error('opsi4') ?></td><td><input type="text" class="form-control" name="opsi4" id="opsi4" placeholder="Opsi4" value="<?php echo $opsi4; ?>" /></td></tr>
	    <tr><td width='200'>Opsi5 <?php echo form_error('opsi5') ?></td><td><input type="text" class="form-control" name="opsi5" id="opsi5" placeholder="Opsi5" value="<?php echo $opsi5; ?>" /></td></tr> -->
	    <tr><td></td><td><input type="hidden" name="kode_kasir" value="<?php echo $kode_kasir; ?>" />
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
	    <a href="<?php echo site_url('tab_kasir') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>