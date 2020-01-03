<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA MASTER_KASIR</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

<table class='table table-bordered'>

	    <tr><td width='200'>Nama <?php echo form_error('nama') ?></td><td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" /></td></tr>

	    <tr><td width='200'>Alamat <?php echo form_error('alamat') ?></td><td><input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" /></td></tr>
	    <tr><td width='200'>Kota <?php echo form_error('kota') ?></td><td><input type="text" class="form-control" name="kota" id="kota" placeholder="Kota" value="<?php echo $kota; ?>" /></td></tr>
	    <tr><td width='200'>Telp <?php echo form_error('telp') ?></td><td><input type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" /></td></tr>
	    <tr><td width='200'>PIC <?php echo form_error('PIC') ?></td><td><input type="text" class="form-control" name="PIC" id="PIC" placeholder="PIC" value="<?php echo $PIC; ?>" /></td></tr>
	    <tr><td width='200'>Url <?php echo form_error('url') ?></td><td><input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url; ?>" /></td></tr>
	    <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
	    <!-- <tr><td width='200'>Opsi1 <?php echo form_error('opsi1') ?></td><td><input type="text" class="form-control" name="opsi1" id="opsi1" placeholder="Opsi1" value="<?php echo $opsi1; ?>" /></td></tr>
	    <tr><td width='200'>Opsi2 <?php echo form_error('opsi2') ?></td><td><input type="text" class="form-control" name="opsi2" id="opsi2" placeholder="Opsi2" value="<?php echo $opsi2; ?>" /></td></tr>
	    <tr><td width='200'>Opsi3 <?php echo form_error('opsi3') ?></td><td><input type="text" class="form-control" name="opsi3" id="opsi3" placeholder="Opsi3" value="<?php echo $opsi3; ?>" /></td></tr>
	    <tr><td width='200'>Opsi4 <?php echo form_error('opsi4') ?></td><td><input type="text" class="form-control" name="opsi4" id="opsi4" placeholder="Opsi4" value="<?php echo $opsi4; ?>" /></td></tr>
	    <tr><td width='200'>Opsi5 <?php echo form_error('opsi5') ?></td><td><input type="text" class="form-control" name="opsi5" id="opsi5" placeholder="Opsi5" value="<?php echo $opsi5; ?>" /></td></tr> -->
	    <tr><td></td><td><input type="hidden" name="kode_m_kasir" value="<?php echo $kode_m_kasir; ?>" />
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
	    <a href="<?php echo site_url('master_kasir') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>