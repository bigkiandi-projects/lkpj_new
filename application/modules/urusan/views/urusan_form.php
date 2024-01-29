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
                        <a href="<?php echo base_url('urusan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('kdUrus')) echo 'has-error'?> ">
                            <label for="varchar">KdUrus</label>
                            <input type="text" class="form-control" name="kdUrus" id="kdUrus" placeholder="KdUrus" value="<?php echo $kdUrus; ?>" />
                            <?php echo form_error('kdUrus', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('nmUrus')) echo 'has-error'?> ">
                            <label for="nmUrus">NmUrus</label>
                            <textarea class="form-control" rows="3" name="nmUrus" id="nmUrus" placeholder="NmUrus"><?php echo $nmUrus; ?></textarea>
                            <?php echo form_error('nmUrus', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="idUrus" value="<?php echo $idUrus; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>