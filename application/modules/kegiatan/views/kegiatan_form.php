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
                        <a href="<?php echo base_url('kegiatan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('kdKeg')) echo 'has-error'?> ">
                            <label for="varchar">KdKeg</label>
                            <input type="text" class="form-control" name="kdKeg" id="kdKeg" placeholder="KdKeg" value="<?php echo $kdKeg; ?>" />
                            <?php echo form_error('kdKeg', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('nmKeg')) echo 'has-error'?> ">
                            <label for="nmKeg">NmKeg</label>
                            <textarea class="form-control" rows="3" name="nmKeg" id="nmKeg" placeholder="NmKeg"><?php echo $nmKeg; ?></textarea>
                            <?php echo form_error('nmKeg', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('p_id')) echo 'has-error'?> ">
                            <label for="varchar">P Id</label>
                            <input type="text" class="form-control" name="p_id" id="p_id" placeholder="P Id" value="<?php echo $p_id; ?>" />
                            <?php echo form_error('p_id', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="idKeg" value="<?php echo $idKeg; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>