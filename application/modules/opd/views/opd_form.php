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
                        <a href="<?php echo base_url('opd') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('kdOpd')) echo 'has-error'?> ">
                            <label for="varchar">KdOpd</label>
                            <input type="text" class="form-control" name="kdOpd" id="kdOpd" placeholder="KdOpd" value="<?php echo $kdOpd; ?>" />
                            <?php echo form_error('kdOpd', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('nmOpd')) echo 'has-error'?> ">
                            <label for="varchar">NmOpd</label>
                            <input type="text" class="form-control" name="nmOpd" id="nmOpd" placeholder="NmOpd" value="<?php echo $nmOpd; ?>" />
                            <?php echo form_error('nmOpd', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="idOpd" value="<?php echo $idOpd; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>