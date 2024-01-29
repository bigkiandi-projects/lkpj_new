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
                        <a href="<?php echo base_url('subkegiatan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('kdSubkeg')) echo 'has-error'?> ">
                            <label for="varchar">KdSubkeg</label>
                            <input type="text" class="form-control" name="kdSubkeg" id="kdSubkeg" placeholder="KdSubkeg" value="<?php echo $kdSubkeg; ?>" />
                            <?php echo form_error('kdSubkeg', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('nmSubkeg')) echo 'has-error'?> ">
                            <label for="nmSubkeg">NmSubkeg</label>
                            <textarea class="form-control" rows="3" name="nmSubkeg" id="nmSubkeg" placeholder="NmSubkeg"><?php echo $nmSubkeg; ?></textarea>
                            <?php echo form_error('nmSubkeg', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('kinerja')) echo 'has-error'?> ">
                            <label for="kinerja">Kinerja</label>
                            <textarea class="form-control" rows="3" name="kinerja" id="kinerja" placeholder="Kinerja"><?php echo $kinerja; ?></textarea>
                            <?php echo form_error('kinerja', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('indikator')) echo 'has-error'?> ">
                            <label for="indikator">Indikator</label>
                            <textarea class="form-control" rows="3" name="indikator" id="indikator" placeholder="Indikator"><?php echo $indikator; ?></textarea>
                            <?php echo form_error('indikator', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('satuan')) echo 'has-error'?> ">
                            <label for="varchar">Satuan</label>
                            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
                            <?php echo form_error('satuan', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('p_id')) echo 'has-error'?> ">
                            <label for="varchar">P Id</label>
                            <input type="text" class="form-control" name="p_id" id="p_id" placeholder="P Id" value="<?php echo $p_id; ?>" />
                            <?php echo form_error('p_id', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="idSubkeg" value="<?php echo $idSubkeg; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>