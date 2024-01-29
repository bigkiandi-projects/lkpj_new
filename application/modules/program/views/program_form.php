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
                        <a href="<?php echo base_url('program') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('kdProg')) echo 'has-error'?> ">
                            <label for="varchar">KdProg</label>
                            <input type="text" class="form-control" name="kdProg" id="kdProg" placeholder="KdProg" value="<?php echo $kdProg; ?>" />
                            <?php echo form_error('kdProg', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('nmProg')) echo 'has-error'?> ">
                            <label for="nmProg">NmProg</label>
                            <textarea class="form-control" rows="3" name="nmProg" id="nmProg" placeholder="NmProg"><?php echo $nmProg; ?></textarea>
                            <?php echo form_error('nmProg', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('p_id')) echo 'has-error'?> ">
                            <label for="varchar">P Id</label>
                            <input type="text" class="form-control" name="p_id" id="p_id" placeholder="P Id" value="<?php echo $p_id; ?>" />
                            <?php echo form_error('p_id', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="idProg" value="<?php echo $idProg; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>