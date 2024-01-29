<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('permendagri') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('Kode')) echo 'has-error'?> ">
                            <label for="varchar">Kode</label>
                            <input type="text" class="form-control" name="Kode" id="Kode" placeholder="Kode" value="<?php echo $Kode; ?>" />
                            <?php echo form_error('Kode', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan')) echo 'has-error'?> ">
                            <label for="varchar">Bidang Urusan Program Kegiatan Sub Kegiatan</label>
                            <input type="text" class="form-control" name="Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan" id="Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan" placeholder="Bidang Urusan Program Kegiatan Sub Kegiatan" value="<?php echo $Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan; ?>" />
                            <?php echo form_error('Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('Kinerja')) echo 'has-error'?> ">
                            <label for="varchar">Kinerja</label>
                            <input type="text" class="form-control" name="Kinerja" id="Kinerja" placeholder="Kinerja" value="<?php echo $Kinerja; ?>" />
                            <?php echo form_error('Kinerja', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('Indikator')) echo 'has-error'?> ">
                            <label for="varchar">Indikator</label>
                            <input type="text" class="form-control" name="Indikator" id="Indikator" placeholder="Indikator" value="<?php echo $Indikator; ?>" />
                            <?php echo form_error('Indikator', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('Satuan')) echo 'has-error'?> ">
                            <label for="varchar">Satuan</label>
                            <input type="text" class="form-control" name="Satuan" id="Satuan" placeholder="Satuan" value="<?php echo $Satuan; ?>" />
                            <?php echo form_error('Satuan', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('p_id')) echo 'has-error'?> ">
                            <label for="varchar">P Id</label>
                            <input type="text" class="form-control" name="p_id" id="p_id" placeholder="P Id" value="<?php echo $p_id; ?>" />
                            <?php echo form_error('p_id', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="id_nya" value="<?php echo $id_nya; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>